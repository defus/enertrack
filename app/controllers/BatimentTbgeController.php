<?php

class BatimentTbgeController extends \BaseController {

    public static $divisions = array('Division des ressources humaines', 'Division des affaires juridiques administratives et économiques', 'Division des finances et de la comptabilité', "Division des marchés, de l'approvisionnement et de l'élaboration du budget", "Division de l'urbanisme", "Division du patrimoine communal", "Division de l'ingénierie  et des travaux techniques", "Division de l'environnement  et de la qualité  de la vie", "Division de la culture", "Division du développement social", "Division du sport", "Bureau  communal d'hygiène");

    public static $patrimoines = array(
      'Bâtiment administratif' => array(
          2 => "Hôtel de ville", 
          3 => "Division administrative",
          1 => "Autre"), 
      'Bâtiment social' => array(
          5 => "Centre d’accueil", 
          6 => "Maison de quartier",
          4 => 'Autre'), 
      'Bâtiment commercial' => array(
          8 => 'Centre commercial', 
          9 => 'Marché', 
          10 => 'Abattoir',
          7 =>'Autre'), 
      'Bâtiment culturel' => array(
          12 => 'Théâtre', 
          13 => 'Musée', 
          14 => 'Centre culturel',
          11 => 'Autre'), 
      'Bâtiment éducatif' =>  array(
          16 => 'Centre de formation', 
          17 => 'Bibliothèque',
          15 => 'Autre'), 
      'Bâtiment sportif' => array(
          19 => 'Stade', 
          20 => 'Salle couverte omnisport',
          18 => 'Autre'), 
      'Bâtiment touristique' => array(
          26 => 'Hôtel',
          27 => 'Auberge'), 
      'Bâtiment hospitalier' => array(
          22 => 'Centre de santé',
          28 => 'Hôpital')
    );

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $batiments = DB::select("SELECT batiment.*, mouvrage.Societe, coordonnee.Societe as Contact FROM batiment INNER JOIN mouvrage ON mouvrage.MouvrageID = batiment.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = batiment.CoordonneeID WHERE batiment.BaseID='$baseid'");

      $sousPatrimoines = array();
      foreach (self::$patrimoines as $key => $sps) {
        foreach ($sps as $skey => $sp) {
          $sousPatrimoines[$skey] = $sp;
        }
      }

      return  View::make('tbge.patrimoine.batiment.index')
        ->with('batiments', $batiments)
        ->with('patrimoines', $sousPatrimoines);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $compteurEaux = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");
      
      return View::make('tbge.patrimoine.batiment.create')
        ->with('compteurEaux', $compteurEaux)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('patrimoines', self::$patrimoines)
        ->with('divisions', self::$divisions);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom du batiment est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/batiment/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {

          $divisionConc = "";
          $divisions = \Input::get('Division');
          if(is_array($divisions)){
            foreach ($divisions as $key => $division) {
              if($divisionConc == ""){
                $divisionConc = $division;
              }else{
                $divisionConc = $divisionConc . "-" . $division; 
              }

            }
          }

          $batiment = new Batiments();
          $batiment->MouvrageID = Config::get('enertrack.MouvrageID');
          $batiment->BaseID = $baseid;
          $batiment->Nom = \Input::get('Nom');
          $batiment->Reference = \Input::get('Reference');
          $batiment->Adresse1 = \Input::get('Adresse1');
          $batiment->Adresse2 = \Input::get('Adresse2');
          $batiment->Adresse3 = \Input::get('Adresse3');
          $batiment->altitude = \Input::get('altitude');
          $batiment->Latitude = \Input::get('Latitude');
          $batiment->Longitude = \Input::get('Longitude');
          $batiment->Patrimoine = \Input::get('Patrimoine');
          $batiment->Anneeconstruction = \Input::get('Anneeconstruction');
          $batiment->NbrEtage = \Input::get('NbrEtage');
          $batiment->Surface = \Input::get('Surface');
          $batiment->SurfaceNette = \Input::get('SurfaceNette');
          $batiment->SurfaceBrute = \Input::get('SurfaceBrute');
          $batiment->NbrEmployee = \Input::get('NbrEmployee');
          $batiment->Pv = \Input::get('Pv');
          $batiment->SystemeChauffageEau = \Input::get('SystemeChauffageEau');
          $batiment->Ces = \Input::get('Ces');
          $batiment->MesuresEE = (\Input::has('MesuresEE')) ? 1 : 0;
          $batiment->MesuresEEDesc = \Input::get('MesuresEEDesc');
          $batiment->MesuresGRE = (\Input::has('MesuresGRE')) ? 1 : 0;
          $batiment->MesuresGREDesc = \Input::get('MesuresGREDesc');
          $batiment->Division = $divisionConc;

          $batiment->save();

          //Ajouter les associations compteurs
          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurs_arr = \Input::get('compteurElectricitesID');
            foreach($compteurs_arr as $compteur_id){
              $compteurbatiment = new Compteurbatiments();
              $compteurbatiment->BatimentID = $batiment->BatimentID;
              $compteurbatiment->CompteurID = $compteur_id;
              $compteurbatiment->BaseID = $baseid;
              $compteurbatiment->Pourcentage = 100;
              $compteurbatiment->save();
            }
          }
          if(is_array(\Input::get('compteurEauxID'))){
            $compteurs_arr = \Input::get('compteurEauxID');
            foreach($compteurs_arr as $compteur_id){
              $compteurbatiment = new Compteurbatiments();
              $compteurbatiment->BatimentID = $batiment->BatimentID;
              $compteurbatiment->CompteurID = $compteur_id;
              $compteurbatiment->BaseID = $baseid;
              $compteurbatiment->Pourcentage = 100;
              $compteurbatiment->save();
            }
          }

          $modifierUrl = URL::to('tbge/patrimoine/batiment/' . $batiment->BatimentID . '/edit');
          Session::flash('batiment.success', "<p>Création du batiment effectué avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le bâtiment</a></p>");
          return Redirect::to('tbge/patrimoine/batiment');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $batiment = Batiments::find($id);

      $compteurEaux = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");
      
      $compteurEauxSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurbatiments on ( compteur.CompteurID=compteurbatiments.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') and compteurbatiments.BatimentID={$batiment->BatimentID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      $compteurEauxSelected = $this->objectsToArray($compteurEauxSelected, 'CompteurID', 'CompteurID');

      $compteurElectricitesSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurbatiments on ( compteur.CompteurID=compteurbatiments.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') and compteurbatiments.BatimentID={$batiment->BatimentID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      $compteurElectricitesSelected = $this->objectsToArray($compteurElectricitesSelected, 'CompteurID', 'CompteurID');

      return View::make('tbge.patrimoine.batiment.edit')
        ->with('batiment', $batiment)
        ->with('compteurEaux', $compteurEaux)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('patrimoines', self::$patrimoines)
        ->with('compteurEauxSelected', $compteurEauxSelected)
        ->with('compteurElectricitesSelected', $compteurElectricitesSelected)
        ->with('divisions', self::$divisions);
    }

    public function update($id){
      $baseid = Auth::user()->BaseID; ;

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom du batiment est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/batiment/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $divisionConc = "";
          $divisions = \Input::get('Division');
          if(is_array($divisions)){
            foreach ($divisions as $key => $division) {
              if($divisionConc == ""){
                $divisionConc = $division;
              }else{
                $divisionConc = $divisionConc . "-" . $division; 
              }

            }
          }

          $batiment = Batiments::find($id);
          $batiment->MouvrageID = Config::get('enertrack.MouvrageID');
          $batiment->Nom = \Input::get('Nom');
          $batiment->Reference = \Input::get('Reference');
          $batiment->Adresse1 = \Input::get('Adresse1');
          $batiment->Adresse2 = \Input::get('Adresse2');
          $batiment->Adresse3 = \Input::get('Adresse3');
          $batiment->altitude = \Input::get('altitude');
          $batiment->Latitude = \Input::get('Latitude');
          $batiment->Longitude = \Input::get('Longitude');
          $batiment->Patrimoine = \Input::get('Patrimoine');
          $batiment->Anneeconstruction = \Input::get('Anneeconstruction');
          $batiment->NbrEtage = \Input::get('NbrEtage');
          $batiment->Surface = \Input::get('Surface');
          $batiment->SurfaceNette = \Input::get('SurfaceNette');
          $batiment->SurfaceBrute = \Input::get('SurfaceBrute');
          $batiment->NbrEmployee = \Input::get('NbrEmployee');
          $batiment->Pv = \Input::get('Pv');
          $batiment->SystemeChauffageEau = \Input::get('SystemeChauffageEau');
          $batiment->Ces = \Input::get('Ces');
          $batiment->MesuresEE = (\Input::has('MesuresEE')) ? 1 : 0;
          $batiment->MesuresEEDesc = \Input::get('MesuresEEDesc');
          $batiment->MesuresGRE = (\Input::has('MesuresGRE')) ? 1 : 0;
          $batiment->MesuresGREDesc = \Input::get('MesuresGREDesc');
          $batiment->Division = $divisionConc;

          $batiment->save();

          //Mettre à jour les associations compteur
          if(is_array(\Input::get('compteurEauxID'))){
            $compteurbatiment_ids = array();
            $compteur_arr = \Input::get('compteurEauxID');
            foreach ($compteur_arr as $key => $compteur_id){
              $size = Compteurbatiments::where('CompteurID', $compteur_id)->where('BatimentID',  $batiment->BatimentID)->count();
              if($size <= 0){
                $compteurbatiment = new Compteurbatiments();
                $compteurbatiment->BatimentID = $batiment->BatimentID;
                $compteurbatiment->CompteurID = $compteur_id;
                $compteurbatiment->BaseID = $baseid;
                $compteurbatiment->Pourcentage = 100;
                $compteurbatiment->save();
              }
              $compteurbatiment_ids[] = $compteur_id;
            }

            $existing_compteurbatiments = DB::select("SELECT compteur.CompteurID, compteurbatiments.BatimentID FROM compteur inner join compteurbatiments on ( compteur.CompteurID=compteurbatiments.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') and compteurbatiments.BatimentID={$batiment->BatimentID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
            foreach ($existing_compteurbatiments as $compteurbatiment){
              if(!in_array($compteurbatiment->CompteurID, $compteurbatiment_ids)){
                DB::table('compteurbatiments')->where('CompteurID', $compteurbatiment->CompteurID)->where('BatimentID', $compteurbatiment->BatimentID)->delete();
              }
            }
          }

          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurbatiment_ids = array();
            $compteur_arr = \Input::get('compteurElectricitesID');
            foreach ($compteur_arr as $key => $compteur_id){
              $size = Compteurbatiments::where('CompteurID', $compteur_id)->where('BatimentID',  $batiment->BatimentID)->count();
              if($size <= 0){
                $compteurbatiment = new Compteurbatiments();
                $compteurbatiment->BatimentID = $batiment->BatimentID;
                $compteurbatiment->CompteurID = $compteur_id;
                $compteurbatiment->BaseID = $baseid;
                $compteurbatiment->Pourcentage = 100;
                $compteurbatiment->save();
              }
              $compteurbatiment_ids[] = $compteur_id;
            }

            $existing_compteurbatiments = DB::select("SELECT compteur.CompteurID, compteurbatiments.BatimentID FROM compteur inner join compteurbatiments on ( compteur.CompteurID=compteurbatiments.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') and compteurbatiments.BatimentID={$batiment->BatimentID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
            foreach ($existing_compteurbatiments as $compteurbatiment){
              if(!in_array($compteurbatiment->CompteurID, $compteurbatiment_ids)){
                DB::table('compteurbatiments')->where('CompteurID', $compteurbatiment->CompteurID)->where('BatimentID', $compteurbatiment->BatimentID)->delete();
              }
            }
          }

          $modifierUrl = URL::to('tbge/patrimoine/batiment/' . $batiment->BatimentID . '/edit');
          Session::flash('batiment.success', "<p>Mise-à-jour du batiment effectué avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le bâtiment</a></p>");
          return Redirect::to('tbge/patrimoine/batiment');
        }
    }

    public function destroy($id)
    {
      $batiment = Batiments::find($id);
      $batiment->delete();

      // redirect
      Session::flash('batiment.success', "Batiment supprimé avec succès !");
      return Redirect::to('tbge/patrimoine/batiment');
    }

    public function importCsv()
    {
      $baseid = Auth::user()->BaseID; 

      return  View::make('tbge.patrimoine.batiment.importcsv');
    }


    public function importCsvPosted()
    {
      $baseid = Auth::user()->BaseID; 

      if (Input::hasFile('csvFile')) {
        $file            = Input::file('csvFile');
        $extension = $file->getClientOriginalExtension();
        if('csv' !== $extension){
          return Redirect::to('tbge/patrimoine/batiment/import/csv')
              ->with('message.error', "Le fichier à importer doit-être de type CSV !");
        }

        $file_name = $file->getClientOriginalName();
        $file_path = $file->getRealPath();

        if (($handle = fopen($file_path, "r")) === FALSE) {
          return Redirect::to('tbge/patrimoine/batiment/import/csv')
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
        return  View::make('tbge.patrimoine.batiment.importcsvimported')
          ->with('header', $tableau_head)
          ->with('data', $tableau_data);
      }

      return  View::make('tbge.patrimoine.batiment.importcsv');
    }

    public function doImport(){
      $baseid = Auth::user()->BaseID; 

      DB::beginTransaction();

      DB::statement('SET FOREIGN_KEY_CHECKS=0;');

      DB::table('compteurbatiments')->truncate();
      DB::table('batiment')->truncate();

      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      
      Validator::extend('categorieValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          if(array_key_exists($value, self::$patrimoines)){
            return true;
          }
          return false;
      });

      Validator::extend('sousCategorieValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          
          foreach (self::$patrimoines as $key => $sousPatrimoines) {
            if(in_array($value, $sousPatrimoines)){
              return true;
            }
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
              $compteurs = Compteurs::where('Reference', $compteurElectriciteReference)->get();
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
              'Categorie' => 'categorieValide',
              "SousCategorie" => 'sousCategorieValide',
              "CompteurElectricites" => 'compteursValide',
              "CompteurEaux" => 'compteursValide'
              ), array(
                'required' => "Le champ :attribute est obligatoire"
              )
          );

          if ($validation->fails()) {
              return Redirect::to('tbge/patrimoine/batiment/import/csv')
                  ->withErrors($validation);
          } else {
            $sousCategorieKey = "";
            if(array_key_exists('SousCategorie', $row)){
              foreach (self::$patrimoines as $key => $sousPatrimoines) {
                if(in_array($row['SousCategorie'], $sousPatrimoines)){
                  foreach ($sousPatrimoines as $skey => $sousPatrimoine) {
                    if($sousPatrimoine == $row['SousCategorie']){
                      $sousCategorieKey = $skey;
                      break;
                    }
                  }
                  break;
                }
              }
            }
            
            $batiment = new Batiments();
            $batiment->MouvrageID = Config::get('enertrack.MouvrageID');
            $batiment->BaseID = $baseid;
            $batiment->Reference = $row['Reference'];
            $batiment->Nom = $row['Nom'];
            $batiment->Patrimoine = $sousCategorieKey;
            
            $batiment->save();

            $compteurElectricites = explode("-", $row['CompteurElectricites']);
            if(is_array($compteurElectricites)){
              foreach ($compteurElectricites as $key => $compteurElectriciteReference) {
                $compteurs = Compteurs::where('Reference', $compteurElectriciteReference)->get();
                if(count($compteurs) > 0){
                  $compteurbatiment = new Compteurbatiments();
                  $compteurbatiment->BatimentID = $batiment->BatimentID;
                  $compteurbatiment->CompteurID = $compteurs[0]->CompteurID;
                  $compteurbatiment->BaseID = $baseid;
                  $compteurbatiment->Pourcentage = 100;
                  $compteurbatiment->save();               
                }
              }
            }

            $compteurElectricites = explode("-", $row['CompteurEaux']);
            if(is_array($compteurElectricites)){
              foreach ($compteurElectricites as $key => $compteurElectriciteReference) {
                $compteurs = Compteurs::where('Reference', $compteurElectriciteReference)->get();
                if(count($compteurs) > 0){
                  $compteurbatiment = new Compteurbatiments();
                  $compteurbatiment->BatimentID = $batiment->BatimentID;
                  $compteurbatiment->CompteurID = $compteurs[0]->CompteurID;
                  $compteurbatiment->BaseID = $baseid;
                  $compteurbatiment->Pourcentage = 100;
                  $compteurbatiment->save();               
                }
              }
            }
               
            $nombreLigneImportee = $nombreLigneImportee + 1;
          }
        }
      }


      DB::commit();

      Session::flash('success', "<pBâtiments importés avec succès ! $nombreLigneImportee lignes importées </p>");
      return Redirect::to('tbge/patrimoine/batiment');
    }
    
    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}