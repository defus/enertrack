<?php

class FactureController extends \BaseController {

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $factures = Factures::where('BaseID', 'like', $baseid)->orderBy('Debutperiode', 'DESC')->get();
      \Carbon\Carbon::setToStringFormat('d-m-Y');
      return  View::make('facture.index')->with('factures', $factures);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $fournisseurs = DB::select("select CoordonneeID, Societe from coordonnee WHERE  Type='Fournisseur'   AND BaseID='".$baseid."' order by Societe");
      $fournisseurs = $this->objectsToArray($fournisseurs, 'CoordonneeID', 'Societe');

      $compteurs = array();
      $compteurs['batiment'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, batiment.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurbatiments  ON (compteur.CompteurID=compteurbatiments.CompteurID and compteur.BaseID=compteurbatiments.BaseID ) INNER JOIN batiment  ON (batiment.BatimentID=compteurbatiments.BatimentID and batiment.BaseID=compteurbatiments.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
      $compteurs['eclairage'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, eclairage.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteureclairages  ON (compteur.CompteurID=compteureclairages.CompteurID and compteur.BaseID=compteureclairages.BaseID ) INNER JOIN eclairage  ON (eclairage.EclairageID=compteureclairages.EclairageID and eclairage.BaseID=compteureclairages.BaseID) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
      $compteurs['vehicule'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, vehicule.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurvehicules  ON (compteur.CompteurID=compteurvehicules.CompteurID and compteur.BaseID=compteurvehicules.BaseID ) INNER JOIN vehicule  ON (vehicule.VehiculeID=compteurvehicules.VehiculeID and vehicule.BaseID=compteurvehicules.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
      $compteurs['posteproduction'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, posteproduction.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurposteproductions  ON (compteur.CompteurID=compteurposteproductions.CompteurID and compteur.BaseID=compteurposteproductions.BaseID ) INNER JOIN posteproduction  ON (posteproduction.PosteproductionID=compteurposteproductions.PosteproductionID and posteproduction.BaseID=compteurposteproductions.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
      $compteurs['autreposte'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, autreposte.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurautrepostes  ON (compteur.CompteurID=compteurautrepostes.CompteurID and compteur.BaseID=compteurautrepostes.BaseID ) INNER JOIN autreposte  ON (autreposte.AutreposteID=compteurautrepostes.AutreposteID and autreposte.BaseID=compteurautrepostes.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
      $compteurs['tous'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, 'tous' as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
        
      return View::make('facture.create')
        ->with('mos', $mos)
        ->with('compteurs', $compteurs)
        ->with('fournisseurs', $fournisseurs);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'CompteurID' => 'required',
          'Debutperiode' => 'required|date',
          'Finperiode' => 'required|date',
          'Totalttc' => 'required',
          'Consommation' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'CompteurID.required' => "Merci de remplir le champ compteur",
          'Debutperiode.required' => "Merci de remplir le champ Du",
          'Debutperiode.date' => "La date de début n'est pas une date valide au format ???",
          'Finperiode.required' => "Merci de remplir le champ Au",
          'Finperiode.date' => "La date de début n'est pas une date valide au format ???",
          'Totalttc.required' => "Merci de remplir le champ Cout TTC",
          'Consommation.required' => "Merci de remplir le champ Consommation"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('facture/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $facture = new Factures();
          $facture->MouvrageID = \Input::get('MouvrageID');
          $facture->BaseID = $baseid;
          $facture->CompteurID = \Input::get('CompteurID');
          $facture->Debutperiode = \Input::get('Debutperiode');
          $facture->Finperiode = \Input::get('Finperiode');
          $facture->Totalttc = \Input::get('Totalttc');
          $facture->Consommation = \Input::get('Consommation');
          $facture->Estimation = (\Input::has('Estimation')) ? 1 : 0;
          $facture->FournisseurID = \Input::get('FournisseurID');
          $facture->Abonnement = \Input::get('Abonnement');
          $facture->Prixunitaire = \Input::get('Prixunitaire');
          $facture->Consohpleines = \Input::get('Consohpleines');
          $facture->Consohcreuses = \Input::get('Consohcreuses');
          $facture->Consophiver = \Input::get('Consophiver');
          $facture->Consochiver = \Input::get('Consochiver');
          $facture->Consopete = \Input::get('Consopete');
          $facture->Consocete = \Input::get('Consocete');
          $facture->HN = \Input::get('HN');
          $facture->HPM = \Input::get('HPM');
          $facture->Nom = \Input::get('Nom');
          $facture->Commentaire = \Input::get('Commentaire');
          $facture->Consopointe = \Input::get('Consopointe');
          $facture->Patteintepointe = \Input::get('Patteintepointe');
          $facture->Patteintehp = \Input::get('Patteintehp');
          $facture->Patteintehc = \Input::get('Patteintehc');
          $facture->Eactivehp = \Input::get('Eactivehp');
          $facture->Eactivehc = \Input::get('Eactivehc');
          $facture->Ereactive = \Input::get('Ereactive');
          $facture->Tangeante = \Input::get('Tangeante');
          $facture->Hygro = \Input::get('Hygro');
          $facture->Coefficient = \Input::get('Coefficient');

          $facture->save();

          Session::flash('success', "Création de la facture effectuée avec succès");
          return Redirect::to('facture');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $fournisseurs = DB::select("select CoordonneeID, Societe from coordonnee WHERE  Type='Fournisseur'   AND BaseID='".$baseid."' order by Societe");
      $fournisseurs = $this->objectsToArray($fournisseurs, 'CoordonneeID', 'Societe');

      $compteurs = array();
      $compteurs['batiment'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, batiment.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurbatiments  ON (compteur.CompteurID=compteurbatiments.CompteurID and compteur.BaseID=compteurbatiments.BaseID ) INNER JOIN batiment  ON (batiment.BatimentID=compteurbatiments.BatimentID and batiment.BaseID=compteurbatiments.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
      $compteurs['eclairage'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, eclairage.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteureclairages  ON (compteur.CompteurID=compteureclairages.CompteurID and compteur.BaseID=compteureclairages.BaseID ) INNER JOIN eclairage  ON (eclairage.EclairageID=compteureclairages.EclairageID and eclairage.BaseID=compteureclairages.BaseID) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
      $compteurs['vehicule'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, vehicule.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurvehicules  ON (compteur.CompteurID=compteurvehicules.CompteurID and compteur.BaseID=compteurvehicules.BaseID ) INNER JOIN vehicule  ON (vehicule.VehiculeID=compteurvehicules.VehiculeID and vehicule.BaseID=compteurvehicules.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
      $compteurs['posteproduction'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, posteproduction.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurposteproductions  ON (compteur.CompteurID=compteurposteproductions.CompteurID and compteur.BaseID=compteurposteproductions.BaseID ) INNER JOIN posteproduction  ON (posteproduction.PosteproductionID=compteurposteproductions.PosteproductionID and posteproduction.BaseID=compteurposteproductions.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
      $compteurs['autreposte'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, autreposte.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurautrepostes  ON (compteur.CompteurID=compteurautrepostes.CompteurID and compteur.BaseID=compteurautrepostes.BaseID ) INNER JOIN autreposte  ON (autreposte.AutreposteID=compteurautrepostes.AutreposteID and autreposte.BaseID=compteurautrepostes.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
      $compteurs['tous'] = DB::select("select compteur.CompteurID,  compteur.Nom,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, 'tous' as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Nom");
      
      $facture = Factures::find($id);

      return View::make('facture.edit')
        ->with('facture', $facture)
        ->with('mos', $mos)
        ->with('compteurs', $compteurs)
        ->with('fournisseurs', $fournisseurs);

    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'CompteurID' => 'required',
          'Debutperiode' => 'required|date',
          'Finperiode' => 'required|date',
          'Totalttc' => 'required',
          'Consommation' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'CompteurID.required' => "Merci de remplir le champ compteur",
          'Debutperiode.required' => "Merci de remplir le champ Du",
          'Debutperiode.date' => "La date de début n'est pas une date valide au format ???",
          'Finperiode.required' => "Merci de remplir le champ Au",
          'Finperiode.date' => "La date de début n'est pas une date valide au format ???",
          'Totalttc.required' => "Merci de remplir le champ Cout TTC",
          'Consommation.required' => "Merci de remplir le champ Consommation"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('facture/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $facture = Factures::find($id);
          $facture->MouvrageID = \Input::get('MouvrageID');
          $facture->CompteurID = \Input::get('CompteurID');
          $facture->Debutperiode = \Input::get('Debutperiode');
          $facture->Finperiode = \Input::get('Finperiode');
          $facture->Totalttc = \Input::get('Totalttc');
          $facture->Consommation = \Input::get('Consommation');
          $facture->Estimation = (\Input::has('Estimation')) ? 1 : 0;
          $facture->FournisseurID = \Input::get('FournisseurID');
          $facture->Abonnement = \Input::get('Abonnement');
          $facture->Prixunitaire = \Input::get('Prixunitaire');
          $facture->Consohpleines = \Input::get('Consohpleines');
          $facture->Consohcreuses = \Input::get('Consohcreuses');
          $facture->Consophiver = \Input::get('Consophiver');
          $facture->Consochiver = \Input::get('Consochiver');
          $facture->Consopete = \Input::get('Consopete');
          $facture->Consocete = \Input::get('Consocete');
          $facture->HN = \Input::get('HN');
          $facture->HPM = \Input::get('HPM');
          $facture->Nom = \Input::get('Nom');
          $facture->Commentaire = \Input::get('Commentaire');
          $facture->Consopointe = \Input::get('Consopointe');
          $facture->Patteintepointe = \Input::get('Patteintepointe');
          $facture->Patteintehp = \Input::get('Patteintehp');
          $facture->Patteintehc = \Input::get('Patteintehc');
          $facture->Eactivehp = \Input::get('Eactivehp');
          $facture->Eactivehc = \Input::get('Eactivehc');
          $facture->Ereactive = \Input::get('Ereactive');
          $facture->Tangeante = \Input::get('Tangeante');
          $facture->Hygro = \Input::get('Hygro');
          $facture->Coefficient = \Input::get('Coefficient');

          $facture->save();

          Session::flash('success', "Mise-à-jour de la facture effectuée avec succès");
          return Redirect::to('facture');
        }
    }

    public function destroy($id)
    {
      $facture = Factures::find($id);
      $facture->delete();

      // redirect
      Session::flash('success', "Facture supprimée avec succès !");
      return Redirect::to('facture');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}