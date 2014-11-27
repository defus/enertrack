<?php

class VehiculeTbgeController extends \BaseController {

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $vehicules = DB::select("SELECT vehicule.*, mouvrage.Societe, coordonnee.Societe as Contact, categorie.libelle as categorie FROM vehicule  INNER JOIN mouvrage ON mouvrage.MouvrageID = vehicule.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = vehicule.CoordonneeID  LEFT OUTER JOIN categorie on categorie.CategorieID = vehicule.CategorieID WHERE vehicule.BaseID='$baseid'");

      return  View::make('tbge.patrimoine.vehicule.index')
        ->with('vehicules', $vehicules);
      
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =12 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $carburants = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =39 AND `BaseID` = '".$baseid."' order by Libelle");
      $carburants = $this->objectsToArray($carburants, 'CategorieID', 'Libelle');

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      $services = array(1 =>  'Propreté', 2 => 'Espaces verts', 3 => 'Entretien et nettoyage des batiments', 4 => 'Eclairage public', 5 =>  'Parc automobile communal', 6 => 'Abattoirs', 7 => 'Sureté', 8 => 'Transport du personnel', 9 => 'Voiture de fonction', 10 => 'Urgences médicales');

      return View::make('tbge.patrimoine.vehicule.create')
        ->with('services', $services)
        ->with('categories', $categories)
        ->with('carburants', $carburants)
        ->with('compteurElectricites', $compteurElectricites);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required',
          'CategorieID' => 'required'
          ), 
        array(
          'Nom.required' => "Le numero de matricule du véhicule est obligatoire !",
          'CategorieID.required' => "La catégorie du véhicule est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/vehicule/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $vehicule = new Vehicules();
          $vehicule->MouvrageID = Config::get('enertrack.MouvrageID');
          $vehicule->BaseID = $baseid;
          $vehicule->Nom = \Input::get('Nom');
          $vehicule->CategorieID = \Input::get('CategorieID');
          $vehicule->Service = \Input::get('Carburant');
          $vehicule->Marque = \Input::get('Marque');
          $vehicule->Modele = \Input::get('Modele');
          $vehicule->Taille = \Input::get('Taille');
          $vehicule->Carburant = \Input::get('Carburant');
          $vehicule->Conso = \Input::get('Conso');
          $vehicule->DistanceParcourue = \Input::get('DistanceParcourue');
          $vehicule->NbrJrReparation = \Input::get('NbrJrReparation');
          $vehicule->Puissance = \Input::get('Puissance');
          
          $vehicule->save();

          //Ajouter les associations compteurs
          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurs_arr = \Input::get('compteurElectricitesID');
            foreach($compteurs_arr as $compteur_id){
              $compteurvehicule = new Compteurvehicules();
              $compteurvehicule->VehiculeID = $vehicule->VehiculeID;
              $compteurvehicule->CompteurID = $compteur_id;
              $compteurvehicule->BaseID = $baseid;
              $compteurvehicule->Pourcentage = 100;
              $compteurvehicule->save();
            }
          }

          Session::flash('vehicule.success', "Création du véhicule effectuée avec succès");
          return Redirect::to('tbge/patrimoine/vehicule');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $vehicule = Vehicules::find($id);

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =12 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $carburants = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =39 AND `BaseID` = '".$baseid."' order by Libelle");
      $carburants = $this->objectsToArray($carburants, 'CategorieID', 'Libelle');

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      $compteurElectricitesSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurvehicules on ( compteur.CompteurID=compteurvehicules.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and compteurvehicules.VehiculeID={$vehicule->VehiculeID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      $compteurElectricitesSelected = $this->objectsToArray($compteurElectricitesSelected, 'CompteurID', 'CompteurID');
      
      $services = array(1 =>  'Propreté', 2 => 'Espaces verts', 3 => 'Entretien et nettoyage des batiments', 4 => 'Eclairage public', 5 =>  'Parc automobile communal', 6 => 'Abattoirs', 7 => 'Sureté', 8 => 'Transport du personnel', 9 => 'Voiture de fonction', 10 => 'Urgences médicales');

      return View::make('tbge/patrimoine.vehicule.edit')
        ->with('vehicule', $vehicule)
        ->with('services', $services)
        ->with('categories', $categories)
        ->with('carburants', $carburants)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('compteurElectricitesSelected', $compteurElectricitesSelected);
    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required',
          'CategorieID' => 'required'
          ), 
        array(
          'Nom.required' => "Le numero de matricule du véhicule est obligatoire !",
          'CategorieID.required' => "La catégorie du véhicule est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/vehicule/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $vehicule = Vehicules::find($id);
          $vehicule->MouvrageID = Config::get('enertrack.MouvrageID');
          $vehicule->Nom = \Input::get('Nom');
          $vehicule->CategorieID = \Input::get('CategorieID');
          $vehicule->Service = \Input::get('Carburant');
          $vehicule->Marque = \Input::get('Marque');
          $vehicule->Modele = \Input::get('Modele');
          $vehicule->Taille = \Input::get('Taille');
          $vehicule->Carburant = \Input::get('Carburant');
          $vehicule->Conso = \Input::get('Conso');
          $vehicule->DistanceParcourue = \Input::get('DistanceParcourue');
          $vehicule->NbrJrReparation = \Input::get('NbrJrReparation');
          $vehicule->Puissance = \Input::get('Puissance');

          $vehicule->save();

          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurvehicule_ids = array();
            $compteur_arr = \Input::get('compteurElectricitesID');
            foreach ($compteur_arr as $key => $compteur_id){
              $size = Compteurvehicules::where('CompteurID', $compteur_id)->where('VehiculeID',  $vehicule->VehiculeID)->count();
              if($size <= 0){
                $compteurvehicule = new Compteurvehicules();
                $compteurvehicule->VehiculeID = $vehicule->VehiculeID;
                $compteurvehicule->CompteurID = $compteur_id;
                $compteurvehicule->BaseID = $baseid;
                $compteurvehicule->Pourcentage = 100;
                $compteurvehicule->save();
              }
              $compteurvehicule_ids[] = $compteur_id;
            }

            $existing_compteurvehicules = DB::select("SELECT compteur.CompteurID, compteurvehicules.VehiculeID FROM compteur inner join compteurvehicules on ( compteur.CompteurID=compteurvehicules.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and compteurvehicules.VehiculeID={$vehicule->VehiculeID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
            foreach ($existing_compteurvehicules as $compteurvehicule){
              if(!in_array($compteurvehicule->CompteurID, $compteurvehicule_ids)){
                DB::table('compteurvehicules')->where('CompteurID', $compteurvehicule->CompteurID)->where('VehiculeID', $compteurvehicule->VehiculeID)->delete();
              }
            }
          }

          Session::flash('vehicule.success', "Mise-à-jour du véhicule effectuée avec succès");
          return Redirect::to('tbge/patrimoine/vehicule');
        }
    }

    public function destroy($id)
    {
      $vehicule = Vehicules::find($id);
      $vehicule->delete();

      // redirect
      Session::flash('vehicule.success', "véhicule supprimé avec succès !");
      return Redirect::to('tbge/patrimoine/vehicule');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}