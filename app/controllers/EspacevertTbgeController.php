<?php

class EspacevertTbgeController extends \BaseController {
    public static $categories = array('Jardins publics' => 'Jardins publics', 'Voie publique' => 'Voie publique', 'Terrain sportif' => 'Terrain sportif', 'Mixte' => 'Mixte');
    public static $systemearrosages = array(1 => 'Manuel : tuyau d’arrosage', 2 => 'Goutteur isolé', 3 => 'Microjets', 4 => 'Turbine et tuyère escamotables', 5 => 'Enrouleur');

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $espaceverts = DB::select("SELECT espacevert.*, mouvrage.Societe, coordonnee.Societe as Contact FROM espacevert INNER JOIN mouvrage ON mouvrage.MouvrageID = espacevert.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = espacevert.CoordonneeID WHERE espacevert.BaseID='$baseid'");

      return  View::make('tbge.patrimoine.espacevert.index')
        ->with('espaceverts', $espaceverts);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $compteurEaux = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Numero, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      //$compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");
      
      $arriveeaux = DB::select("select ArriveeauID, Nom from arriveeau Where BaseID='$baseid'");

      return View::make('tbge.patrimoine.espacevert.create')
        ->with('compteurEaux', $compteurEaux)
        //->with('compteurElectricites', $compteurElectricites)
        ->with('systemearrosages', self::$systemearrosages)
        ->with('categories', self::$categories)
        ->with('arriveeaux', $arriveeaux);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom de l'espace vert est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/espacevert/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $espacevert = new Espaceverts();
          $espacevert->MouvrageID = Config::get('enertrack.MouvrageID');
          $espacevert->BaseID = $baseid;
          $espacevert->Nom = \Input::get('Nom');
          $espacevert->Adresse1 = \Input::get('Adresse1');
          $espacevert->Adresse2 = \Input::get('Adresse2');
          $espacevert->Adresse3 = \Input::get('Adresse3');
          $espacevert->altitude = \Input::get('altitude');
          $espacevert->Latitude = \Input::get('Latitude');
          $espacevert->Longitude = \Input::get('Longitude');
          $espacevert->Surface = \Input::get('Surface');
          $espacevert->SurfaceIrrigue = \Input::get('SurfaceIrrigue');
          $espacevert->Forage = (\Input::has('Forage')) ? 1 : 0;
          $espacevert->SystArrosage = \Input::get('SystArrosage');
          $espacevert->Reference = \Input::get('Reference');
          $espacevert->ArriveeauID = \Input::get('ArriveeauID');
          $espacevert->Categorie = \Input::get('Categorie');

          $espacevert->save();

          //Ajouter les associations compteurs
          /*if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurs_arr = \Input::get('compteurElectricitesID');
            foreach($compteurs_arr as $compteur_id){
              $compteurespacevert = new Compteurespaceverts();
              $compteurespacevert->EspacevertID = $espacevert->EspacevertID;
              $compteurespacevert->CompteurID = $compteur_id;
              $compteurespacevert->BaseID = $baseid;
              $compteurespacevert->Pourcentage = 100;
              $compteurespacevert->save();
            }
          }*/
          if(is_array(\Input::get('compteurEauxID'))){
            $compteurs_arr = \Input::get('compteurEauxID');
            foreach($compteurs_arr as $compteur_id){
              $compteurespacevert = new Compteurespaceverts();
              $compteurespacevert->EspacevertID = $espacevert->EspacevertID;
              $compteurespacevert->CompteurID = $compteur_id;
              $compteurespacevert->BaseID = $baseid;
              $compteurespacevert->Pourcentage = 100;
              $compteurespacevert->save();
            }
          }

          $modifierUrl = URL::to('tbge/patrimoine/espacevert/' . $espacevert->EspacevertID . '/edit');
          Session::flash('espacevert.success', "<p>Création de l'espace vert effectuée avec succès  ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le point d'arrivée d'eau</a></p>");
          return Redirect::to('tbge/patrimoine/espacevert');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $espacevert = Espaceverts::find($id);

      $compteurEaux = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Numero, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      //$compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");
      
      $compteurEauxSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurespaceverts on ( compteur.CompteurID=compteurespaceverts.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') and compteurespaceverts.EspacevertID={$espacevert->EspacevertID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      $compteurEauxSelected = $this->objectsToArray($compteurEauxSelected, 'CompteurID', 'CompteurID');

      //$compteurElectricitesSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurespaceverts on ( compteur.CompteurID=compteurespaceverts.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') and compteurespaceverts.EspacevertID={$espacevert->EspacevertID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      //$compteurElectricitesSelected = $this->objectsToArray($compteurElectricitesSelected, 'CompteurID', 'CompteurID');

      $arriveeaux = DB::select("select ArriveeauID, Nom from arriveeau Where BaseID='$baseid'");

      return View::make('tbge.patrimoine.espacevert.edit')
        ->with('systemearrosages', self::$systemearrosages)
        ->with('espacevert', $espacevert)
        ->with('compteurEaux', $compteurEaux)
        //->with('compteurElectricites', $compteurElectricites)
        ->with('compteurEauxSelected', $compteurEauxSelected)
        //->with('compteurElectricitesSelected', $compteurElectricitesSelected)
        ->with('categories', self::$categories)
        ->with('arriveeaux', $arriveeaux);
    }

    public function update($id){
      $baseid = Auth::user()->BaseID; ;

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom de l'espace vert est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/espacevert/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $espacevert = Espaceverts::find($id);
          $espacevert->MouvrageID = Config::get('enertrack.MouvrageID');
          $espacevert->Nom = \Input::get('Nom');
          $espacevert->Adresse1 = \Input::get('Adresse1');
          $espacevert->Adresse2 = \Input::get('Adresse2');
          $espacevert->Adresse3 = \Input::get('Adresse3');
          $espacevert->altitude = \Input::get('altitude');
          $espacevert->Latitude = \Input::get('Latitude');
          $espacevert->Longitude = \Input::get('Longitude');
          $espacevert->Surface = \Input::get('Surface');
          $espacevert->SurfaceIrrigue = \Input::get('SurfaceIrrigue');
          $espacevert->Forage = (\Input::has('Forage')) ? 1 : 0;
          $espacevert->SystArrosage = \Input::get('SystArrosage');
          $espacevert->Reference = \Input::get('Reference');
          $espacevert->ArriveeauID = \Input::get('ArriveeauID');
          $espacevert->Categorie = \Input::get('Categorie');

          $espacevert->save();

          //Mettre à jour les associations compteur
          if(is_array(\Input::get('compteurEauxID'))){
            $compteurespacevert_ids = array();
            $compteur_arr = \Input::get('compteurEauxID');
            foreach ($compteur_arr as $key => $compteur_id){
              $size = Compteurespaceverts::where('CompteurID', $compteur_id)->where('EspacevertID',  $espacevert->EspacevertID)->count();
              if($size <= 0){
                $compteurespacevert = new Compteurespaceverts();
                $compteurespacevert->EspacevertID = $espacevert->EspacevertID;
                $compteurespacevert->CompteurID = $compteur_id;
                $compteurespacevert->BaseID = $baseid;
                $compteurespacevert->Pourcentage = 100;
                $compteurespacevert->save();
              }
              $compteurespacevert_ids[] = $compteur_id;
            }

            $existing_compteurespaceverts = DB::select("SELECT compteur.CompteurID, compteurespaceverts.EspacevertID FROM compteur inner join compteurespaceverts on ( compteur.CompteurID=compteurespaceverts.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') and compteurespaceverts.EspacevertID={$espacevert->EspacevertID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
            foreach ($existing_compteurespaceverts as $compteurespacevert){
              if(!in_array($compteurespacevert->CompteurID, $compteurespacevert_ids)){
                DB::table('compteurespaceverts')->where('CompteurID', $compteurespacevert->CompteurID)->where('EspacevertID', $compteurespacevert->EspacevertID)->delete();
              }
            }
          }

          $modifierUrl = URL::to('tbge/patrimoine/espacevert/' . $espacevert->EspacevertID . '/edit');
          Session::flash('espacevert.success', "<p>Mise-à-jour du espacevert effectuée avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le point d'arrivée d'eau</a></p>");
          return Redirect::to('tbge/patrimoine/espacevert');
        }
    }

    public function destroy($id)
    {
      $espacevert = Espaceverts::find($id);
      $espacevert->delete();

      // redirect
      Session::flash('espacevert.success', "Espace vert supprimé avec succès !");
      return Redirect::to('tbge/patrimoine/espacevert');
    }

    public function importCsv()
    {
      $baseid = Auth::user()->BaseID; 

      return  View::make('tbge.patrimoine.espacevert.importcsv');
    }


    public function importCsvPosted()
    {
      $baseid = Auth::user()->BaseID; 

      if (Input::hasFile('csvFile')) {
        $file            = Input::file('csvFile');
        $extension = $file->getClientOriginalExtension();
        if('csv' !== $extension){
          return Redirect::to('tbge/patrimoine/espacevert/import/csv')
              ->with('message.error', "Le fichier à importer doit-être de type CSV !");
        }

        $file_name = $file->getClientOriginalName();
        $file_path = $file->getRealPath();

        if (($handle = fopen($file_path, "r")) === FALSE) {
          return Redirect::to('tbge/patrimoine/espacevert/import/csv')
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
        return  View::make('tbge.patrimoine.espacevert.importcsvimported')
          ->with('header', $tableau_head)
          ->with('data', $tableau_data);
      }

      return  View::make('tbge.patrimoine.espacevert.importcsv');
    }

    public function doImport(){
      $baseid = Auth::user()->BaseID; 

      DB::beginTransaction();

      DB::statement('SET FOREIGN_KEY_CHECKS=0;');

      DB::table('compteurespaceverts')->truncate();
      DB::table('espacevert')->truncate();

      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      
      Validator::extend('categorieValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          if(in_array($value, self::$categories)){
            return true;
          }
          return false;
      });

      Validator::extend('compteursValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return false;
          }
          $compteurElectricites = explode("-", $value);
          if(is_array($compteurElectricites)){
            foreach ($compteurElectricites as $key => $compteurElectriciteReference) {
              $compteurs = Compteurs::where('Reference', $compteurElectriciteReference)->get();
              if(count($compteurs) > 0){
                return true;
              }else{
                return false;
              }
            }
          }
      });

      Validator::extend('arriveeauIDValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return false;
          }  
          $arriveeaux = Arriveeaux::where('Nom', $value)->get();
          if(count($arriveeaux) > 0){
            return true;
          }else{
            return false;
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
              "ArriveeauID" => 'arriveeauIDValide',
              'Categorie' => 'categorieValide'
            ), 
            array(
              'required' => "Le champ :attribute est obligatoire"
            )
          );

          if ($validation->fails()) {
              return Redirect::to('tbge/patrimoine/espacevert/import/csv')
                  ->withErrors($validation);
          } else {
            $arriveeaux = Arriveeaux::where('Nom', $row['ArriveeauID'])->get();

            $espacevert = new Espaceverts();
            $espacevert->MouvrageID = Config::get('enertrack.MouvrageID');
            $espacevert->BaseID = $baseid;
            $espacevert->Reference = $row['Reference'];
            $espacevert->Nom = $row['Nom'];
            $espacevert->Categorie = $row['Categorie'];
            $espacevert->ArriveeauID = (empty($row['ArriveeauID'])) ? '' : $arriveeaux[0]->ArriveeauID;

            $espacevert->save();

            $compteurElectricites = explode("-", $row['Compteurs']);
            if(is_array($compteurElectricites)){
              foreach ($compteurElectricites as $key => $compteurElectriciteReference) {
                $compteurs = Compteurs::where('Reference', $compteurElectriciteReference)->get();
                if(count($compteurs) > 0){
                  $compteurespacevert = new Compteurespaceverts();
                  $compteurespacevert->EspacevertID = $espacevert->EspacevertID;
                  $compteurespacevert->CompteurID = $compteurs[0]->CompteurID;
                  $compteurespacevert->BaseID = $baseid;
                  $compteurespacevert->Pourcentage = 100;
                  $compteurespacevert->save();               
                }
              }
            }

            $nombreLigneImportee = $nombreLigneImportee + 1;
          }
        }
      }


      DB::commit();

      Session::flash('success', "<p>Espaces verts importés avec succès ! $nombreLigneImportee lignes importées </p>");
      return Redirect::to('tbge/patrimoine/espacevert');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}