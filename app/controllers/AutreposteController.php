<?php

class AutreposteController extends \BaseController {

    public function index()
    {
      //TODO:redirect to eclairage#autreposte
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $contacts = DB::select("select CoordonneeID, Nom + Prenom + Societe as Societe from coordonnee WHERE `Type`='MO' and `BaseID` = '".$baseid."' order by CoordonneeID");
      $contacts = $this->objectsToArray($contacts, 'CoordonneeID', 'Societe');

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =7 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      return View::make('patrimoine.autreposte.create')
        ->with('mos', $mos)
        ->with('contacts', $contacts)
        ->with('categories', $categories);
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
          'Nom.required' => "Le nom du poste est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('patrimoine/autreposte/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $autreposte = new Autrepostes();
          $autreposte->MouvrageID = \Input::get('MouvrageID');
          $autreposte->BaseID = $baseid;
          $autreposte->Nom = \Input::get('Nom');
          $autreposte->CategorieID = \Input::get('CategorieID');
          $autreposte->Anneeconstruction = \Input::get('Anneeconstruction');
          $autreposte->Puissance = \Input::get('Puissance');
          $autreposte->Adresse1 = \Input::get('Adresse1');
          $autreposte->Adresse2 = \Input::get('Adresse2');
          $autreposte->Adresse3 = \Input::get('Adresse3');
          $autreposte->Codepostal = \Input::get('Codepostal');
          $autreposte->Ville = \Input::get('Ville');
          $autreposte->Pays = \Input::get('Pays');
          $autreposte->Cadastre = \Input::get('Cadastre');
          $autreposte->Latitude = \Input::get('Latitude');
          $autreposte->Longitude = \Input::get('Longitude');
          $autreposte->Descriptif = \Input::get('Descriptif');
          $autreposte->CoordonneeID = \Input::get('CoordonneeID');
          $autreposte->Commentaire = \Input::get('Commentaire');

          $autreposte->save();

          Session::flash('autreposte.success', "Création du poste effectuée avec succès");
          return Redirect::to('patrimoine#autreposte');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $autreposte = Autrepostes::find($id);

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');
      
      $contacts = DB::select("select CoordonneeID, Nom + Prenom + Societe as Societe from coordonnee WHERE `Type`='MO' and `BaseID` = '".$baseid."' order by CoordonneeID");
      $contacts = $this->objectsToArray($contacts, 'CoordonneeID', 'Societe');

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =7 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      return View::make('patrimoine.autreposte.edit')
        ->with('autreposte', $autreposte)
        ->with('mos', $mos)
        ->with('contacts', $contacts)
        ->with('categories', $categories);
    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du poste est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('patrimoine/autreposte/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $autreposte = Autrepostes::find($id);
          $autreposte->MouvrageID = \Input::get('MouvrageID');
          $autreposte->Nom = \Input::get('Nom');
          $autreposte->CategorieID = \Input::get('CategorieID');
          $autreposte->Anneeconstruction = \Input::get('Anneeconstruction');
          $autreposte->Puissance = \Input::get('Puissance');
          $autreposte->Adresse1 = \Input::get('Adresse1');
          $autreposte->Adresse2 = \Input::get('Adresse2');
          $autreposte->Adresse3 = \Input::get('Adresse3');
          $autreposte->Codepostal = \Input::get('Codepostal');
          $autreposte->Ville = \Input::get('Ville');
          $autreposte->Pays = \Input::get('Pays');
          $autreposte->Cadastre = \Input::get('Cadastre');
          $autreposte->Latitude = \Input::get('Latitude');
          $autreposte->Longitude = \Input::get('Longitude');
          $autreposte->Descriptif = \Input::get('Descriptif');
          $autreposte->CoordonneeID = \Input::get('CoordonneeID');
          $autreposte->Commentaire = \Input::get('Commentaire');

          $autreposte->save();

          Session::flash('autreposte.success', "Mise-à-jour du poste effectuée avec succès");
          return Redirect::to('patrimoine#autreposte');
        }
    }

    public function destroy($id)
    {
      $autreposte = Autrepostes::find($id);
      $autreposte->delete();

      // redirect
      Session::flash('autreposte.success', "Poste supprimé avec succès !");
      return Redirect::to('patrimoine#autreposte');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}