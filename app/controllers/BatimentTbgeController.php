<?php

class BatimentTbgeController extends \BaseController {

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $batiments = DB::select("SELECT batiment.*, mouvrage.Societe, coordonnee.Societe as Contact FROM batiment INNER JOIN mouvrage ON mouvrage.MouvrageID = batiment.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = batiment.CoordonneeID WHERE batiment.BaseID='$baseid'");

      return  View::make('tbge.patrimoine.batiment.index')
        ->with('batiments', $batiments);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $patrimoines = array(1 => "Bâtiment administratif", 2 => "Bâtiment éducatif", 3 => "Bâtiment culturel", 4 => "Bâtiment commercial", 5 => "Bâtiment hospitalier", 6 => "Bâtiment touristique");

      $compteurEaux = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");
      
      return View::make('tbge.patrimoine.batiment.create')
        ->with('compteurEaux', $compteurEaux)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('patrimoines', $patrimoines);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required',
          'Anneeconstruction' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom du batiment est obligatoire !",
          'Anneeconstruction.required' => "L'année de construction du batiment est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/batiment/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $batiment = new Batiments();
          $batiment->MouvrageID = Config::get('enertrack.MouvrageID');
          $batiment->BaseID = $baseid;
          $batiment->Nom = \Input::get('Nom');
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
          $batiment->NbrEmployee = \Input::get('NbrEmployee');
          $batiment->Pv = \Input::get('Pv');
          $batiment->SystemeChauffageEau = \Input::get('SystemeChauffageEau');
          $batiment->Ces = \Input::get('Ces');

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

          Session::flash('batiment.success', "Création du batiment effectué avec succès");
          return Redirect::to('tbge/patrimoine/batiment');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $batiment = Batiments::find($id);

      $patrimoines = array(1 => "Bâtiment administratif", 2 => "Bâtiment éducatif", 3 => "Bâtiment culturel", 4 => "Bâtiment commercial", 5 => "Bâtiment hospitalier", 6 => "Bâtiment touristique");

      $compteurEaux = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");
      
      $compteurEauxSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurbatiments on ( compteur.CompteurID=compteurbatiments.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') and compteurbatiments.BatimentID={$batiment->BatimentID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      $compteurEauxSelected = $this->objectsToArray($compteurEauxSelected, 'CompteurID', 'CompteurID');

      $compteurElectricitesSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurbatiments on ( compteur.CompteurID=compteurbatiments.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') and compteurbatiments.BatimentID={$batiment->BatimentID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      $compteurElectricitesSelected = $this->objectsToArray($compteurElectricitesSelected, 'CompteurID', 'CompteurID');

      return View::make('tbge.patrimoine.batiment.edit')
        ->with('batiment', $batiment)
        ->with('compteurEaux', $compteurEaux)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('patrimoines', $patrimoines)
        ->with('compteurEauxSelected', $compteurEauxSelected)
        ->with('compteurElectricitesSelected', $compteurElectricitesSelected);
    }

    public function update($id){
      $baseid = Auth::user()->BaseID; ;

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required',
          'Anneeconstruction' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom du batiment est obligatoire !",
          'Anneeconstruction.required' => "L'année de construction du batiment est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/batiment/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $batiment = Batiments::find($id);
          $batiment->MouvrageID = Config::get('enertrack.MouvrageID');
          $batiment->Nom = \Input::get('Nom');
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
          $batiment->NbrEmployee = \Input::get('NbrEmployee');
          $batiment->Pv = \Input::get('Pv');
          $batiment->SystemeChauffageEau = \Input::get('SystemeChauffageEau');
          $batiment->Ces = \Input::get('Ces');

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

          Session::flash('batiment.success', "Mise-à-jour du batiment effectuée avec succès");
          return Redirect::to('tbge/patrimoine/batiment');
        }
    }

    public function destroy($id)
    {
      $batiment = Batiments::find($id);
      $batiment->delete();

      // redirect
      Session::flash('batiment.success', "Batiment supprimé avec succès !");
      return Redirect::to('tbge.patrimoine/batiment');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}