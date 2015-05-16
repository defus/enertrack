<?php

class VehiculeController extends \BaseController {

    public function index()
    {
      //TODO:redirect to eclairage#vehicule
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $contacts = DB::select("select CoordonneeID, Nom + Prenom + Societe as Societe from coordonnee WHERE `Type`='MO' and `BaseID` = '".$baseid."' order by CoordonneeID");
      $contacts = $this->objectsToArray($contacts, 'CoordonneeID', 'Societe');

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =12 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $carburants = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =39 AND `BaseID` = '".$baseid."' order by Libelle");
      $carburants = $this->objectsToArray($carburants, 'CategorieID', 'Libelle');

      $fonctions = array(0 => 'Utilitaire', 1 => 'De service', 3 => 'Particulier');

      return View::make('patrimoine.vehicule.create')
        ->with('mos', $mos)
        ->with('contacts', $contacts)
        ->with('categories', $categories)
        ->with('carburants', $carburants)
        ->with('fonctions', $fonctions);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required',
          'CategorieID' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du véhicule est obligatoire !",
          'CategorieID.required' => "La catégorie du véhicule est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('patrimoine/vehicule/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $vehicule = new Vehicules();
          $vehicule->MouvrageID = \Input::get('MouvrageID');
          $vehicule->BaseID = $baseid;
          $vehicule->Nom = \Input::get('Nom');
          $vehicule->CategorieID = \Input::get('CategorieID');
          $vehicule->Carburant = \Input::get('Carburant');
          $vehicule->Marque = \Input::get('Marque');
          $vehicule->Modele = \Input::get('Modele');
          $vehicule->Puissance = \Input::get('Puissance');
          $vehicule->Anneeconstruction = \Input::get('Anneeconstruction');
          $vehicule->Conso = \Input::get('Conso');
          $vehicule->CoordonneeID = \Input::get('CoordonneeID');
          $vehicule->Commentaire = \Input::get('Commentaire');
          
          $vehicule->save();

          Session::flash('vehicule.success', "Création du véhicule effectuée avec succès");
          return Redirect::to('patrimoine#vehicule');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $vehicule = Vehicules::find($id);

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $contacts = DB::select("select CoordonneeID, Nom + Prenom + Societe as Societe from coordonnee WHERE `Type`='MO' and `BaseID` = '".$baseid."' order by CoordonneeID");
      $contacts = $this->objectsToArray($contacts, 'CoordonneeID', 'Societe');

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =12 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $carburants = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =39 AND `BaseID` = '".$baseid."' order by Libelle");
      $carburants = $this->objectsToArray($carburants, 'CategorieID', 'Libelle');

      $fonctions = array(0 => 'Utilitaire', 1 => 'De service', 3 => 'Particulier');
      
      return View::make('patrimoine.vehicule.edit')
        ->with('vehicule', $vehicule)
        ->with('mos', $mos)
        ->with('contacts', $contacts)
        ->with('categories', $categories)
        ->with('carburants', $carburants)
        ->with('fonctions', $fonctions);
    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required',
          'CategorieID' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du véhicule est obligatoire !",
          'CategorieID.required' => "La catégorie du véhicule est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('patrimoine/vehicule/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $vehicule = Vehicules::find($id);
          $vehicule->MouvrageID = \Input::get('MouvrageID');
          $vehicule->Nom = \Input::get('Nom');
          $vehicule->CategorieID = \Input::get('CategorieID');
          $vehicule->Carburant = \Input::get('Carburant');
          $vehicule->Marque = \Input::get('Marque');
          $vehicule->Modele = \Input::get('Modele');
          $vehicule->Puissance = \Input::get('Puissance');
          $vehicule->Anneeconstruction = \Input::get('Anneeconstruction');
          $vehicule->Conso = \Input::get('Conso');
          $vehicule->CoordonneeID = \Input::get('CoordonneeID');
          $vehicule->Commentaire = \Input::get('Commentaire');

          $vehicule->save();

          Session::flash('vehicule.success', "Mise-à-jour du véhicule effectuée avec succès");
          return Redirect::to('patrimoine#vehicule');
        }
    }

    public function destroy($id)
    {
      $vehicule = Vehicules::find($id);
      $vehicule->delete();

      // redirect
      Session::flash('vehicule.success', "véhicule supprimé avec succès !");
      return Redirect::to('patrimoine#vehicule');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}