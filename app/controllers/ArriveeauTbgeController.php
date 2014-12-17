<?php

class ArriveeauTbgeController extends \BaseController {

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $arriveeaux = DB::select("SELECT arriveeau.*, mouvrage.Societe, coordonnee.Societe as Contact FROM arriveeau INNER JOIN mouvrage ON mouvrage.MouvrageID = arriveeau.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = arriveeau.CoordonneeID WHERE arriveeau.BaseID='$baseid'");

      return  View::make('tbge.patrimoine.arriveeau.index')
        ->with('arriveeaux', $arriveeaux);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID;

      $compteurEaux = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') ORDER BY compteur.EnergieID, compteur.Numero, compteur.Reference  ");

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') ORDER BY compteur.EnergieID, compteur.Numero, compteur.Reference  ");
      
      return View::make('tbge.patrimoine.arriveeau.create')
        ->with('compteurEaux', $compteurEaux)
        ->with('compteurElectricites', $compteurElectricites);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom du point d'arrivée d'eau est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/arriveeau/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $arriveeau = new Arriveeaux();
          $arriveeau->MouvrageID = Config::get('enertrack.MouvrageID');
          $arriveeau->BaseID = $baseid;
          $arriveeau->Reference = \Input::get('Reference');
          $arriveeau->Nom = \Input::get('Nom');
          $arriveeau->Adresse1 = \Input::get('Adresse1');
          $arriveeau->Adresse2 = \Input::get('Adresse2');
          $arriveeau->Adresse3 = \Input::get('Adresse3');
          $arriveeau->altitude = \Input::get('altitude');
          $arriveeau->Latitude = \Input::get('Latitude');
          $arriveeau->Longitude = \Input::get('Longitude');
          $arriveeau->Surface = \Input::get('Surface');
          $arriveeau->SurfaceIrrigue = \Input::get('SurfaceIrrigue');
          $arriveeau->Forage = (\Input::has('Forage')) ? 1 : 0;
          $arriveeau->AlignementArbre = \Input::get('AlignementArbre');
          
          $arriveeau->save();

          //Ajouter les associations compteurs
          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurs_arr = \Input::get('compteurElectricitesID');
            foreach($compteurs_arr as $compteur_id){
              $compteurarriveeau = new Compteurarriveeaux();
              $compteurarriveeau->ArriveeauID = $arriveeau->ArriveeauID;
              $compteurarriveeau->CompteurID = $compteur_id;
              $compteurarriveeau->BaseID = $baseid;
              $compteurarriveeau->Pourcentage = 100;
              $compteurarriveeau->save();
            }
          }
          if(is_array(\Input::get('compteurEauxID'))){
            $compteurs_arr = \Input::get('compteurEauxID');
            foreach($compteurs_arr as $compteur_id){
              $compteurarriveeau = new Compteurarriveeaux();
              $compteurarriveeau->ArriveeauID = $arriveeau->ArriveeauID;
              $compteurarriveeau->CompteurID = $compteur_id;
              $compteurarriveeau->BaseID = $baseid;
              $compteurarriveeau->Pourcentage = 100;
              $compteurarriveeau->save();
            }
          }

          $modifierUrl = URL::to('tbge/patrimoine/arriveeau/' . $arriveeau->ArriveeauID . '/edit');
          Session::flash('arriveeau.success', "<p>Création du point d'arrivée d'eau effectuée avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le point d'arrivée d'eau</a></p>");
          return Redirect::to('tbge/patrimoine/arriveeau');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $arriveeau = Arriveeaux::find($id);

      $compteurEaux = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') ORDER BY compteur.EnergieID, compteur.Numero, compteur.Reference  ");

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') ORDER BY compteur.EnergieID, compteur.Numero, compteur.Reference  ");
      
      $compteurEauxSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurarriveeaux on ( compteur.CompteurID=compteurarriveeaux.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') and compteurarriveeaux.ArriveeauID={$arriveeau->ArriveeauID}");
      $compteurEauxSelected = $this->objectsToArray($compteurEauxSelected, 'CompteurID', 'CompteurID');

      $compteurElectricitesSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurarriveeaux on ( compteur.CompteurID=compteurarriveeaux.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') and compteurarriveeaux.ArriveeauID={$arriveeau->ArriveeauID}");
      $compteurElectricitesSelected = $this->objectsToArray($compteurElectricitesSelected, 'CompteurID', 'CompteurID');

      return View::make('tbge.patrimoine.arriveeau.edit')
        ->with('arriveeau', $arriveeau)
        ->with('compteurEaux', $compteurEaux)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('compteurEauxSelected', $compteurEauxSelected)
        ->with('compteurElectricitesSelected', $compteurElectricitesSelected);
    }

    public function update($id){
      $baseid = Auth::user()->BaseID; ;

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom du point d'arrivée d'eau est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/arriveeau/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $arriveeau = Arriveeaux::find($id);
          $arriveeau->MouvrageID = Config::get('enertrack.MouvrageID');
          $arriveeau->Reference = \Input::get('Reference');
          $arriveeau->Nom = \Input::get('Nom');
          $arriveeau->Adresse1 = \Input::get('Adresse1');
          $arriveeau->Adresse2 = \Input::get('Adresse2');
          $arriveeau->Adresse3 = \Input::get('Adresse3');
          $arriveeau->altitude = \Input::get('altitude');
          $arriveeau->Latitude = \Input::get('Latitude');
          $arriveeau->Longitude = \Input::get('Longitude');
          $arriveeau->Surface = \Input::get('Surface');
          $arriveeau->SurfaceIrrigue = \Input::get('SurfaceIrrigue');
          $arriveeau->Forage = (\Input::has('Forage')) ? 1 : 0;
          $arriveeau->AlignementArbre = \Input::get('AlignementArbre');

          $arriveeau->save();

          //Mettre à jour les associations compteur
          if(is_array(\Input::get('compteurEauxID'))){
            $compteurarriveeau_ids = array();
            $compteur_arr = \Input::get('compteurEauxID');
            foreach ($compteur_arr as $key => $compteur_id){
              $size = Compteurarriveeaux::where('CompteurID', $compteur_id)->where('ArriveeauID',  $arriveeau->ArriveeauID)->count();
              if($size <= 0){
                $compteurarriveeau = new Compteurarriveeaux();
                $compteurarriveeau->ArriveeauID = $arriveeau->ArriveeauID;
                $compteurarriveeau->CompteurID = $compteur_id;
                $compteurarriveeau->BaseID = $baseid;
                $compteurarriveeau->Pourcentage = 100;
                $compteurarriveeau->save();
              }
              $compteurarriveeau_ids[] = $compteur_id;
            }

            $existing_compteurarriveeaux = DB::select("SELECT compteur.CompteurID, compteurarriveeaux.ArriveeauID FROM compteur inner join compteurarriveeaux on ( compteur.CompteurID=compteurarriveeaux.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') and compteurarriveeaux.ArriveeauID={$arriveeau->ArriveeauID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
            foreach ($existing_compteurarriveeaux as $compteurarriveeau){
              if(!in_array($compteurarriveeau->CompteurID, $compteurarriveeau_ids)){
                DB::table('compteurarriveeaux')->where('CompteurID', $compteurarriveeau->CompteurID)->where('ArriveeauID', $compteurarriveeau->ArriveeauID)->delete();
              }
            }
          }

          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurarriveeau_ids = array();
            $compteur_arr = \Input::get('compteurElectricitesID');
            foreach ($compteur_arr as $key => $compteur_id){
              $size = Compteurarriveeaux::where('CompteurID', $compteur_id)->where('ArriveeauID',  $arriveeau->ArriveeauID)->count();
              if($size <= 0){
                $compteurarriveeau = new Compteurarriveeaux();
                $compteurarriveeau->ArriveeauID = $arriveeau->ArriveeauID;
                $compteurarriveeau->CompteurID = $compteur_id;
                $compteurarriveeau->BaseID = $baseid;
                $compteurarriveeau->Pourcentage = 100;
                $compteurarriveeau->save();
              }
              $compteurarriveeau_ids[] = $compteur_id;
            }

            $existing_compteurarriveeaux = DB::select("SELECT compteur.CompteurID, compteurarriveeaux.ArriveeauID FROM compteur inner join compteurarriveeaux on ( compteur.CompteurID=compteurarriveeaux.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') and compteurarriveeaux.ArriveeauID={$arriveeau->ArriveeauID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
            foreach ($existing_compteurarriveeaux as $compteurarriveeau){
              if(!in_array($compteurarriveeau->CompteurID, $compteurarriveeau_ids)){
                DB::table('compteurarriveeaux')->where('CompteurID', $compteurarriveeau->CompteurID)->where('ArriveeauID', $compteurarriveeau->ArriveeauID)->delete();
              }
            }
          }

          $modifierUrl = URL::to('tbge/patrimoine/arriveeau/' . $arriveeau->ArriveeauID . '/edit');
          Session::flash('arriveeau.success', "<p>Mise-à-jour du point d'arrivée d'eau effectuée avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le point d'arrivée d'eau</a></p>");
          return Redirect::to('tbge/patrimoine/arriveeau');
        }
    }

    public function destroy($id)
    {
      $arriveeau = Arriveeaux::find($id);
      $arriveeau->delete();

      // redirect
      Session::flash('arriveeau.success', "Point d'arrivée d'eau supprimé avec succès !");
      return Redirect::to('tbge.patrimoine/arriveeau');
    }

    public function importCsv()
    {
      $baseid = Auth::user()->BaseID; 

      return  View::make('tbge.patrimoine.arriveeau.importcsv');
    }


    public function importCsvPosted()
    {
      $baseid = Auth::user()->BaseID; 

      if (Input::hasFile('csvFile')) {
        $file            = Input::file('csvFile');
        $extension = $file->getClientOriginalExtension();
        if('csv' !== $extension){
          return Redirect::to('tbge/patrimoine/arriveeau/import/csv')
              ->with('message.error', "Le fichier à importer doit-être de type CSV !");
        }

        $file_name = $file->getClientOriginalName();
        $file_path = $file->getRealPath();

        if (($handle = fopen($file_path, "r")) === FALSE) {
          return Redirect::to('tbge/patrimoine/arriveeau/import/csv')
              ->with('message.error', "Erreur fatale lors de l'ouverture du fichier importé !");
        }

        $tableau_data = array();
        $tableau_head = array();
        while(($data = fgetcsv($handle, 0, ";")) !== FALSE){
          if(empty($tableau_head)){
            $tableau_head = $data;
          }else{
            $tableau_data[] = $data;
          }
        }
        fclose($handle);
        return  View::make('tbge.patrimoine.arriveeau.importcsvimported')
          ->with('header', $tableau_head)
          ->with('data', $tableau_data);
      }

      return  View::make('tbge.patrimoine.arriveeau.importcsv');
    }

    public function doImport(){
      $baseid = Auth::user()->BaseID; 

      DB::beginTransaction();

      DB::statement('SET FOREIGN_KEY_CHECKS=0;');

      DB::table('compteurarriveeaux')->truncate();
      DB::table('arriveeau')->truncate();

      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      
      Validator::extend('forageValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          if(in_array($value, array(1, 0))){
            return true;
          }
          return false;
      });

      Validator::extend('compteursValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          $compteurElectricites = explode("-", $value);
          if(is_array($compteurElectricites)){
            foreach ($compteurElectricites as $key => $compteurElectriciteReference) {
              $compteurs = Compteurs::where('Reference', $compteurElectriciteReference);
              if(count($compteurs) > 0){
                return true;
              }else{
                return false;
              }
            }
          }
      });

      $selected = \Input::get('selecte');
      $data = \Input::get('col');

      $nombreLigneImportee = 0;

      foreach ($selected as $rowIndex => $rowChecked) {
        if($rowChecked === '1'){
          $row = $data[$rowIndex];
          
          $validation = Validator::make($row, 
            array(
              'Reference' => 'required',
              'Nom' => 'required',
              "Compteurs" => 'compteursValide',
              "CompteurElectricites" => 'compteursValide',
              'Forage' => 'forageValide'
              ), array(
                'required' => "Le champ :attribute est obligatoire"
              )
          );

          if ($validation->fails()) {
              dd($row);
              return Redirect::to('tbge/patrimoine/arriveeau/import/csv')
                  ->withErrors($validation);
          } else {
            
            $arriveeau = new Arriveeaux();
            $arriveeau->MouvrageID = Config::get('enertrack.MouvrageID');
            $arriveeau->BaseID = $baseid;
            $arriveeau->Reference = $row['Reference'];
            $arriveeau->Nom = $row['Nom'];
            $arriveeau->Adresse1 = $row['Adresse1'];
            $arriveeau->Adresse2 = null;
            $arriveeau->Adresse3 = null;
            $arriveeau->altitude = null;
            $arriveeau->Latitude = null;
            $arriveeau->Longitude = null;
            $arriveeau->Surface = $row['Surface'];
            $arriveeau->SurfaceIrrigue = $row['SurfaceIrrigue'];
            $arriveeau->Forage = $row['Forage'];
            $arriveeau->AlignementArbre = $row['AlignementArbre'];

            $arriveeau->save();

            $compteurElectricites = explode("-", $row['Compteurs']);
            if(is_array($compteurElectricites)){
              foreach ($compteurElectricites as $key => $compteurElectriciteReference) {
                $compteurs = Compteurs::where('Reference', $compteurElectriciteReference)->get();
                if(count($compteurs) > 0){
                  $compteurarriveeau = new Compteurarriveeaux();
                  $compteurarriveeau->ArriveeauID = $arriveeau->ArriveeauID;
                  $compteurarriveeau->CompteurID = $compteurs[0]->CompteurID;
                  $compteurarriveeau->BaseID = $baseid;
                  $compteurarriveeau->Pourcentage = 100;
                  $compteurarriveeau->save();               
                }
              }
            }

            $compteurElectricites = explode("-", $row['CompteurElectricites']);
            if(is_array($compteurElectricites)){
              foreach ($compteurElectricites as $key => $compteurElectriciteReference) {
                $compteurs = Compteurs::where('Reference', $compteurElectriciteReference)->get();
                if(count($compteurs) > 0){
                  $compteurarriveeau = new Compteurarriveeaux();
                  $compteurarriveeau->ArriveeauID = $arriveeau->ArriveeauID;
                  $compteurarriveeau->CompteurID = $compteurs[0]->CompteurID;
                  $compteurarriveeau->BaseID = $baseid;
                  $compteurarriveeau->Pourcentage = 100;
                  $compteurarriveeau->save();               
                }
              }
            }

            $nombreLigneImportee = $nombreLigneImportee + 1;
          }
        }
      }


      DB::commit();

      Session::flash('success', "<p>Points d'arrivée d'eau importés avec succès ! $nombreLigneImportee lignes importées </p>");
      return Redirect::to('tbge/patrimoine/arriveeau');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}