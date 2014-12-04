<?php

class DashboardController extends BaseController {
  
  /**
   *  entrée dans l'application juste apres la connexion
   *  - crée un tableau A regroupant les maitres d'ouvrage (MO) ayant des données pour l'année n-1
   *  - cree un graphique comparant ces MO
   *  - crée un tableau B regroupant les MO sans données pour l'année n-1, et affiche la date de leur derniere facture entrée
   *  - crée un tableau C regroupant les MO sans données pour l'année n-1, et sans date de derniere facture
   */
  public function showDashboard()
  {
    Log::debug("Début d'affichage de la page de dashboard");
    $username = Auth::user()->Username;  // on recupere le login de l'utilisateur
    $userisadmin = Auth::user()->isadmin;  // on verifie s'il est administrateur
    $userbase = Auth::user()->BaseID;  // on recupere le login de l'utilisateur
    $cetteannee = date('Y')-1;  //on choisi l'année "n-1", les données de l'année "n" étant forcément incompletes

    //recupere les donnes des mo sur lesquels cet utilisateur a les droits d'ecriture ou de lecture   (separation admin /non admin pour eviter les doublons en mode admin)
    if ($userisadmin==1){
      $Z1res = DB::select("select mouvrage.MouvrageID,mouvrage.Societe,mouvrage.Codepostal,mouvrage.Ville,mouvrage.BaseID,mouvrage.Estmodifie, categorie.Libelle  FROM mouvrage  LEFT JOIN categorie ON (mouvrage.CategorieID=categorie.CategorieID)   order by mouvrage.Societe");
    }
    else{
      $Z1res = DB::select("select mouvrage.MouvrageID,mouvrage.Societe,mouvrage.Codepostal,mouvrage.Ville,mouvrage.BaseID,mouvrage.Estmodifie,categorie.Libelle  FROM mouvrage LEFT JOIN roles  ON (mouvrage.MouvrageID=roles.record_id  and mouvrage.BaseID=roles.BaseID ) LEFT JOIN categorie ON (mouvrage.CategorieID=categorie.CategorieID)  WHERE (roles.Username='".$username."') order by mouvrage.Societe");
    }
    Log::debug("Nombre de maitre d'ouvrage trouvé à afficher : " . count($Z1res));

    $totalconsoenergie = 0; //TODO:pas sur, verifier la portée de cette variable
    $totalconsoep = 0; //TODO:pas sur, verifier la portée de cette variable
    $totalconsoeau = 0; //TODO:pas sur, verifier la portée de cette variable
    $totalemissionges = 0; //TODO:pas sur, verifier la portée de cette variable
    $chainegraphique1 = ""; //TODO:pas sur, verifier la portée de cette variable
    $chainegraphique2 = ""; //TODO:pas sur, verifier la portée de cette variable
    $montableau = array(); //Tableau B
    $montableau2 = array(); //Tableau A
    $montableau3 = array(); //Tableau A Total
    $tableauattente = array(); //Tableau des mo avec dernière facture
    $phrase = ""; //TODO:pas sur, verifier la portée de cette variable

    // pour chaque Mo sur lequel cet utilisateur à les droits d'ecriture ou de lecture
    foreach ($Z1res as $Z1row) {
      $finperiode = '';
      
      //on recupere les données du MO
      $mouvrageid= $Z1row->MouvrageID;
      $baseid = $Z1row->BaseID;
      $societe= $Z1row->Societe;
      $libelle= $Z1row->Libelle;
      $cp= $Z1row->Codepostal;
      $ville= $Z1row->Ville;
      $modifie= $Z1row->Estmodifie;
      
      //TODO:why?$datemaj=date("d/m/Y", strtotime($datemaj1));
      
      //on recupere la date de la derniere facture entrée
      $Z2res = DB::select("SELECT Finperiode FROM facture WHERE MouvrageID=$mouvrageid and BaseID='".$baseid."' order by FinPeriode Desc limit 1" );
      foreach ($Z2res as $Z2row) {
        $finperiode1= $Z2row->Finperiode;
        $finperiode=date("d/m/Y", strtotime($finperiode1));
        $anneeperiode= date("Y", strtotime($finperiode1));
      }
      Log::debug("Nombre de dernière facture recuperée : " . count($Z2res));

      //regeneration de la table regenmo
//    if ($modifie==1) {// si le MO a ete modifie (timer Estmodifie dans table/mouvrage.php ou table/facture.php)
        \MoService::regenmo($mouvrageid, $baseid, $cetteannee, $cetteannee);
//    }

      //reinitialisation
      $ZZfrequentation=0;
      $ZZtypefrequentation='';
      $datemaj='';
        
      $consoenergie= 0;
      $consoep= 0;
      $consoeau= 0;
      $emissionges=0;
                 
      //regeneration de la table resultatmo 
                 
      //recupere les conso du MO pour cette année dans la table resultatmo 
      $Z3res = DB::select("SELECT Consoef, Consoeau,Consoep, Emissionges, Datemaj FROM resultatmo WHERE MouvrageID=$mouvrageid and BaseID='".$baseid."' and Annee=$cetteannee");
      foreach ($Z3res as $Z3row) {
        $consoenergie= 0;
        $consoep= 0;
        $consoeau= 0;
        $emissionges=0;
        $consoenergie= $Z3row->Consoef;
        $consoep= $Z3row->Consoep;
        $consoeau= $Z3row->Consoeau;
        $emissionges= $Z3row->Emissionges;
        $datemaj1= $Z3row->Datemaj;
        $datemaj=date("d/m/Y", strtotime($datemaj1));
      }

      //s'il n'y a pas de facture pour l'année n-1, on le rentre dans le tableau B
      if (!isset($anneeperiode) || $anneeperiode < $cetteannee)  {
        $montableau[] = (array('MouvrageID' => $mouvrageid,'BaseID' => $baseid,'Libelle' => $libelle,'Societe' => $societe,'Codepostal' => $cp,'Ville' => $ville, 'Datefacture'=> $finperiode));
      }
      //s'il y a une facture, on verifie qu'il y a des donnees
      elseif ($consoenergie !=0 or $consoeau != 0) {
        //on cherche la derniere frequentation entrée pour ce MO
        $ZZresultbudget = DB::select("select  Frequentation, Typefrequentation  from  moan  WHERE Annee=(SELECT max(Annee)  FROM moan WHERE MouvrageID=$mouvrageid and Frequentation!=0) and MouvrageID=$mouvrageid and BaseID='$baseid' ");
        foreach ($ZZresultbudget as $ZZrowbudget) {
          $ZZtypefrequentation = $ZZrowbudget->Typefrequentation; //unité de frequentation (habitants, nuitée...)
          $ZZfrequentation = ceil($ZZrowbudget->Frequentation) * 1;  // nombre (on multiplie par 1 pour forcer le format numerique car il passe parfois en chaine dans la table)
        }

        //on cree la couleur de la legende (hexadecimal aleatoire pour creer un code couleur html du type #961900 (bordeaux))
        $a = DecHex(mt_rand(0, 15));
        $b = DecHex(mt_rand(0, 15));
        $c = DecHex(mt_rand(0, 15));
        $d = DecHex(mt_rand(0, 15));
        $e = DecHex(mt_rand(0, 15));
        $f = DecHex(mt_rand(0, 15));;
        $hexa = $f . $b . $c . $d . $e . $a;

        //on place  les consos dans le tableau A pour les afficher
        $montableau2[] = (array('MouvrageID' => $mouvrageid,'BaseID' => $baseid,'Societe' => $societe,'Frequentation' => $ZZfrequentation,'Typefrequentation' => $ZZtypefrequentation,'Consoenergie' => $consoenergie,'Consoep' => $consoep,'Consoeau' => $consoeau, 'Emissionges'=> $emissionges, 'Datemaj'=> $datemaj, 'Couleur'=> $hexa));
                         
        // somme pour la ligne TOTAL du tableau
        $totalconsoenergie+= $consoenergie ;    //  code equivalent à  $totalconsoenergie=$totalconsoenergie + $consoenergie ;
        $totalconsoep+= $consoep;
        $totalconsoeau+=$consoeau;
        $totalemissionges+=$emissionges;

        //on enlève les accent sur le nom
        //     $ZFsociete = utf8_encode($societe); 
        $ZFsociete= str_replace( array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý', '°'), array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y', 'o'), $societe);
            
        //on cree la legende du graphique onmouseover
        $tip= $ZFsociete.' '.$ZZfrequentation.' '.$ZZtypefrequentation.'<br> Consommation kWh EP '.$consoep.'<br> GES k eq. C02 '.$emissionges;
                         
        //on cree la taille du point en fonction de la fréquentation
        switch ($ZZfrequentation)  {
          case 0 :
            $taillepoint = 3;
            break;

          case $ZZfrequentation < 100 :
            $taillepoint = 3;
            break;

          case $ZZfrequentation < 500 :
            $taillepoint = 5;
            break;

          case $ZZfrequentation < 1000 :
            $taillepoint = 10;
            break;

          case $ZZfrequentation <5000 :
            $taillepoint = 15;
            break;

          case $ZZfrequentation < 10000 :
            $taillepoint = 25;
            break ;

          case $ZZfrequentation >= 10000 :
            $taillepoint = 35;
            break ;
        }

        //bubble  conso energie  par hab   
        if ($ZZfrequentation>0 and $totalconsoenergie!=0 and $libelle == 'Commune')  {
          $GRAPHconsohab = round($totalconsoenergie/$ZZfrequentation);
          $GRAPHgeshab = round($totalemissionges/$ZZfrequentation);
          $chainegraphique1 = $chainegraphique1.' var d'.$mouvrageid.' = [['.$GRAPHconsohab.', '.  $GRAPHgeshab.', '.$taillepoint.']];' ;
          $chainegraphique2 = $chainegraphique2.'{data: d'.$mouvrageid.', color: "#'.$hexa.'",  label: "'.$ZFsociete.' ( '.$GRAPHconsohab.' KWhEP/Hab, '.$GRAPHgeshab.' Kg e. CO2 /Hab)  ", bubble: true, points: { show: true, lineWidth:'.$taillepoint.' }},';
        }

      }
      
      // s'il y a des factures mais pas de conso, ca n'apparait ni dans le tableau A ni dans le B, donc on stocke  pour le tableau C
      else   {
        $tableauattente []= (array('MouvrageID' => $mouvrageid,'BaseID' => $baseid,'Libelle' => $libelle,'Societe' => $societe,'Codepostal' => $cp,'Ville' => $ville, 'Datefacture'=> $finperiode));
      }

      //reinitialisation
      $finperiode = '' ;
      $societe = '' ;

    }

    if ($username) {

      //on place les totaux dans un tableau pour les afficher
      $montableau3[]= (array('MouvrageID' => $mouvrageid,'BaseID' => $baseid,'Totalconsoenergie' => $totalconsoenergie,'Totalconsoep' => $totalconsoep,'Totalconsoeau' => $totalconsoeau, 'Totalemissionges'=> $totalemissionges));
          
      if  ($tableauattente) {
          $phrase = "Cas particulier pour lesquels EnerTrack n'a pas de données pour ".$cetteannee." ni de facture anterieure à ".$cetteannee;
      }

      //on passe toutes les données aux templates pour l'affichage.
      // si on a des données de conso, on choisi un template plus elaboré avec un graphique
      // sinon, on choisi un template avec un affichage simple
      if ($totalconsoenergie!=0 or $totalconsoeau!=0){
        $data = array('tableau_b'=>$montableau,'tableau_a'=>$montableau2,'tableau_a_total'=>$montableau3,'annee'=>$cetteannee,'mon_tableauattente'=>$tableauattente,'phrase'=>$phrase,'Graphiquebubble1' => $chainegraphique1, 'Graphiquebubble2' => $chainegraphique2);
      }
      else{
        $data = array('tableau_b'=>$montableau, 'tableau_a'=>$montableau2, 'tableau_a_total'=>$montableau3, 'annee'=>$cetteannee, 'mon_tableauattente'=>$tableauattente, 'ma_phraseattente'=>$phraseattente, 'userbase'=>$userbase);
      }

    }

    return \View::make('dashboard', $data);
  }

}