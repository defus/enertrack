<?php

class EclairageController extends \BaseController {

    public function index()
    {
      //TODO:redirect to eclairage#batiment
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $contacts = DB::select("select CoordonneeID, Nom + Prenom + Societe as Societe from coordonnee WHERE `Type`='MO' and `BaseID` = '".$baseid."' order by CoordonneeID");
      $contacts = $this->objectsToArray($contacts, 'CoordonneeID', 'Societe');

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =8 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $stationDjus = DB::select("select StationdjuID, Ville from stationdju WHERE `Actif`=1 and `BaseID` = '".$baseid."' order by Ville");
      $stationDjus = $this->objectsToArray($stationDjus, 'StationdjuID', 'Ville');
      
      return View::make('patrimoine.eclairage.create')
        ->with('mos', $mos)
        ->with('contacts', $contacts)
        ->with('categories', $categories)
        ->with('stationDjus', $stationDjus);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du poste d'éclairage est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('patrimoine/eclairage/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $eclairage = new Eclairages();
          $eclairage->MouvrageID = \Input::get('MouvrageID');
          $eclairage->BaseID = $baseid;
          $eclairage->Nom = \Input::get('Nom');
          $eclairage->CategorieID = \Input::get('CategorieID');
          $eclairage->Anneeconstruction = \Input::get('Anneeconstruction');
          $eclairage->Puissance = \Input::get('Puissance');
          $eclairage->Puissancemesuree = \Input::get('Puissancemesuree');
          $eclairage->Nbrpointlumineux = \Input::get('Nbrpointlumineux');
          $eclairage->Kmeclaires = \Input::get('Kmeclaires');
          $eclairage->Declencheur = \Input::get('Declencheur');
          $eclairage->NbrHeuresans = \Input::get('NbrHeuresans');
          $eclairage->StationdjuID = \Input::get('StationdjuID');
          $eclairage->Descriptif = \Input::get('Descriptif');
          $eclairage->CoordonneeID = \Input::get('CoordonneeID');
          $eclairage->Commentaire = \Input::get('Commentaire');
          
          $eclairage->save();

          Session::flash('eclairage.success', "Création du poste d'éclairage effectuée avec succès");
          return Redirect::to('patrimoine#eclairage');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $eclairage = Eclairages::find($id);

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $contacts = DB::select("select CoordonneeID, Nom + Prenom + Societe as Societe from coordonnee WHERE `Type`='MO' and `BaseID` = '".$baseid."' order by CoordonneeID");
      $contacts = $this->objectsToArray($contacts, 'CoordonneeID', 'Societe');

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =8 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $stationDjus = DB::select("select StationdjuID, Ville from stationdju WHERE `Actif`=1 and `BaseID` = '".$baseid."' order by Ville");
      $stationDjus = $this->objectsToArray($stationDjus, 'StationdjuID', 'Ville');
      
      return View::make('patrimoine.eclairage.edit')
        ->with('eclairage', $eclairage)
        ->with('mos', $mos)
        ->with('contacts', $contacts)
        ->with('categories', $categories)
        ->with('stationDjus', $stationDjus);
    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du poste d'éclairage est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('patrimoine/eclairage/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $eclairage = Eclairages::find($id);
          $eclairage->MouvrageID = \Input::get('MouvrageID');
          $eclairage->Nom = \Input::get('Nom');
          $eclairage->CategorieID = \Input::get('CategorieID');
          $eclairage->Anneeconstruction = \Input::get('Anneeconstruction');
          $eclairage->Puissance = \Input::get('Puissance');
          $eclairage->Puissancemesuree = \Input::get('Puissancemesuree');
          $eclairage->Nbrpointlumineux = \Input::get('Nbrpointlumineux');
          $eclairage->Kmeclaires = \Input::get('Kmeclaires');
          $eclairage->Declencheur = \Input::get('Declencheur');
          $eclairage->NbrHeuresans = \Input::get('NbrHeuresans');
          $eclairage->StationdjuID = \Input::get('StationdjuID');
          $eclairage->Descriptif = \Input::get('Descriptif');
          $eclairage->CoordonneeID = \Input::get('CoordonneeID');
          $eclairage->Commentaire = \Input::get('Commentaire');

          $eclairage->save();

          Session::flash('eclairage.success', "Mise-à-jour du poste d'éclairage effectuée avec succès");
          return Redirect::to('patrimoine#eclairage');
        }
    }

    public function destroy($id)
    {
      $eclairage = Eclairages::find($id);
      $eclairage->delete();

      // redirect
      Session::flash('eclairage.success', "Poste d'éclairage supprimé avec succès !");
      return Redirect::to('patrimoine#eclairage');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}