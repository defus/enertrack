<?php

class MoController extends \BaseController {

    public function index()
    {
      $mos = Mos::orderBy('MouvrageID', 'ASC')->get();
      return  View::make('mo.index')->with('mos', $mos);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =36 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $bes = DB::select("select CoordonneeID, Societe from coordonnee WHERE  Type='BE' AND `BaseID` = '".$baseid."' order by Societe");
      $bes = $this->objectsToArray($bes, 'CoordonneeID', 'Societe');
      
      $stationMeteos = DB::select("select StationmeteoID, Ville from stationmeteo WHERE `BaseID` = '".$baseid."' order by Ville");
      $stationMeteos = $this->objectsToArray($stationMeteos, 'StationmeteoID', 'Ville');
      
      $stationDjus = DB::select("select StationdjuID, Ville from stationdju WHERE `Actif`=1 and `BaseID` = '".$baseid."' order by Ville");
      $stationDjus = $this->objectsToArray($stationDjus, 'StationdjuID', 'Ville');
      
      return View::make('mo.create')
        ->with('categories', $categories)
        ->with('bes', $bes)
        ->with('stationMeteos', $stationMeteos)
        ->with('stationDjus', $stationDjus);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::except('Logo'), 
        array(
          'Societe' => 'required',
          'CategorieID' => 'required',
          'Codepostal' => 'numeric'
          ), 
        array(
          'Societe.required' => "Le libelé du maitre d'ouvrage est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('mo/create')
              ->withErrors($validation)
              ->withInput(\Input::except('Logo'));
        } else {
          $mo = new Mos();
          $mo->Societe = \Input::get('Societe');
          $mo->BaseID = $baseid;
          $mo->CategorieID = \Input::get('CategorieID');
          $mo->Codepostal = \Input::get('Codepostal');
          $mo->Ville = \Input::get('Ville');
          $mo->Commentaire = \Input::get('Commentaire');
          $mo->BureauetudeID = \Input::get('BureauetudeID');
          $mo->StationdjuID = \Input::get('StationdjuID');
          $mo->StationmeteoID = \Input::get('StationmeteoID');
          $mo->Estmodifie = \Input::get('Estmodifie');
          
          if (Input::hasFile('Logo')) {
            $file            = Input::file('Logo');
            $destinationPath = Config::get('enertrack.LOGO_DIR');
            $filename        = $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);

            $mo->Logo = $file->getClientOriginalName();
          }

          $mo->save();

          Session::flash('success', "Création du maitre d'ouvrage effectué avec succès");
          return Redirect::to('mo');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =36 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $bes = DB::select("select CoordonneeID, Societe from coordonnee WHERE  Type='BE' AND `BaseID` = '".$baseid."' order by Societe");
      $bes = $this->objectsToArray($bes, 'CoordonneeID', 'Societe');
      
      $stationMeteos = DB::select("select StationmeteoID, Ville from stationmeteo WHERE `BaseID` = '".$baseid."' order by Ville");
      $stationMeteos = $this->objectsToArray($stationMeteos, 'StationmeteoID', 'Ville');
      
      $stationDjus = DB::select("select StationdjuID, Ville from stationdju WHERE `Actif`=1 and `BaseID` = '".$baseid."' order by Ville");
      $stationDjus = $this->objectsToArray($stationDjus, 'StationdjuID', 'Ville');

      $mo = Mos::find($id);

      return View::make('mo.edit')
        ->with('mo', $mo)
        ->with('categories', $categories)
        ->with('bes', $bes)
        ->with('stationMeteos', $stationMeteos)
        ->with('stationDjus', $stationDjus);
    }

    public function update($id){

      $validation = Validator::make(\Input::except('Logo'), 
        array(
          'Societe' => 'required',
          'CategorieID' => 'required',
          'Codepostal' => 'numeric'
          ), 
        array(
          'Societe.required' => "Le libelé du maitre d'ouvrage est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('mo/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\except('Logo'));
        } else {
          $mo = Mos::find($id);
          $mo->Societe = \Input::get('Societe');
          $mo->CategorieID = \Input::get('CategorieID');
          $mo->Codepostal = \Input::get('Codepostal');
          $mo->Ville = \Input::get('Ville');
          $mo->Commentaire = \Input::get('Commentaire');
          $mo->BureauetudeID = \Input::get('BureauetudeID');
          $mo->StationdjuID = \Input::get('StationdjuID');
          $mo->StationmeteoID = \Input::get('StationmeteoID');
          $mo->Estmodifie = \Input::get('Estmodifie');
          
          if (Input::hasFile('Logo')) {
            $file            = Input::file('Logo');
            $destinationPath = Config::get('enertrack.LOGO_DIR');
            $filename        = $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);

            $mo->Logo = $file->getClientOriginalName();
          }

          $mo->save();

          Session::flash('success', "Mise-à-jour du maitre d'ouvrage effectuée avec succès");
          return Redirect::to('mo');
        }
    }

    public function destroy($id)
    {
      $mo = Mos::find($id);
      $mo->delete();

      // redirect
      Session::flash('success', "Maitre d'ouvrage supprimé avec succès !");
      return Redirect::to('mo');
    }

    public function download($image){
      $file = Config::get('enertrack.LOGO_DIR') . "/" . $image;
      /*$headers = array(
            'Content-Type: application/pdf',
          );
      return Response::download($file, 'filename.pdf', $headers);*/
      return Response::download($file);
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}