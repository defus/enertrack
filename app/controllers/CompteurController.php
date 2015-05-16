<?php

class CompteurController extends \BaseController {

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $compteurs = Compteurs::where('BaseID', 'like', $baseid)->get();
      return  View::make('compteur.index')->with('compteurs', $compteurs);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $batiments = DB::select("select CONCAT('batiment-' , BatimentID) as BatimentID, Nom from batiment WHERE `BaseID` = '".$baseid."' order by Nom");
      $vehicules = DB::select("select CONCAT('vehicule-' , VehiculeID) as VehiculeID, Nom from vehicule WHERE `BaseID` = '".$baseid."' order by Nom");
      $eclairages = DB::select("select CONCAT('eclairage-' , EclairageID) as EclairageID, Nom from eclairage WHERE `BaseID` = '".$baseid."' order by Nom");
      $posteproductions = DB::select("select CONCAT('posteproduction-' , PosteproductionID) as PosteproductionID, Nom from posteproduction WHERE `BaseID` = '".$baseid."' order by Nom");
      $autrepostes = DB::select("select CONCAT('autrepostes-' , AutreposteID) as AutreposteID, Nom from autreposte WHERE `BaseID` = '".$baseid."' order by Nom");
      
      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $energies = DB::select("select EnergieID, Nom from energie WHERE `BaseID` = '".$baseid."' order by Nom");
      $energies = $this->objectsToArray($energies, 'EnergieID', 'Nom');

      $fournisseurs = DB::select("select CoordonneeID, Societe from coordonnee WHERE  Type='Fournisseur'   AND BaseID='".$baseid."' order by Societe");
      $fournisseurs = $this->objectsToArray($fournisseurs, 'CoordonneeID', 'Societe');

      $compteurexistants = DB::select("select compteur.CompteurID,  energie.Nom + compteur.Reference + compteur.Localisation as compteur FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) WHERE compteur.BaseID='".$baseid."' order by compteur.Nom");
      $compteurexistants = $this->objectsToArray($compteurexistants, 'CompteurID', 'compteur');

      $compteurprods = DB::select("select CompteurID, Nom   FROM compteur  WHERE BaseID='".$baseid."' AND (Type='PROD' OR Type='PRODEAU' OR Type='FABRICATION') order by Nom");
      $compteurprods = $this->objectsToArray($compteurprods, 'CompteurID', 'Nom');
      
      return View::make('compteur.create')
        ->with('mos', $mos)
        ->with('energies', $energies)
        ->with('fournisseurs', $fournisseurs)
        ->with('compteurexistants', $compteurexistants)
        ->with('compteurprods', $compteurprods)
        ->with('batiments', $batiments)
        ->with('vehicules', $vehicules)
        ->with('eclairages', $eclairages)
        ->with('posteproductions', $posteproductions)
        ->with('autrepostes', $autrepostes);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      //Un validateur perso pour vérifier que le patrimoine est de type <type>-<valeur>
      //attribute = le nom de l'attribut sur lequel on l'applique
      //value = la valeur reçue
      Validator::extend('patrimoineTypeValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return false;
          }
          $patrimoine = explode('-', $value);
          $patrimoineId = $patrimoine[1];
          $patrimoineType = $patrimoine[0];
          if(empty($patrimoineType)){
            return false;
          }

          if('batiment' !== $patrimoineType 
              && 'eclairage' !== $patrimoineType 
              && 'vehicule' !== $patrimoineType 
              && 'posteproduction' !== $patrimoineType 
              && 'autreposte' !== $patrimoineType){
            return false;
          }
          return true;
      });

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required',
          'Type' => 'required',
          'EnergieID' => 'required',
          'patrimoine' => 'required|patrimoineTypeValide'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du compteur est obligatoire !",
          'Type.required' => "Le type est obligatoire !",
          'EnergieID.required' => "La consommation est obligatoire !",
          'patrimoine.required' => "Le patrimoine est obligatoire !",
          'patrimoine.patrimoine_type_valide' => "Choisissez un type de patrimoine valide"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('compteur/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $patrimoine = \Input::get('patrimoine');
          $patrimoine = explode('-', $patrimoine);
          $patrimoineId = $patrimoine[1];
          $patrimoineType = $patrimoine[0]; //permet apr la suite de stoquer la ligne dans la table de liaison etre le compteur et le patrimoine lié

          //Enregistrer les informations de base de tous les compteurs
          $compteur = new Compteurs();
          $compteur->MouvrageID = \Input::get('MouvrageID');
          $compteur->BaseID = $baseid;
          $compteur->Nom = \Input::get('Nom');
          $compteur->Type = \Input::get('Type');
          $compteur->EnergieID = \Input::get('EnergieID');
          $compteur->CompteurprodID = \Input::get('CompteurprodID');
          $compteur->Estenergie = (Input::has('Estenergie')) ? 1 : 0;
          $compteur->Reference = \Input::get('Reference');
          $compteur->Numero = \Input::get('Numero');
          $compteur->Localisation = \Input::get('Localisation');
          $compteur->FournisseurID = \Input::get('FournisseurID');
          $compteur->Caracteristique = \Input::get('Caracteristique');
          $compteur->Nomprestataire = \Input::get('Nomprestataire');
          $compteur->Commentaire = \Input::get('Commentaire');
          $compteur->Seuil = \Input::get('Seuil');
          $compteur->Objectif = \Input::get('Objectif');
          $compteur->Seuil = \Input::get('Seuil');
          $compteur->Clos = (Input::has('Clos')) ? 1 : 0;
          $compteur->Reference2 = \Input::get('Reference2');

          $compteur->save();

          //Enregistrer les informations d'association du compteur au type de patrimoine
          $pourcentage = \Input::get('Pourcentage');
          if(empty($pourcentage)){
            $pourcentage = 100;
          }

          if('batiment' === $patrimoineType){
            $compteurbatiment = new Compteurbatiments();
            $compteurbatiment->BatimentID = $patrimoineId;
            $compteurbatiment->CompteurID = $compteur->CompteurID;
            $compteurbatiment->BaseID = $baseid;
            $compteurbatiment->Pourcentage = $pourcentage;
            $compteurbatiment->save();

          }else if('vehicule' === $patrimoineType){
            $compteurvehicule = new Compteurvehicules();
            $compteurvehicule->VehiculeID = $patrimoineId;
            $compteurvehicule->CompteurID = $compteur->CompteurID;
            $compteurvehicule->BaseID = $baseid;
            $compteurvehicule->Pourcentage = $pourcentage;
            $compteurvehicule->save();            
          }else if('eclairage' === $patrimoineType){
            $compteureclairage = new Compteureclairages();
            $compteureclairage->EclairageID = $patrimoineId;
            $compteureclairage->CompteurID = $compteur->CompteurID;
            $compteureclairage->BaseID = $baseid;
            $compteureclairage->Pourcentage = $pourcentage;
            $compteureclairage->save(); 
          }else if('posteproduction' === $patrimoineType){
            $compteurposteproduction = new Compteurposteproductions();
            $compteurposteproduction->PosteproductionID = $patrimoineId;
            $compteurposteproduction->CompteurID = $compteur->CompteurID;
            $compteurposteproduction->BaseID = $baseid;
            $compteurposteproduction->Pourcentage = $pourcentage;
            $compteurposteproduction->save(); 
          }else if('autreposte' === $patrimoineType){
            $compteurautreposte = new Compteurautrepostes();
            $compteurautreposte->AutreposteID = $patrimoineId;
            $compteurautreposte->CompteurID = $compteur->CompteurID;
            $compteurautreposte->BaseID = $baseid;
            $compteurautreposte->Pourcentage = $pourcentage;
            $compteurautreposte->save(); 
          }

          Session::flash('success', "Création du compteur effectué avec succès");
          return Redirect::to('compteur');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $energies = DB::select("select EnergieID, Nom from energie WHERE `BaseID` = '".$baseid."' order by Nom");
      $energies = $this->objectsToArray($energies, 'EnergieID', 'Nom');

      $fournisseurs = DB::select("select CoordonneeID, Societe from coordonnee WHERE  Type='Fournisseur'  AND BaseID='".$baseid."' order by Societe");
      $fournisseurs = $this->objectsToArray($fournisseurs, 'CoordonneeID', 'Societe');

      $compteurexistants = DB::select("select compteur.CompteurID,  energie.Nom + compteur.Reference + compteur.Localisation as compteur FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) WHERE compteur.BaseID='".$baseid."' order by compteur.Nom");
      $compteurexistants = $this->objectsToArray($compteurexistants, 'CompteurID', 'compteur');

      $compteurprods = DB::select("select CompteurID, Nom   FROM compteur  WHERE BaseID='".$baseid."' AND (Type='PROD' OR Type='PRODEAU' OR Type='FABRICATION') order by Nom");
      $compteurprods = $this->objectsToArray($compteurprods, 'CompteurID', 'Nom');

      $compteur = Compteurs::find($id);

      return View::make('compteur.edit')
        ->with('compteur', $compteur)
        ->with('mos', $mos)
        ->with('energies', $energies)
        ->with('fournisseurs', $fournisseurs)
        ->with('compteurexistants', $compteurexistants)
        ->with('compteurprods', $compteurprods);
    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required',
          'Type' => 'required',
          'EnergieID' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du compteur est obligatoire !",
          'Type.required' => "Le type est obligatoire !",
          'EnergieID.required' => "La consommation est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('compteur/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $compteur = Compteurs::find($id);
          $compteur->MouvrageID = \Input::get('MouvrageID');
          $compteur->Nom = \Input::get('Nom');
          $compteur->Type = \Input::get('Type');
          $compteur->EnergieID = \Input::get('EnergieID');
          $compteur->CompteurprodID = \Input::get('CompteurprodID');
          $compteur->Estenergie = (Input::has('Estenergie')) ? 1 : 0;
          $compteur->Reference = \Input::get('Reference');
          $compteur->Numero = \Input::get('Numero');
          $compteur->Localisation = \Input::get('Localisation');
          $compteur->FournisseurID = \Input::get('FournisseurID');
          $compteur->Caracteristique = \Input::get('Caracteristique');
          $compteur->Nomprestataire = \Input::get('Nomprestataire');
          $compteur->Commentaire = \Input::get('Commentaire');
          $compteur->Seuil = \Input::get('Seuil');
          $compteur->Objectif = \Input::get('Objectif');
          $compteur->Seuil = \Input::get('Seuil');
          $compteur->Clos = (Input::has('Clos')) ? 1 : 0;
          $compteur->Reference2 = \Input::get('Reference2');
          $compteur->save();

          Session::flash('success', "Mise-à-jour du compteur effectuée avec succès");
          return Redirect::to('compteur');
        }
    }

    public function destroy($id)
    {
      $compteur = Compteurs::find($id);
      $compteur->delete();

      // redirect
      Session::flash('success', "Compteur supprimé avec succès !");
      return Redirect::to('compteur');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}