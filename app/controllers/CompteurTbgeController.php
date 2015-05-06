<?php

class CompteurTbgeController extends \BaseController {

    public static $typeCompteurs = array('CONSO'=>"Consommation d'énergie", 'CONSOEAU'=>"Consommation d'eau", 'CONSOLIEPROD'=>"Consommation liée à un de vos postes de production", 'MP'=>"Consommation en matière première pour fabrication", 'PROD' => "Production  d'énergie", 'PRODEAU'=> "Production d'eau chaude", 'FABRICATION'=> "Fabrication de produits manufacturés");

    public function index()
    {
      $baseid = Auth::user()->BaseID; 
      
      return  View::make('tbge.compteur.index');
    }

    public function datatable(){

      $baseid = Auth::user()->BaseID; 

      $draw = \Input::get('draw');
      $start = \Input::get('start', 0);
      $length = \Input::get('length', 10);
      $search = \Input::get('search');
      $order = \Input::get('order');
      $columns = \Input::get('columns');

      $query = Compteurs::with('Energie')->with('Fournisseur')->where('BaseID', 'like', $baseid);
      $total = $query->count();
      if($search['value'] != ''){
        $query->where(DB::raw('LOWER(Reference)'), 'LIKE', Str::lower('%' . trim($search['value']) . '%' ));
        $query->orwhere(DB::raw('LOWER(Numero)'), 'LIKE', Str::lower('%' . trim($search['value']) . '%' ));
      }
      $total_search = $query->count();
      if (!is_null($start) && !is_null($length)) {
        $query = $query->skip($start)->take($length);
      }
      if (is_array($order) && count($order) > 0) {
          for ($i = 0, $c = count($order); $i < $c; $i++) {
              $order_col = (int)$order[$i]['column'];
              if (isset($columns[$order_col])) {
                  if ($columns[$order_col]['orderable'] == "true") {
                      $query->orderBy($columns[$order_col]['name'], $order[$i]['dir']);
                  }
              }
          }
      }
      $list = $query->get();

      $datatable = new DataTableResponse($draw, $total, $total_search, $list, null);

      return Response::json($datatable);      
    }

    public function select2(){

      $baseid = Auth::user()->BaseID; 

      $page = \Input::get('page', 0);
      $length = \Input::get('length', 10);
      $search = \Input::get('q');
      $order = \Input::get('order', 'Reference');
      
      $query = Compteurs::with('Energie')->with('Fournisseur')->where('BaseID', 'like', $baseid);
      $total = $query->count();
      if($search != ''){
        $query->where(function($q) use($search){
          $q->where(DB::raw('LOWER(Reference)'), 'LIKE', Str::lower('%' . trim($search) . '%' ));
          $q->orwhere(DB::raw('LOWER(Numero)'), 'LIKE', Str::lower('%' . trim($search) . '%' ));
        });
      }
      $total_search = $query->count();
      if (!is_null($page) && !is_null($length)) {
        $start = (int)(($page-1) * $length);
        $query = $query->skip($start)->take($length);
      }
      
      $query->orderBy($order, 'ASC');
      
      $list = $query->get();

      $datatable = new DataTableResponse(1, $total, $total_search, $list, null);

      return Response::json($datatable);      
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $batiments = DB::select("select CONCAT('batiment-' , BatimentID) as BatimentID, Nom from batiment WHERE `BaseID` = '".$baseid."' order by Nom");
      $vehicules = DB::select("select CONCAT('vehicule-' , VehiculeID) as VehiculeID, Nom from vehicule WHERE `BaseID` = '".$baseid."' order by Nom");
      $eclairages = DB::select("select CONCAT('eclairage-' , EclairageID) as EclairageID, Nom from eclairage WHERE `BaseID` = '".$baseid."' order by Nom");
      $posteproductions = DB::select("select CONCAT('posteproduction-' , PosteproductionID) as PosteproductionID, Nom from posteproduction WHERE `BaseID` = '".$baseid."' order by Nom");
      $autrepostes = DB::select("select CONCAT('autrepostes-' , AutreposteID) as AutreposteID, Nom from autreposte WHERE `BaseID` = '".$baseid."' order by Nom");
      $espaceverts = DB::select("select CONCAT('espacevert-' , EspacevertID) as EspacevertID, Nom from espacevert WHERE `BaseID` = '".$baseid."' order by Nom");
      $arriveeaux = DB::select("select CONCAT('arriveeau-' , ArriveeauID) as ArriveeauID, Nom from arriveeau WHERE `BaseID` = '".$baseid."' order by Nom");
      
      $energies = DB::select("select EnergieID, Nom from energie WHERE `BaseID` = '".$baseid."' order by Nom");
      $energies = $this->objectsToArray($energies, 'EnergieID', 'Nom');

      $fournisseurs = DB::select("select CoordonneeID, Societe from coordonnee WHERE  Type='Fournisseur'   AND BaseID='".$baseid."' order by Societe");
      $fournisseurs = $this->objectsToArray($fournisseurs, 'CoordonneeID', 'Societe');

      $compteurexistants = DB::select("select compteur.CompteurID,  energie.Nom + compteur.Reference + compteur.Localisation as compteur FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) WHERE compteur.BaseID='".$baseid."' order by compteur.Nom");
      $compteurexistants = $this->objectsToArray($compteurexistants, 'CompteurID', 'compteur');

      $compteurprods = DB::select("select CompteurID, Nom   FROM compteur  WHERE BaseID='".$baseid."' AND (Type='PROD' OR Type='PRODEAU' OR Type='FABRICATION') order by Nom");
      $compteurprods = $this->objectsToArray($compteurprods, 'CompteurID', 'Nom');
      
      return View::make('tbge.compteur.create')
        ->with('energies', $energies)
        ->with('fournisseurs', $fournisseurs)
        ->with('compteurexistants', $compteurexistants)
        ->with('compteurprods', $compteurprods)
        ->with('batiments', $batiments)
        ->with('vehicules', $vehicules)
        ->with('eclairages', $eclairages)
        ->with('posteproductions', $posteproductions)
        ->with('autrepostes', $autrepostes)
        ->with('espaceverts', $espaceverts)
        ->with('arriveeaux', $arriveeaux)
        ->with('typeCompteurs', self::$typeCompteurs);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      //Un validateur perso pour vérifier que le patrimoine est de type <type>-<valeur>
      //attribute = le nom de l'attribut sur lequel on l'applique
      //value = la valeur reçue
      Validator::extend('patrimoineTypeValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return false;
          }
          $patrimoine = explode('-', $value);
          $patrimoineId = $patrimoine[1];
          $patrimoineType = $patrimoine[0];
          if(empty($patrimoineType)){
            return false;
          }

          if('batiment' !== $patrimoineType 
              && 'eclairage' !== $patrimoineType 
              && 'vehicule' !== $patrimoineType 
              && 'posteproduction' !== $patrimoineType 
              && 'autreposte' !== $patrimoineType
              && 'espacevert' !== $patrimoineType
              && 'arriveeau' !== $patrimoineType){
            return false;
          }
          return true;
      });

      $validation = Validator::make(\Input::all(), 
        array(
          'Reference' => 'required',
          'EnergieID' => 'required',
          'patrimoine' => 'required|patrimoineTypeValide'
          ), 
        array(
          'Reference.required' => "Le numero de contrat du compteur est obligatoire !",
          'EnergieID.required' => "Le type d'énergie est obligatoire !",
          'patrimoine.required' => "Le patrimoine est obligatoire !",
          'patrimoine.patrimoine_type_valide' => "Choisissez un type de patrimoine valide"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/compteur/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $patrimoine = \Input::get('patrimoine');
          $patrimoine = explode('-', $patrimoine);
          $patrimoineId = $patrimoine[1];
          $patrimoineType = $patrimoine[0]; //permet apr la suite de stoquer la ligne dans la table de liaison etre le compteur et le patrimoine lié

          //Enregistrer les informations de base de tous les query
          $compteur = new Compteurs();
          $compteur->MouvrageID = Config::get('enertrack.MouvrageID');
          $compteur->BaseID = $baseid;
          $compteur->Reference = \Input::get('Reference');
          $compteur->Numero = \Input::get('Numero');
          $compteur->EnergieID = \Input::get('EnergieID');
          $compteur->Type = \Input::get('Type');
          $compteur->FournisseurID = \Input::get('FournisseurID');
          $compteur->Seuil = \Input::get('Seuil');
          $compteur->Objectif = \Input::get('Objectif');
          $compteur->Clos = 0;
          
          $compteur->save();

          //Enregistrer les informations d'association du compteur au type de patrimoine
          $pourcentage = 100;
          
          if('batiment' === $patrimoineType){
            $compteurbatiment = new Compteurbatiments();
            $compteurbatiment->BatimentID = $patrimoineId;
            $compteurbatiment->CompteurID = $compteur->CompteurID;
            $compteurbatiment->BaseID = $baseid;
            $compteurbatiment->Pourcentage = $pourcentage;
            $compteurbatiment->save();

          }else if('vehicule' === $patrimoineType){
            $compteurvehicule = new Compteurvehicules();
            $compteurvehicule->VehiculeID = $patrimoineId;
            $compteurvehicule->CompteurID = $compteur->CompteurID;
            $compteurvehicule->BaseID = $baseid;
            $compteurvehicule->Pourcentage = $pourcentage;
            $compteurvehicule->save();            
          }else if('eclairage' === $patrimoineType){
            $compteureclairage = new Compteureclairages();
            $compteureclairage->EclairageID = $patrimoineId;
            $compteureclairage->CompteurID = $compteur->CompteurID;
            $compteureclairage->BaseID = $baseid;
            $compteureclairage->Pourcentage = $pourcentage;
            $compteureclairage->save(); 
          }else if('posteproduction' === $patrimoineType){
            $compteurposteproduction = new Compteurposteproductions();
            $compteurposteproduction->PosteproductionID = $patrimoineId;
            $compteurposteproduction->CompteurID = $compteur->CompteurID;
            $compteurposteproduction->BaseID = $baseid;
            $compteurposteproduction->Pourcentage = $pourcentage;
            $compteurposteproduction->save(); 
          }else if('autreposte' === $patrimoineType){
            $compteurautreposte = new Compteurautrepostes();
            $compteurautreposte->AutreposteID = $patrimoineId;
            $compteurautreposte->CompteurID = $compteur->CompteurID;
            $compteurautreposte->BaseID = $baseid;
            $compteurautreposte->Pourcentage = $pourcentage;
            $compteurautreposte->save(); 
          }else if('espacevert' === $patrimoineType){
            $espacevert = new Compteurespaceverts();
            $espacevert->EspacevertID = $patrimoineId;
            $espacevert->CompteurID = $compteur->CompteurID;
            $espacevert->BaseID = $baseid;
            $espacevert->Pourcentage = $pourcentage;
            $espacevert->save(); 
          }else if('arriveeau' === $patrimoineType){
            $arriveeau = new Compteurarriveeaux();
            $arriveeau->ArriveeauID = $patrimoineId;
            $arriveeau->CompteurID = $compteur->CompteurID;
            $arriveeau->BaseID = $baseid;
            $arriveeau->Pourcentage = $pourcentage;
            $arriveeau->save(); 
          }

          $modifierUrl = URL::to('tbge/compteur/' . $compteur->CompteurID . '/edit');
          Session::flash('success', "<p>Création du compteur effectué avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le compteur</a></p>");
          return Redirect::to('tbge/compteur');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $energies = DB::select("select EnergieID, Nom from energie WHERE `BaseID` = '".$baseid."' order by Nom");
      $energies = $this->objectsToArray($energies, 'EnergieID', 'Nom');

      $fournisseurs = DB::select("select CoordonneeID, Societe from coordonnee WHERE  Type='Fournisseur'  AND BaseID='".$baseid."' order by Societe");
      $fournisseurs = $this->objectsToArray($fournisseurs, 'CoordonneeID', 'Societe');

      $compteurexistants = DB::select("select compteur.CompteurID,  energie.Nom + compteur.Reference + compteur.Localisation as compteur FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) WHERE compteur.BaseID='".$baseid."' order by compteur.Nom");
      $compteurexistants = $this->objectsToArray($compteurexistants, 'CompteurID', 'compteur');

      $compteurprods = DB::select("select CompteurID, Nom   FROM compteur  WHERE BaseID='".$baseid."' AND (Type='PROD' OR Type='PRODEAU' OR Type='FABRICATION') order by Nom");
      $compteurprods = $this->objectsToArray($compteurprods, 'CompteurID', 'Nom');

      $compteur = Compteurs::find($id);

      return View::make('tbge.compteur.edit')
        ->with('compteur', $compteur)
        ->with('energies', $energies)
        ->with('fournisseurs', $fournisseurs)
        ->with('compteurexistants', $compteurexistants)
        ->with('compteurprods', $compteurprods)
        ->with('typeCompteurs', self::$typeCompteurs);
    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'Reference' => 'required',
          'Type' => 'required',
          'EnergieID' => 'required'
          ), 
        array(
          'Reference.required' => "La référence du compteur est obligatoire !",
          'Type.required' => "Le type est obligatoire !",
          'EnergieID.required' => "Le type d'énergie est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/compteur/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $compteur = Compteurs::find($id);
          $compteur->Reference = \Input::get('Reference');
          $compteur->Numero = \Input::get('Numero');
          $compteur->EnergieID = \Input::get('EnergieID');
          $compteur->Type = \Input::get('Type');
          $compteur->FournisseurID = \Input::get('FournisseurID');
          $compteur->Seuil = \Input::get('Seuil');
          $compteur->Objectif = \Input::get('Objectif');
          $compteur->Clos = 0;

          $compteur->save();

          $modifierUrl = URL::to('tbge/compteur/' . $compteur->CompteurID . '/edit');
          Session::flash('success', "<p>Mise-à-jour du compteur effectuée avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le compteur</a></p>");
          return Redirect::to('tbge/compteur');
        }
    }

    public function destroy($id)
    {
      $compteur = Compteurs::find($id);
      $compteur->delete();

      // redirect
      Session::flash('success', "Compteur supprimé avec succès !");
      return Redirect::to('tbge/compteur');
    }

    public function importCsv()
    {
      $baseid = Auth::user()->BaseID; 

      return  View::make('tbge.compteur.importcsv');
    }


    public function importCsvPosted()
    {
      $baseid = Auth::user()->BaseID; 

      if (Input::hasFile('csvFile')) {
        $file            = Input::file('csvFile');
        $extension = $file->getClientOriginalExtension();
        if('csv' !== $extension){
          return Redirect::to('tbge/compteur/import/csv')
              ->with('message.error', "Le fichier à importer doit-être de type CSV !");
        }

        $file_name = $file->getClientOriginalName();
        $file_path = $file->getRealPath();

        if (($handle = fopen($file_path, "r")) === FALSE) {
          return Redirect::to('tbge/compteur/import/csv')
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
        return  View::make('tbge.compteur.importcsvimported')
          ->with('header', $tableau_head)
          ->with('data', $tableau_data);
      }

      return  View::make('tbge.compteur.importcsv');
    }

    public function doImport(){
      $baseid = Auth::user()->BaseID; 

      DB::beginTransaction();

      DB::statement('SET FOREIGN_KEY_CHECKS=0;');

      DB::table('compteurarriveeaux')->truncate();
      DB::table('compteurautrepostes')->truncate();
      DB::table('compteurbatiments')->truncate();
      DB::table('compteureclairages')->truncate();
      DB::table('compteurespaceverts')->truncate();
      DB::table('compteurposteproductions')->truncate();
      DB::table('Compteurvehicules')->truncate();
      DB::table('arriveeau')->truncate();
      DB::table('autreposte')->truncate();
      DB::table('batiment')->truncate();
      DB::table('eclairage')->truncate();
      DB::table('espacevert')->truncate();
      DB::table('posteproduction')->truncate();
      DB::table('vehicule')->truncate();
      DB::table('compteur')->truncate();

      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      
      Validator::extend('fournisseurValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return false;
          }
          $fournisseurs = Contacts::where('Type', 'Fournisseur')->where('Nom', $value)->get();

          if(count($fournisseurs) <= 0){
            return false;
          }
          return true;
      });

      Validator::extend('typeCompteurValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return false;
          }
          
          if(in_array($value, self::$typeCompteurs)){
            return true;
          }
          return false;
      });

      Validator::extend('typeEnergieValide', function($attribute, $value, $parameters)
      {
          $baseid = Auth::user()->BaseID; 

          if(empty($value)){
            return false;
          }
          $energies = DB::select("select EnergieID, Nom from energie WHERE `BaseID` = '".$baseid."' And Nom like '" . $value . "' order by Nom");
          if(count($energies) <= 0){
            return false;
          }
          return true;
      });

      $selected = \Input::get('selecte');
      $data = \Input::get('col');

      $nombreLigneImportee = 0;

      foreach ($selected as $rowIndex => $rowChecked) {
        if($rowChecked === '1'){
          $row = $data[$rowIndex];
          
          $validation = Validator::make($row, 
            array(
              'Numero' => 'required',
              'Reference' => 'required',
              'Type' => 'required|typeCompteurValide',
              "EnergieID" => 'required|typeEnergieValide',
              "Fournisseur" => 'required|fournisseurValide'
              ), array(
                'required' => "Le champ :attribute est obligatoire"
              )
          );

          if ($validation->fails()) {
              return Redirect::to('tbge/compteur/import/csv')
                  ->withErrors($validation);
          } else {
            $fournisseurs = Contacts::where('Type', 'Fournisseur')->where('Nom', $row['Fournisseur'])->get();
            
            $energies = DB::select("select EnergieID, Nom from energie WHERE `BaseID` = '".$baseid."' And Nom like '" . $row["EnergieID"] . "' order by Nom");

            $typeCompteurKey = "";
            foreach (self::$typeCompteurs as $key => $value) {
              if($value == $row["Type"]){
                $typeCompteurKey = $key;
                break;
              }
            }

            $compteur = new Compteurs();
            $compteur->MouvrageID = Config::get('enertrack.MouvrageID');
            $compteur->BaseID = $baseid;
            $compteur->Reference = $row["Reference"];
            $compteur->Numero = $row["Numero"];
            $compteur->EnergieID = $energies[0]->EnergieID;
            $compteur->Type = $typeCompteurKey;
            $compteur->FournisseurID = $fournisseurs[0]->CoordonneeID;
            $compteur->Seuil = $row["Seuil"];
            $compteur->Objectif = $row["Objectif"];
            $compteur->Clos = 0;

            $compteur->save();

            $nombreLigneImportee = $nombreLigneImportee + 1;
          }
        }
      }


      DB::commit();

      Session::flash('success', "<p>Compteurs importés avec succès ! $nombreLigneImportee lignes importées </p>");
      return Redirect::to('tbge/compteur');
    }
    

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}