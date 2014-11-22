<?php

class BatimentController extends \BaseController {

    public function index()
    {
      //TODO:redirect to partioine#batiment
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $contacts = DB::select("select CoordonneeID, Nom + Prenom + Societe as Societe from coordonnee WHERE `Type`='MO' and `BaseID` = '".$baseid."' order by CoordonneeID");
      $contacts = $this->objectsToArray($contacts, 'CoordonneeID', 'Societe');

      $stationDjus = DB::select("select StationdjuID, Ville from stationdju WHERE `Actif`=1 and `BaseID` = '".$baseid."' order by Ville");
      $stationDjus = $this->objectsToArray($stationDjus, 'StationdjuID', 'Ville');
      
      return View::make('patrimoine.batiment.create')
        ->with('mos', $mos)
        ->with('contacts', $contacts)
        ->with('stationDjus', $stationDjus);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required',
          'Anneeconstruction' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du batiment est obligatoire !",
          'Anneeconstruction.required' => "L'année de construction du batiment est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('patrimoine/batiment/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $batiment = new Batiments();
          $batiment->MouvrageID = \Input::get('MouvrageID');
          $batiment->BaseID = $baseid;
          $batiment->Nom = \Input::get('Nom');
          $batiment->Adresse1 = \Input::get('Adresse1');
          $batiment->Adresse2 = \Input::get('Adresse2');
          $batiment->Adresse3 = \Input::get('Adresse3');
          $batiment->Codepostal = \Input::get('Codepostal');
          $batiment->Ville = \Input::get('Ville');
          $batiment->Pays = \Input::get('Pays');
          $batiment->Cadastre = \Input::get('Cadastre');
          $batiment->CoordonneeID = \Input::get('CoordonneeID');
          $batiment->Anneeconstruction = \Input::get('Anneeconstruction');
          $batiment->Patrimoine = \Input::get('Patrimoine');
          $batiment->Voisinage = \Input::get('Voisinage');
          $batiment->Orientation = \Input::get('Orientation');
          $batiment->Exposition = \Input::get('Exposition');
          $batiment->altitude = \Input::get('altitude');
          $batiment->Latitude = \Input::get('Latitude');
          $batiment->Longitude = \Input::get('Longitude');
          $batiment->StationdjuID = \Input::get('StationdjuID');
          $batiment->Commentaire = \Input::get('Commentaire');
          
          $batiment->save();

          Session::flash('batiment.success', "Création du batiment effectué avec succès");
          return Redirect::to('patrimoine#batiment');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $batiment = Batiments::find($id);

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $contacts = DB::select("select CoordonneeID, Nom + Prenom + Societe as Societe from coordonnee WHERE `Type`='MO' and `BaseID` = '".$baseid."' order by CoordonneeID");
      $contacts = $this->objectsToArray($contacts, 'CoordonneeID', 'Societe');

      $stationDjus = DB::select("select StationdjuID, Ville from stationdju WHERE `Actif`=1 and `BaseID` = '".$baseid."' order by Ville");
      $stationDjus = $this->objectsToArray($stationDjus, 'StationdjuID', 'Ville');
      
      return View::make('patrimoine.batiment.edit')
        ->with('batiment', $batiment)
        ->with('mos', $mos)
        ->with('contacts', $contacts)
        ->with('stationDjus', $stationDjus);
    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required',
          'Anneeconstruction' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du batiment est obligatoire !",
          'Anneeconstruction.required' => "L'année de construction du batiment est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('patrimoine/batiment/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $batiment = Batiments::find($id);
          $batiment->MouvrageID = \Input::get('MouvrageID');
          $batiment->Nom = \Input::get('Nom');
          $batiment->Adresse1 = \Input::get('Adresse1');
          $batiment->Adresse2 = \Input::get('Adresse2');
          $batiment->Adresse3 = \Input::get('Adresse3');
          $batiment->Codepostal = \Input::get('Codepostal');
          $batiment->Ville = \Input::get('Ville');
          $batiment->Pays = \Input::get('Pays');
          $batiment->Cadastre = \Input::get('Cadastre');
          $batiment->CoordonneeID = \Input::get('CoordonneeID');
          $batiment->Anneeconstruction = \Input::get('Anneeconstruction');
          $batiment->Patrimoine = \Input::get('Patrimoine');
          $batiment->Voisinage = \Input::get('Voisinage');
          $batiment->Orientation = \Input::get('Orientation');
          $batiment->Exposition = \Input::get('Exposition');
          $batiment->altitude = \Input::get('altitude');
          $batiment->Latitude = \Input::get('Latitude');
          $batiment->Longitude = \Input::get('Longitude');
          $batiment->StationdjuID = \Input::get('StationdjuID');
          $batiment->Commentaire = \Input::get('Commentaire');

          $batiment->save();

          Session::flash('batiment.success', "Mise-à-jour du batiment effectuée avec succès");
          return Redirect::to('patrimoine#batiment');
        }
    }

    public function destroy($id)
    {
      $batiment = Batiments::find($id);
      $batiment->delete();

      // redirect
      Session::flash('batiment.success', "Batiment supprimé avec succès !");
      return Redirect::to('patrimoine');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}