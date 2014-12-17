<?php

class VehiculeTbgeController extends \BaseController {

    public static $services = array(1 =>  'Propreté', 2 => 'Espaces verts', 3 => 'Entretien', 4 => 'Eclairage public', 5 => 'Hygiène (BMH)', 6 => 'Parc automobile communal', 7 => 'Abattoirs', 8 => 'Transport du personnel', 9 => 'Urgences médicales');

    public static $fonctions = array(0 => 'Utilitaire : usage sur le terrain', 1 => 'De service : à titre fonctionnel', 3 => 'Particulier : usage personnel');

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $vehicules = DB::select("SELECT vehicule.*, mouvrage.Societe, coordonnee.Societe as Contact, categorie.libelle as categorie, carburant.libelle as carburantLibelle FROM vehicule  INNER JOIN mouvrage ON mouvrage.MouvrageID = vehicule.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = vehicule.CoordonneeID  LEFT OUTER JOIN categorie on categorie.CategorieID = vehicule.CategorieID LEFT OUTER JOIN categorie carburant on carburant.CategorieID = vehicule.Carburant WHERE vehicule.BaseID='$baseid'");

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

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 ORDER BY compteur.EnergieID, compteur.Numero, compteur.Reference  ");

      return View::make('tbge.patrimoine.vehicule.create')
        ->with('services', self::$services)
        ->with('categories', $categories)
        ->with('carburants', $carburants)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('fonctions', self::$fonctions);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le numero de matricule du véhicule est obligatoire !"
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
          $vehicule->Service = \Input::get('Service');
          $vehicule->UniteAdministrative = \Input::get('UniteAdministrative');
          $vehicule->Fonction = \Input::get('Fonction');
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

          $modifierUrl = URL::to('tbge/patrimoine/vehicule/' . $vehicule->VehiculeID . '/edit');
          Session::flash('vehicule.success', "<p>Ajout du véhicule effectuée avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le véhicule</a></p>");
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

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 ORDER BY compteur.EnergieID, compteur.Numero, compteur.Reference  ");

      $compteurElectricitesSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurvehicules on ( compteur.CompteurID=compteurvehicules.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and compteurvehicules.VehiculeID={$vehicule->VehiculeID} ");
      $compteurElectricitesSelected = $this->objectsToArray($compteurElectricitesSelected, 'CompteurID', 'CompteurID');
      
      return View::make('tbge/patrimoine.vehicule.edit')
        ->with('vehicule', $vehicule)
        ->with('services', self::$services)
        ->with('categories', $categories)
        ->with('carburants', $carburants)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('compteurElectricitesSelected', $compteurElectricitesSelected)
        ->with('fonctions', self::$fonctions);
    }

    public function update($id){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le numero de matricule du véhicule est obligatoire !"
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
          $vehicule->Service = \Input::get('Service');
          $vehicule->UniteAdministrative = \Input::get('UniteAdministrative');
          $vehicule->Fonction = \Input::get('Fonction');
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

          $modifierUrl = URL::to('tbge/patrimoine/vehicule/' . $vehicule->VehiculeID . '/edit');
          Session::flash('vehicule.success', "<p>Mise-à-jour du véhicule effectuée avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le véhicule</a></p>");
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

    public function importCsv()
    {
      $baseid = Auth::user()->BaseID; 

      return  View::make('tbge.patrimoine.vehicule.importcsv');
    }


    public function importCsvPosted()
    {
      $baseid = Auth::user()->BaseID; 

      if (Input::hasFile('csvFile')) {
        $file            = Input::file('csvFile');
        $extension = $file->getClientOriginalExtension();
        if('csv' !== $extension){
          return Redirect::to('tbge/patrimoine/vehicule/import/csv')
              ->with('message.error', "Le fichier à importer doit-être de type CSV !");
        }

        $file_name = $file->getClientOriginalName();
        $file_path = $file->getRealPath();

        if (($handle = fopen($file_path, "r")) === FALSE) {
          return Redirect::to('tbge/patrimoine/vehicule/import/csv')
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
        return  View::make('tbge.patrimoine.vehicule.importcsvimported')
          ->with('header', $tableau_head)
          ->with('data', $tableau_data);
      }

      return  View::make('tbge.patrimoine.vehicule.importcsv');
    }

    public function doImport(){
      $baseid = Auth::user()->BaseID; 

      DB::beginTransaction();

      DB::statement('SET FOREIGN_KEY_CHECKS=0;');

      DB::table('compteurvehicules')->truncate();
      DB::table('vehicule')->truncate();

      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      
      Validator::extend('serviceValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          if(in_array($value, self::$services)){
            return true;
          }
          return false;
      });

      Validator::extend('fonctionValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          if(in_array($value, self::$fonctions)){
            return true;
          }
          return false;
      });

      Validator::extend('carburantValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          $categories = Categories::where('Libelle', $value)->where('CategorieparenteID', 39)->get();
          if(count($categories) > 0){
            return true;
          }
          return false;
      });

      Validator::extend('categorieIDValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          $categories = Categories::where('Libelle', $value)->where('CategorieparenteID', 12)->get();
          if(count($categories) > 0){
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
              'Nom' => 'required',
              'Service' => 'serviceValide',
              "CompteurVehicules" => 'compteursValide',
              'CategorieID' => 'categorieIDValide',
              'Fonction' => 'fonctionValide',
              'Carburant' => 'carburantValide'
              ), array(
                'required' => "Le champ :attribute est obligatoire"
              )
          );

          if ($validation->fails()) {
              dd($row);
              return Redirect::to('tbge/patrimoine/vehicule/import/csv')
                  ->withErrors($validation);
          } else {
            
            $fonctionKey = null;
            if(in_array($row['Fonction'], self::$fonctions)){
              $fonctionKey = $key;
              break;
            }

            $serviceKey = null;
            if(in_array($row['Service'], self::$services)){
              $serviceKey = $key;
              break;
            }

            $categories = Categories::where('Libelle', $row['CategorieID'])->where('CategorieparenteID', 12)->get();
            $carburants = Categories::where('Libelle', $row['Carburant'])->where('CategorieparenteID', 39)->get();
          
            $vehicule = new Vehicules();
            $vehicule->MouvrageID = Config::get('enertrack.MouvrageID');
            $vehicule->BaseID = $baseid;
            $vehicule->Nom = $row['Nom'];
            $vehicule->CategorieID = (empty($row['CategorieID'])) ? NULL : $categories[0]->CategorieID;
            $vehicule->Service = $serviceKey;
            $vehicule->UniteAdministrative = $row['UniteAdministrative'];
            $vehicule->Fonction = $fonctionKey;
            $vehicule->Marque = $row['Marque'];
            $vehicule->Modele = $row['Modele'];
            $vehicule->Taille = $row['Taille'];
            $vehicule->Carburant = (empty($row['Carburant'])) ? NULL : $carburants[0]->CategorieID;
            $vehicule->Conso = $row['Conso'];
            $vehicule->DistanceParcourue = $row['DistanceParcourue'];
            $vehicule->NbrJrReparation = $row['NbrJrReparation'];
            $vehicule->Puissance = $row['Puissance'];

            $vehicule->save();

            $compteurElectricites = explode("-", $row['CompteurVehicules']);
            if(is_array($compteurElectricites)){
              foreach ($compteurElectricites as $key => $compteurElectriciteReference) {
                $compteurs = Compteurs::where('Reference', $compteurElectriciteReference)->get();
                if(count($compteurs) > 0){
                  $compteurvehicule = new Compteurvehicules();
                  $compteurvehicule->VehiculeID = $vehicule->VehiculeID;
                  $compteurvehicule->CompteurID = $compteurs[0]->CompteurID;
                  $compteurvehicule->BaseID = $baseid;
                  $compteurvehicule->Pourcentage = 100;
                  $compteurvehicule->save();               
                }
              }
            }

            $nombreLigneImportee = $nombreLigneImportee + 1;
          }
        }
      }


      DB::commit();

      Session::flash('success', "<p>Véhicules importés avec succès ! $nombreLigneImportee lignes importées </p>");
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