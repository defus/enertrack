<?php

class EclairageTbgeController extends \BaseController {

    public static $typeTechnologies = array(1 => "MHP : Lampes à vapeur de Mercure Haute Pression", 2 => "SHP : Lampes à vapeur de Sodium Haute Pression", 3 => 'LED : Diode électroluminescente', 4 => "Solaire");

    public static $typeTarifs = array('BT Public', 'BT Administratif', 'BT Patenté', 'BT Force Motrice Industrielle', 'MT Général');

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $eclairages = DB::select("SELECT eclairage.*, mouvrage.Societe, coordonnee.Societe as Contact, categorie.libelle as categorie  FROM eclairage INNER JOIN mouvrage ON mouvrage.MouvrageID = eclairage.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = eclairage.CoordonneeID LEFT OUTER JOIN categorie on categorie.CategorieID = eclairage.CategorieID WHERE eclairage.BaseID='$baseid'");

      return  View::make('tbge.patrimoine.eclairage.index')
        ->with('eclairages', $eclairages);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =8 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 ORDER BY compteur.EnergieID, compteur.Numero, compteur.Reference  ");

      return View::make('tbge.patrimoine.eclairage.create')
        ->with('typeTechnologies', self::$typeTechnologies)
        ->with('categories', $categories)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('typeTarifs', self::$typeTarifs);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom du poste d'éclairage est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/eclairage/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $eclairage = new Eclairages();
          $eclairage->MouvrageID = Config::get('enertrack.MouvrageID');
          $eclairage->BaseID = $baseid;
          $eclairage->Reference = \Input::get('Reference');
          $eclairage->Nom = \Input::get('Nom');
          $eclairage->Secteur = \Input::get('Secteur');
          $eclairage->Nbrpointlumineux = \Input::get('Nbrpointlumineux');
          $eclairage->CategorieID = \Input::get('CategorieID');
          $eclairage->TypeTarif = \Input::get('TypeTarif');
          $eclairage->PuissanceSouscrite = \Input::get('PuissanceSouscrite');
          $eclairage->PuissanceInstalle = \Input::get('PuissanceInstalle');
          $eclairage->PuissanceAppele = \Input::get('PuissanceAppele');
          $eclairage->Puissance = \Input::get('Puissance');
          $eclairage->NbrHeuresans = \Input::get('NbrHeuresans');
          $eclairage->TypeTechnologie = \Input::get('TypeTechnologie');
          $eclairage->MarqueLampe = \Input::get('MarqueLampe');
          $eclairage->NbrJourInterrupServ = \Input::get('NbrJourInterrupServ');
          $eclairage->NbrJourIntervServ = \Input::get('NbrJourIntervServ');
          
          $eclairage->save();

          //Ajouter les associations compteurs
          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurs_arr = \Input::get('compteurElectricitesID');
            foreach($compteurs_arr as $compteur_id){
              $compteureclairage = new Compteureclairages();
              $compteureclairage->EclairageID = $eclairage->EclairageID;
              $compteureclairage->CompteurID = $compteur_id;
              $compteureclairage->BaseID = $baseid;
              $compteureclairage->Pourcentage = 100;
              $compteureclairage->save();
            }
          }

          $modifierUrl = URL::to('tbge/patrimoine/eclairage/' . $eclairage->EclairageID . '/edit');
          Session::flash('eclairage.success', "<p>Création du poste d'éclairage effectuée avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le poste d'éclairage</a></p>");
          return Redirect::to('tbge/patrimoine/eclairage');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $eclairage = Eclairages::find($id);

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =8 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Numero, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 ORDER BY compteur.EnergieID, compteur.Numero, compteur.Reference  ");

      $compteurElectricitesSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteureclairages on ( compteur.CompteurID=compteureclairages.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and compteureclairages.EclairageID={$eclairage->EclairageID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      $compteurElectricitesSelected = $this->objectsToArray($compteurElectricitesSelected, 'CompteurID', 'CompteurID');
      
      return View::make('tbge.patrimoine.eclairage.edit')
        ->with('eclairage', $eclairage)
        ->with('typeTechnologies', self::$typeTechnologies)
        ->with('categories', $categories)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('compteurElectricitesSelected', $compteurElectricitesSelected)
        ->with('typeTarifs', self::$typeTarifs);
    }

    public function update($id){
      $baseid = Auth::user()->BaseID; 
      
      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom du poste d'éclairage est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/eclairage/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $eclairage = Eclairages::find($id);
          $eclairage->MouvrageID = Config::get('enertrack.MouvrageID');
          $eclairage->Reference = \Input::get('Reference');
          $eclairage->Nom = \Input::get('Nom');
          $eclairage->Secteur = \Input::get('Secteur');
          $eclairage->Nbrpointlumineux = \Input::get('Nbrpointlumineux');
          $eclairage->CategorieID = \Input::get('CategorieID');
          $eclairage->TypeTarif = \Input::get('TypeTarif');
          $eclairage->PuissanceSouscrite = \Input::get('PuissanceSouscrite');
          $eclairage->PuissanceInstalle = \Input::get('PuissanceInstalle');
          $eclairage->PuissanceAppele = \Input::get('PuissanceAppele');
          $eclairage->Puissance = \Input::get('Puissance');
          $eclairage->NbrHeuresans = \Input::get('NbrHeuresans');
          $eclairage->TypeTechnologie = \Input::get('TypeTechnologie');
          $eclairage->MarqueLampe = \Input::get('MarqueLampe');
          $eclairage->NbrJourInterrupServ = \Input::get('NbrJourInterrupServ');
          $eclairage->NbrJourIntervServ = \Input::get('NbrJourIntervServ');

          $eclairage->save();

          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteureclairage_ids = array();
            $compteur_arr = \Input::get('compteurElectricitesID');
            foreach ($compteur_arr as $key => $compteur_id){
              $size = Compteureclairages::where('CompteurID', $compteur_id)->where('EclairageID',  $eclairage->EclairageID)->count();
              if($size <= 0){
                $compteureclairage = new Compteureclairages();
                $compteureclairage->EclairageID = $eclairage->EclairageID;
                $compteureclairage->CompteurID = $compteur_id;
                $compteureclairage->BaseID = $baseid;
                $compteureclairage->Pourcentage = 100;
                $compteureclairage->save();
              }
              $compteureclairage_ids[] = $compteur_id;
            }

            $existing_compteureclairages = DB::select("SELECT compteur.CompteurID, compteureclairages.EclairageID FROM compteur inner join compteureclairages on ( compteur.CompteurID=compteureclairages.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and compteureclairages.EclairageID={$eclairage->EclairageID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
            foreach ($existing_compteureclairages as $compteureclairage){
              if(!in_array($compteureclairage->CompteurID, $compteureclairage_ids)){
                DB::table('compteureclairages')->where('CompteurID', $compteureclairage->CompteurID)->where('EclairageID', $compteureclairage->EclairageID)->delete();
              }
            }
          }

          $modifierUrl = URL::to('tbge/patrimoine/eclairage/' . $eclairage->EclairageID . '/edit');
          Session::flash('eclairage.success', "<p>Mise-à-jour du poste d'éclairage effectuée avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier le poste d'éclairage</a></p>");
          return Redirect::to('tbge/patrimoine/eclairage');
        }
    }

    public function destroy($id)
    {
      $eclairage = Eclairages::find($id);
      $eclairage->delete();

      // redirect
      Session::flash('eclairage.success', "Poste d'éclairage supprimé avec succès !");
      return Redirect::to('tbge/patrimoine/eclairage');
    }

    public function importCsv()
    {
      $baseid = Auth::user()->BaseID; 

      return  View::make('tbge.patrimoine.eclairage.importcsv');
    }


    public function importCsvPosted()
    {
      $baseid = Auth::user()->BaseID; 

      if (Input::hasFile('csvFile')) {
        $file            = Input::file('csvFile');
        $extension = $file->getClientOriginalExtension();
        if('csv' !== $extension){
          return Redirect::to('tbge/patrimoine/eclairage/import/csv')
              ->with('message.error', "Le fichier à importer doit-être de type CSV !");
        }

        $file_name = $file->getClientOriginalName();
        $file_path = $file->getRealPath();

        if (($handle = fopen($file_path, "r")) === FALSE) {
          return Redirect::to('tbge/patrimoine/eclairage/import/csv')
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
        return  View::make('tbge.patrimoine.eclairage.importcsvimported')
          ->with('header', $tableau_head)
          ->with('data', $tableau_data);
      }

      return  View::make('tbge.patrimoine.eclairage.importcsv');
    }

    public function doImport(){
      $baseid = Auth::user()->BaseID; 

      DB::beginTransaction();

      DB::statement('SET FOREIGN_KEY_CHECKS=0;');

      DB::table('compteureclairages')->truncate();
      DB::table('eclairage')->truncate();

      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      
      Validator::extend('typeTechnologieValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          if(in_array($value, self::$typeTechnologies)){
            return true;
          }
          return false;
      });

      Validator::extend('typeTarifValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          if(in_array($value, self::$typeTarifs)){
            return true;
          }
          return false;
      });

      Validator::extend('categorieIDValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return true;
          }
          $categories = Categories::where('Libelle', $value)->where('CategorieparenteID', 8)->get();
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
              'Reference' => 'required',
              'Nom' => 'required',
              'TypeTarif' => 'typeTarifValide',
              "CompteurElectricites" => 'compteursValide',
              'CategorieID' => 'categorieIDValide',
              'TypeTechnologie' => 'typeTechnologieValide'
              ), array(
                'required' => "Le champ :attribute est obligatoire"
              )
          );

          if ($validation->fails()) {
              return Redirect::to('tbge/patrimoine/eclairage/import/csv')
                  ->withErrors($validation);
          } else {
            
            $typeTechnologieKey = "";
            if(in_array($row['TypeTechnologie'], self::$typeTechnologies)){
              $typeTechnologieKey = $key;
              break;
            }

            $categories = Categories::where('Libelle', $row['CategorieID'])->where('CategorieparenteID', 8)->get();
            
            $eclairage = new Eclairages();
            $eclairage->MouvrageID = Config::get('enertrack.MouvrageID');
            $eclairage->BaseID = $baseid;
            $eclairage->Reference = $row['Reference'];
            $eclairage->Nom = $row['Nom'];
            $eclairage->Secteur = $row['Secteur'];
            $eclairage->Nbrpointlumineux = $row['Nbrpointlumineux'];
            $eclairage->CategorieID = (empty($row['CategorieID'])) ? NULL : $categories[0]->CategorieID;
            $eclairage->TypeTarif = $row['TypeTarif'];
            $eclairage->PuissanceSouscrite = $row['PuissanceSouscrite'];
            $eclairage->PuissanceInstalle = $row['PuissanceInstalle'];
            $eclairage->PuissanceAppele = $row['PuissanceAppele'];
            //$eclairage->Puissance = $row['Puissance'];
            $eclairage->NbrHeuresans = $row['NbrHeuresans'];
            $eclairage->TypeTechnologie = $typeTechnologieKey;
            $eclairage->MarqueLampe = $row['MarqueLampe'];
            $eclairage->NbrJourInterrupServ = $row['NbrJourInterrupServ'];
            $eclairage->NbrJourIntervServ = $row['NbrJourIntervServ'];

            $eclairage->save();

            $compteurElectricites = explode("-", $row['CompteurElectricites']);
            if(is_array($compteurElectricites)){
              foreach ($compteurElectricites as $key => $compteurElectriciteReference) {
                $compteurs = Compteurs::where('Reference', $compteurElectriciteReference)->get();
                if(count($compteurs) > 0){
                  $compteureclairage = new Compteureclairages();
                  $compteureclairage->EclairageID = $eclairage->EclairageID;
                  $compteureclairage->CompteurID = $compteurs[0]->CompteurID;
                  $compteureclairage->BaseID = $baseid;
                  $compteureclairage->Pourcentage = 100;
                  $compteureclairage->save();               
                }
              }
            }

            $nombreLigneImportee = $nombreLigneImportee + 1;
          }
        }
      }


      DB::commit();

      Session::flash('success', "<p>Postes d'éclairage importés avec succès ! $nombreLigneImportee lignes importées </p>");
      return Redirect::to('tbge/patrimoine/eclairage');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}