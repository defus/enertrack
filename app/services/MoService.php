<?php

class MoService {
  
  /**
   * Génère les données de statistique pour un maitre d'ouvrage donne
   * @param $mouvrageid : le maitre d'ouvrage
   * @param $baseid : l'identifiant de base du maitre d'ouvrage
   * @param $andepart : année de debut du calcul
   * @param $anfin : année de fin du calcul
   */
  public static function regenmo($mouvrageid, $baseid, $andepart, $anfin) {
    for($i=$andepart; $i <= $anfin; $i++)  {
      //reinitialisation des variables
      $ZAsommeconso=0;
      $ZCconsoeau=0;
      $ZAcoeffannee=0;
      $ZDconsoep=0;
      $ZBsommeeuro=0;
      $ZCsommeeuro=0;
      $ZEconsoges= 0;
      $ZEtotalnucleaire=0;
      $ZEtotalfossile=0;
      $ZEtotalenr=0;
      
      $BATsommeconsoef=0;
      $BATsommeconsoep=0;
      $BATsommettc=0;
      $BATsommeges=0;
      $BATsommeconsoeau=0;
      $BATsommettceau=0;
      
      $EPsommeconsoef=0;
      $EPsommeconsoep=0;
      $EPsommettc=0;
      $EPsommeges=0;
      $EPsommeconsoeau=0;
      $EPsommettceau=0;
      
      $VEHsommeconsoef=0;
      $VEHsommeconsoep=0;
      $VEHsommettc=0;
      $VEHsommeges=0;
      $VEHsommeconsoeau=0;
      $VEHsommettceau=0;
      
      $APsommeconsoef=0;
      $APsommeconsoep=0;
      $APsommettc=0;
      $APsommeges=0;
      $APsommeconsoeau=0;
      $APsommettceau=0;
      
      $PRODsommeconsoef=0;
      $PRODsommeconsoep=0;
      $PRODsommettc=0;
      $PRODsommeges=0;
      $PRODsommeconsoeau=0;
      $PRODsommettceau=0;
      

      // prends tous les compteurs d'un mo donne
      $ZBresult = DB::select("select distinct c.CompteurID, c.Type, e.Tauxnucleaire, e.Tauxfossile,e.Tauxenr,r.Conso, r.Consoef, r.Consoep, r.Ttc, r.Emissionges  from  compteur c LEFT JOIN resultatcompteur r ON (c.CompteurID=r.CompteurID AND c.BaseID=r.BaseID ) LEFT JOIN energie e ON (c.EnergieID=e.EnergieID AND c.BaseID=e.BaseID) WHERE c.MouvrageID=$mouvrageid  and r.Annee=$i and c.BaseID='$baseid'");
      foreach ($ZBresult as $ZBrow) {
        //reinitialisation des compteurs
        $ZAsommeconso2=0;
        $ZCconsoeau2=0;
        $ZAcoeffannee2=0;
        $ZDconsoep2=0;
        $ZBsommeeuro2=0;
        $ZCsommeeuro2=0;
        $ZEconsoges2= 0;
        $ZEtotalnucleaire2=0;
        $ZEtotalfossile2=0;
        $ZEtotalenr2=0;
        $ZLPsommeconso2=0;
        $ZLPcoeffannee2=0;
        $ZLPconsoep2=0;
        $ZLPsommeeuro2=0;
        $ZLPconsoges2=0;
      
        $compteurid = $ZBrow->CompteurID;       
                
            
        $ZAconso=$ZBrow->Conso;
        $ZAconsoef=$ZBrow->Consoef;
        $ZAconsoep=$ZBrow->Consoep;
        $ZAttc=$ZBrow->Ttc;
        $ZAemissionges=$ZBrow->Emissionges;
          
        $ZAcompteurid= $ZBrow->CompteurID;
        $ZAtype= $ZBrow->Type;
        //$Z1Coefkwhpci= $ZBrow->Coefkwhpci;
        //$Z1facteurges= 1*$ZBrow->Facteurges;
        //$Z1facteurep= $ZBrow->Facteurep;
        $Z1tauxnucleaire= $ZBrow->Tauxnucleaire;
        $Z1tauxfossile= $ZBrow->Tauxfossile;
        $Z1tauxenr= $ZBrow->Tauxenr;
  
        //les factures d'energies
        if ($ZAtype=='CONSO') {        
          $ZAcoeffannee2=$ZAconsoef;   // on recupere la consommation en energie finale de ce compteur
          $ZAsommeconso2 =$ZAconso; // on recupere la consommation de ce compteur
          $ZBsommeeuro2 =$ZAttc; // on recupere le cout ttc de ce compteur              
          $ZDconsoep2=$ZAconsoep;         
          $ZEconsoges2 =$ZAemissionges;
          $ZEtotalnucleaire2 =$ZAconsoef*$Z1tauxnucleaire; // on recupere le nbr de kw d'origine nucleaire de ce compteur
          $ZEtotalfossile2=$ZAconsoef*$Z1tauxfossile;   // on recupere le nbr de kw d'origine fossile de ce compteur
          $ZEtotalenr2=$ZAconsoef*$Z1tauxenr;   // on recupere le nbr de kw d'origine enr de ce compteur
        }
        //les factures d'eau
        elseif ($ZAtype=='CONSOEAU') {
          $ZCconsoeau2 =$ZAconso;  // on recupere la consommation d'eau de cette facture et on l'ajoute aux autres
          $ZCsommeeuro2 =$ZAttc;  // on recupere le cout ttc de cette facture et on l'ajoute aux autres
        }
        else {
           $ZLPcoeffannee2=$ZAconsoef;   // on recupere la consommation en energie finale de ce compteur           
           $ZLPsommeconso2 = $ZAconso; //sert uniquement pour l'affichage en tip  et le stockage dans resultatmo
           $ZLPsommeeuro2 = $ZAeuro; // on recupere le cout ttc de ce compteur
           $ZLPconsoep2=$ZAconsoep;   // on recupere la consommation en energie primaire de ce compteur
           $ZLPconsoges2=$ZAemissionges;   // on recupere les emissions de GES de ce compteur
        }

        Log::debug('Mouvrageid='.$mouvrageid);
        Log::debug('annee='.$i);
        Log::debug('RCConso='.$ZAcoeffannee2);
        Log::debug('RCTtc='.$ZAttc);
        Log::debug('Compteurid='.$compteurid);
        
        //on empile les resultats pour l'ensemble des compteurs
        $ZAsommeconso=$ZAsommeconso2+$ZAsommeconso;
        $ZCconsoeau=$ZCconsoeau2+$ZCconsoeau;
        $ZAcoeffannee=$ZAcoeffannee2+$ZAcoeffannee;
        $ZDconsoep=$ZDconsoep2+$ZDconsoep;
        $ZBsommeeuro=$ZBsommeeuro2+$ZBsommeeuro;
        $ZCsommeeuro=$ZCsommeeuro2+$ZCsommeeuro;
        $ZEconsoges= $ZEconsoges2+$ZEconsoges;
        $ZEtotalnucleaire=$ZEtotalnucleaire+$ZEtotalnucleaire2;
        $ZEtotalfossile=$ZEtotalfossile+$ZEtotalfossile2;
        $ZEtotalenr=$ZEtotalenr+$ZEtotalenr2;
        
        Log::debug('Somme conso a ce point de la boucle='.$ZAcoeffannee.' <br><br>');
          
        //on verifie si ce compteur est lié a un batiment
        $BATresult = DB::select("select distinct Pourcentage from  compteurbatiments WHERE CompteurID=$compteurid and BaseID='$baseid'");
        foreach ($BATresult as $BATrow) {
          $BATpourcent=$BATrow->Pourcentage;
          
          //on l'ajoute aux sommes BAT en prenant en compte le pourcentage du compteur
          $BATsommeconsoef=$BATsommeconsoef+($ZAcoeffannee2*$BATpourcent/100);  //conso energie finale
          $BATsommeconsoep=$BATsommeconsoep+($ZDconsoep2*$BATpourcent/100);     //conso energie primaire
          $BATsommettc=$BATsommettc+($ZBsommeeuro2*$BATpourcent/100);       // cout energie
          $BATsommeges=$BATsommeges+($ZEconsoges2*$BATpourcent/100);        // emission ges
          
          $BATsommeconsoeau=$BATsommeconsoeau+($ZCconsoeau2*$BATpourcent/100);  //conso eau
          $BATsommettceau=$BATsommettceau+($ZCsommeeuro2*$BATpourcent/100);  //couteau
        }

        //on verifie si ce compteur est lié a un eclairage public
        $EPresult = DB::select("select distinct Pourcentage from  compteureclairages WHERE CompteurID=$compteurid and BaseID='$baseid'");
        foreach ($EPresult as $EProw) {
          $EPpourcent=$EProw->Pourcentage;
          
          //on l'ajoute aux sommes BAT en prenant en compte le pourcentage du compteur
          $EPsommeconsoef=$EPsommeconsoef+($ZAcoeffannee2*$EPpourcent/100);  //conso energie finale
          $EPsommeconsoep=$EPsommeconsoep+($ZDconsoep2*$EPpourcent/100);     //conso energie primaire
          $EPsommettc=$EPsommettc+($ZBsommeeuro2*$EPpourcent/100);        // cout energie
          $EPsommeges=$EPsommeges+($ZEconsoges2*$EPpourcent/100);       // emission ges
          
          $EPsommeconsoeau=$EPsommeconsoeau+($ZCconsoeau2*$EPpourcent/100);  //conso eau
          $EPsommettceau=$EPsommettceau+($ZCsommeeuro2*$EPpourcent/100);  //conso eau
          
        }   


        //on verifie si ce compteur est lié a un vehicule
        $VEHresult = DB::select("select distinct Pourcentage from  compteurvehicules WHERE CompteurID=$compteurid and BaseID='$baseid'");
        foreach ($VEHresult as $VEHrow) {
          $VEHpourcent=$VEHrow->Pourcentage;
          
          //on l'ajoute aux sommes BAT en prenant en compte le pourcentage du compteur
          $VEHsommeconsoef=$VEHsommeconsoef+($ZAcoeffannee2*$VEHpourcent/100);  //conso energie finale
          $VEHsommeconsoep=$VEHsommeconsoep+($ZDconsoep2*$VEHpourcent/100);     //conso energie primaire
          $VEHsommettc=$VEHsommettc+($ZBsommeeuro2*$VEHpourcent/100);       // cout energie
          $VEHsommeges=$VEHsommeges+($ZEconsoges2*$VEHpourcent/100);        // emission ges
          
          $VEHsommeconsoeau=$VEHsommeconsoeau+($ZCconsoeau2*$VEHpourcent/100);  //conso eau
          $VEHsommettceau=$VEHsommettceau+($ZCsommeeuro2*$VEHpourcent/100);  //conso eau
          
        }

        //on verifie si ce compteur est lié a un autre poste
        $APresult = DB::select("select distinct Pourcentage from compteurautrepostes WHERE CompteurID=$compteurid and BaseID='$baseid'");
        foreach ($APresult as $AProw) {
          $APpourcent=$AProw->Pourcentage;
          
          //on l'ajoute aux sommes BAT en prenant en compte le pourcentage du compteur
          $APsommeconsoef=$APsommeconsoef+($ZAcoeffannee2*$APpourcent/100);  //conso energie finale
          $APsommeconsoep=$APsommeconsoep+($ZDconsoep2*$APpourcent/100);     //conso energie primaire
          $APsommettc=$APsommettc+($ZBsommeeuro2*$APpourcent/100);        // cout energie
          $APsommeges=$APsommeges+($ZEconsoges2*$APpourcent/100);       // emission ges
          
          $APsommeconsoeau=$APsommeconsoeau+($ZCconsoeau2*$APpourcent/100);  //conso eau
          $APsommettceau=$APsommettceau+($ZCsommeeuro2*$APpourcent/100);  //conso eau
        }


        //on verifie si ce compteur est lié a un poste de production
        $PRODresult = DB::select("select distinct Pourcentage from  compteurposteproductions WHERE CompteurID=$compteurid and BaseID='$baseid'");
        foreach ($PRODresult as $PRODrow) {
          $PRODpourcent=$PRODrow->Pourcentage;
          
          //on l'ajoute aux sommes BAT en prenant en compte le pourcentage du compteur
          $PRODsommeconsoef=$PRODsommeconsoef+($ZAcoeffannee2*$PRODpourcent/100);  //conso energie finale
          $PRODsommeconsoep=$PRODsommeconsoep+($ZDconsoep2*$PRODpourcent/100);     //conso energie primaire
          $PRODsommettc=$PRODsommettc+($ZBsommeeuro2*$PRODpourcent/100);        // cout energie
          $PRODsommeges=$PRODsommeges+($ZEconsoges2*$PRODpourcent/100);       // emission ges
          
          $PRODsommeconsoeau=$PRODsommeconsoeau+($ZCconsoeau2*$PRODpourcent/100);  //conso eau
          $PRODsommettceau=$PRODsommettceau+($ZCsommeeuro2*$PRODpourcent/100);  //conso eau
          
        }
      }

      $test=$ZBsommeeuro+$ZCsommeeuro;

      Log::debug('MO: '.$mouvrageid.' Annee: '.$i.' Conso totale :'.$ZAcoeffannee.' Cout total :'.$test.' totalnucleaire :'.$ZEtotalnucleaire.' totalfossile :'.$ZEtotalfossile.' totalenr :'.$ZEtotalenr.' totalbatef :'.$BATsommeconsoef.' totalEPef :'.$EPsommeconsoef.' totalVEHef :'.$VEHsommeconsoef.'  totalAPef :'.$APsommeconsoef.'  totalPRODef :'.$PRODsommeconsoef);
          
      //on arrondi pour eviter les ennuis avec les graphiques
      $ZAsommeconso=number_format($ZAsommeconso, 2, '.', '');
      $ZCconsoeau=number_format($ZCconsoeau, 2, '.', '');
      $ZAcoeffannee=number_format($ZAcoeffannee, 2, '.', '');
      $ZDconsoep=number_format($ZDconsoep, 2, '.', '');
      $ZBsommeeuro=number_format($ZBsommeeuro, 2, '.', '');
      $ZCsommeeuro=number_format($ZCsommeeuro, 2, '.', '');
      $ZEconsoges= number_format($ZEconsoges, 2, '.', '');
      $ZEtotalnucleaire=number_format($ZEtotalnucleaire, 2, '.', '');
      $ZEtotalfossile=number_format($ZEtotalfossile, 2, '.', '');
      $ZEtotalenr=number_format($ZEtotalenr, 2, '.', '');
      
      $BATsommeconsoef=number_format($BATsommeconsoef, 2, '.', '');
      $BATsommeconsoep=number_format($BATsommeconsoep, 2, '.', '');
      $BATsommettc=number_format($BATsommettc, 2, '.', '');
      $BATsommeges=number_format($BATsommeges, 2, '.', '');
      $BATsommeconsoeau=number_format($BATsommeconsoeau, 2, '.', '');
      $BATsommettceau=number_format($BATsommettceau, 2, '.', '');
      
      $EPsommeconsoef=number_format($EPsommeconsoef, 2, '.', '');
      $EPsommeconsoep=number_format($EPsommeconsoep, 2, '.', '');
      $EPsommettc=number_format($EPsommettc, 2, '.', '');
      $EPsommeges=number_format($EPsommeges, 2, '.', '');
      $EPsommeconsoeau=number_format($EPsommeconsoeau, 2, '.', '');
      $EPsommettceau=number_format($EPsommettceau, 2, '.', '');
      
      $VEHsommeconsoef=number_format($VEHsommeconsoef, 2, '.', '');
      $VEHsommeconsoep=number_format($VEHsommeconsoep, 2, '.', '');
      $VEHsommettc=number_format($VEHsommettc, 2, '.', '');
      $VEHsommeges=number_format($VEHsommeges, 2, '.', '');
      $VEHsommeconsoeau=number_format($VEHsommeconsoeau, 2, '.', '');
      $VEHsommettceau=number_format($VEHsommettceau, 2, '.', '');
      
      $APsommeconsoef=number_format($APsommeconsoef, 2, '.', '');
      $APsommeconsoep=number_format($APsommeconsoep, 2, '.', '');
      $APsommettc=number_format($APsommettc, 2, '.', '');
      $APsommeges=number_format($APsommeges, 2, '.', '');
      $APsommeconsoeau=number_format($APsommeconsoeau, 2, '.', '');
      $APsommettceau=number_format($APsommettceau, 2, '.', '');
      
      $PRODsommeconsoef=number_format($PRODsommeconsoef, 2, '.', '');
      $PRODsommeconsoep=number_format($PRODsommeconsoep, 2, '.', '');
      $PRODsommettc=number_format($PRODsommettc, 2, '.', '');
      $PRODsommeges=number_format($PRODsommeges, 2, '.', '');
      $PRODsommeconsoeau=number_format($PRODsommeconsoeau, 2, '.', '');
      $PRODsommettceau=number_format($PRODsommettceau, 2, '.', '');


      // on rentre le tout dans la table resultatmo
      $sql2="INSERT INTO resultatmo (
          Annee, 
          MouvrageID, 
          Consoenergie, 
          Consoeau, 
          Consoef, 
          Consoep, 
          Ttcenergie, 
          Ttceau, 
          Emissionges, 
          Onucleaire, 
          Orenouvelable, 
          Ofossile,
          Batsommeconsoef, 
          Batsommeconsoep, 
          Batsommettc, 
          Batsommeges, 
          Batsommeconsoeau, 
          Batsommettceau, 
          Epsommeconsoef, 
          Epsommeconsoep, 
          Epsommettc,
          Epsommeges,
          Epsommeconsoeau, 
          Epsommettceau, 
          Vehsommeconsoef, 
          Vehsommeconsoep, 
          Vehsommettc, 
          Vehsommeges, 
          Vehsommeconsoeau, 
          Vehsommettceau, 
          Apsommeconsoef, 
          Apsommeconsoep, 
          Apsommettc, 
          Apsommeges, 
          Apsommeconsoeau, 
          Apsommettceau, 
          Prodsommeconsoef, 
          Prodsommeconsoep, 
          Prodsommettc, 
          Prodsommeges, 
          Prodsommeconsoeau, 
          Prodsommettceau,          
          BaseID
          ) 
        VALUES (
          $i, 
          $mouvrageid, 
          $ZAsommeconso, 
          $ZCconsoeau, 
          $ZAcoeffannee, 
          $ZDconsoep,
          $ZBsommeeuro,
          $ZCsommeeuro, 
          $ZEconsoges,
          $ZEtotalnucleaire, 
          $ZEtotalenr, 
          $ZEtotalfossile,
          $BATsommeconsoef, 
          $BATsommeconsoep, 
          $BATsommettc, 
          $BATsommeges, 
          $BATsommeconsoeau, 
          $BATsommettceau, 
          $EPsommeconsoef, 
          $EPsommeconsoep, 
          $EPsommettc,
          $EPsommeges,
          $EPsommeconsoeau, 
          $EPsommettceau, 
          $VEHsommeconsoef, 
          $VEHsommeconsoep, 
          $VEHsommettc, 
          $VEHsommeges, 
          $VEHsommeconsoeau, 
          $VEHsommettceau, 
          $APsommeconsoef, 
          $APsommeconsoep, 
          $APsommettc, 
          $APsommeges, 
          $APsommeconsoeau, 
          $APsommettceau, 
          $PRODsommeconsoef, 
          $PRODsommeconsoep,
          $PRODsommettc,
          $PRODsommeges,
          $PRODsommeconsoeau,
          $PRODsommettceau,
          '$baseid'
          ) 
        ON DUPLICATE KEY UPDATE 
          Consoenergie= $ZAsommeconso,
          Consoeau=$ZCconsoeau,
          Consoef=$ZAcoeffannee,
          Consoep=$ZDconsoep,
          Ttcenergie=$ZBsommeeuro,
          Ttceau=$ZCsommeeuro,
          Emissionges=$ZEconsoges,
          Onucleaire=$ZEtotalnucleaire,
          Orenouvelable=$ZEtotalenr,
          Ofossile=$ZEtotalfossile,
          Batsommeconsoef=$BATsommeconsoef,
          Batsommeconsoep=$BATsommeconsoep,
          Batsommettc=$BATsommettc,
          Batsommeges=$BATsommeges,
          Batsommeconsoeau=$BATsommeconsoeau,
          Batsommettceau=$BATsommettceau,
          Epsommeconsoef=$EPsommeconsoef,
          Epsommeconsoep=$EPsommeconsoep,
          Epsommettc=$EPsommettc,
          Epsommeges=$EPsommeges,
          Epsommeconsoeau=$EPsommeconsoeau,
          Epsommettceau=$EPsommettceau,
          Vehsommeconsoef=$VEHsommeconsoef,
          Vehsommeconsoep=$VEHsommeconsoep,
          Vehsommettc=$VEHsommettc,
          Vehsommeges=$VEHsommeges,
          Vehsommeconsoeau=$VEHsommeconsoeau,
          Vehsommettceau=$VEHsommettceau,
          Apsommeconsoef=$APsommeconsoef,
          Apsommeconsoep=$APsommeconsoep,
          Apsommettc=$APsommettc,
          Apsommeges=$APsommeges,
          Apsommeconsoeau=$APsommeconsoeau,
          Apsommettceau=$APsommettceau,
          Prodsommeconsoef=$PRODsommeconsoef,
          Prodsommeconsoep=$PRODsommeconsoep,
          Prodsommettc=$PRODsommettc,
          Prodsommeges=$PRODsommeges,
          Prodsommeconsoeau=$PRODsommeconsoeau,
          Prodsommettceau=$PRODsommettceau,       
          Datemaj=CURRENT_TIMESTAMP ";

      DB::statement($sql2);
    }
        
    
    //on repasse la case est modifie a 0
    $resmodif = DB::statement("UPDATE mouvrage SET Estmodifie=0 WHERE Mouvrageid=$mouvrageid AND BaseID = '".$baseid."' ");

  }
}
