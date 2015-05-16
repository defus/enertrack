<?php

class PosteproductionController extends \BaseController {

    public function index()
    {
      //TODO:redirect to eclairage#posteproduction
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $contacts = DB::select("select CoordonneeID, Nom + Prenom + Societe as Societe from coordonnee WHERE `Type`='MO' and `BaseID` = '".$baseid."' order by CoordonneeID");
      $contacts = $this->objectsToArray($contacts, 'CoordonneeID', 'Societe');

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =9 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $stationdjus = DB::select("select StationdjuID, Ville from stationdju WHERE `Actif`=1 and `BaseID` = '".$baseid."' order by Ville");
      $stationdjus = $this->objectsToArray($stationdjus, 'StationdjuID', 'Ville');

      return View::make('patrimoine.posteproduction.create')
        ->with('mos', $mos)
        ->with('contacts', $contacts)
        ->with('categories', $categories)
        ->with('stationdjus', $stationdjus);
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
          'Nom.required' => "Le nom du poste de production est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('patrimoine/posteproduction/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $posteproduction = new Posteproductions();
          $posteproduction->MouvrageID = \Input::get('MouvrageID');
          $posteproduction->BaseID = $baseid;
          $posteproduction->Nom = \Input::get('Nom');
          $posteproduction->CategorieID = \Input::get('CategorieID');
          $posteproduction->Adresse1 = \Input::get('Adresse1');
          $posteproduction->Adresse2 = \Input::get('Adresse2');
          $posteproduction->Adresse3 = \Input::get('Adresse3');
          $posteproduction->Codepostal = \Input::get('Codepostal');
          $posteproduction->Ville = \Input::get('Ville');
          $posteproduction->Pays = \Input::get('Pays');
          $posteproduction->Anneeconstruction = \Input::get('Anneeconstruction');
          $posteproduction->Productiontheorique = \Input::get('Productiontheorique');
          $posteproduction->Coutinitial = \Input::get('Coutinitial');
          $posteproduction->StationdjuID = \Input::get('StationdjuID');
          $posteproduction->Cadastre = \Input::get('Cadastre');
          $posteproduction->Latitude = \Input::get('Latitude');
          $posteproduction->Longitude = \Input::get('Longitude');
          $posteproduction->Description = \Input::get('Description');
          $posteproduction->CoordonneeID = \Input::get('CoordonneeID');
          $posteproduction->Commentaire = \Input::get('Commentaire');
          
          $posteproduction->save();

          Session::flash('posteproduction.success', "Création du poste de production effectuée avec succès");
          return Redirect::to('patrimoine#posteproduction');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $posteproduction = Posteproductions::find($id);

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');
      
      $contacts = DB::select("select CoordonneeID, Nom + Prenom + Societe as Societe from coordonnee WHERE `Type`='MO' and `BaseID` = '".$baseid."' order by CoordonneeID");
      $contacts = $this->objectsToArray($contacts, 'CoordonneeID', 'Societe');

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =9 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $stationdjus = DB::select("select StationdjuID, Ville from stationdju WHERE `Actif`=1 and `BaseID` = '".$baseid."' order by Ville");
      $stationdjus = $this->objectsToArray($stationdjus, 'StationdjuID', 'Ville');

      return View::make('patrimoine.posteproduction.edit')
        ->with('posteproduction', $posteproduction)
        ->with('mos', $mos)
        ->with('contacts', $contacts)
        ->with('categories', $categories)
        ->with('stationdjus', $stationdjus);
    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du poste de production est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('patrimoine/posteproduction/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $posteproduction = Posteproductions::find($id);
          $posteproduction->MouvrageID = \Input::get('MouvrageID');
          $posteproduction->Nom = \Input::get('Nom');
          $posteproduction->CategorieID = \Input::get('CategorieID');
          $posteproduction->Adresse1 = \Input::get('Adresse1');
          $posteproduction->Adresse2 = \Input::get('Adresse2');
          $posteproduction->Adresse3 = \Input::get('Adresse3');
          $posteproduction->Codepostal = \Input::get('Codepostal');
          $posteproduction->Ville = \Input::get('Ville');
          $posteproduction->Pays = \Input::get('Pays');
          $posteproduction->Anneeconstruction = \Input::get('Anneeconstruction');
          $posteproduction->Productiontheorique = \Input::get('Productiontheorique');
          $posteproduction->Coutinitial = \Input::get('Coutinitial');
          $posteproduction->StationdjuID = \Input::get('StationdjuID');
          $posteproduction->Cadastre = \Input::get('Cadastre');
          $posteproduction->Latitude = \Input::get('Latitude');
          $posteproduction->Longitude = \Input::get('Longitude');
          $posteproduction->Description = \Input::get('Description');
          $posteproduction->CoordonneeID = \Input::get('CoordonneeID');
          $posteproduction->Commentaire = \Input::get('Commentaire');

          $posteproduction->save();

          Session::flash('posteproduction.success', "Mise-à-jour du poste de production effectuée avec succès");
          return Redirect::to('patrimoine#posteproduction');
        }
    }

    public function destroy($id)
    {
      $posteproduction = Posteproductions::find($id);
      $posteproduction->delete();

      // redirect
      Session::flash('posteproduction.success', "Poste de production supprimé avec succès !");
      return Redirect::to('patrimoine#posteproduction');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}