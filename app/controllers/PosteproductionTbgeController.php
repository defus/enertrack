<?php

class PosteproductionTbgeController extends \BaseController {

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $posteproductions = DB::select("SELECT posteproduction.*, mouvrage.Societe, coordonnee.Societe as Contact, categorie.libelle as categorie FROM posteproduction  INNER JOIN mouvrage ON mouvrage.MouvrageID = posteproduction.MouvrageID LEFT OUTER JOIN coordonnee ON coordonnee.CoordonneeID = posteproduction.CoordonneeID LEFT OUTER JOIN categorie on categorie.CategorieID = posteproduction.CategorieID WHERE posteproduction.BaseID='$baseid'");

      return  View::make('tbge.patrimoine.posteproduction.index')
        ->with('posteproductions', $posteproductions);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =9 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      $energies = array( 1 => 'Eau', 2 => 'Electricité', 3 => 'Chaleur (chauffage)', 4 => 'Chaleur froide (refroidissement)');

      return View::make('tbge.patrimoine.posteproduction.create')
        ->with('energies', $energies)
        ->with('categories', $categories)
        ->with('compteurElectricites', $compteurElectricites);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom du poste de production est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/posteproduction/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $posteproduction = new Posteproductions();
          $posteproduction->MouvrageID = Config::get('enertrack.MouvrageID');
          $posteproduction->BaseID = $baseid;
          $posteproduction->Nom = \Input::get('Nom');
          $posteproduction->Energie = \Input::get('Energie');
          $posteproduction->CategorieID = \Input::get('CategorieID');
          $posteproduction->Latitude = \Input::get('Latitude');
          $posteproduction->Longitude = \Input::get('Longitude');
          $posteproduction->Anneeconstruction = \Input::get('Anneeconstruction');
          
          $posteproduction->save();

          //Ajouter les associations compteurs
          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurs_arr = \Input::get('compteurElectricitesID');
            foreach($compteurs_arr as $compteur_id){
              $compteurposteproduction = new Compteurposteproductions();
              $compteurposteproduction->PosteproductionID = $posteproduction->PosteproductionID;
              $compteurposteproduction->CompteurID = $compteur_id;
              $compteurposteproduction->BaseID = $baseid;
              $compteurposteproduction->Pourcentage = 100;
              $compteurposteproduction->save();
            }
          }
          if(is_array(\Input::get('compteurEauxID'))){
            $compteurs_arr = \Input::get('compteurEauxID');
            foreach($compteurs_arr as $compteur_id){
              $compteurposteproduction = new Compteurposteproductions();
              $compteurposteproduction->PosteproductionID = $posteproduction->PosteproductionID;
              $compteurposteproduction->CompteurID = $compteur_id;
              $compteurposteproduction->BaseID = $baseid;
              $compteurposteproduction->Pourcentage = 100;
              $compteurposteproduction->save();
            }
          }

          Session::flash('posteproduction.success', "Création du poste de production effectuée avec succès");
          return Redirect::to('tbge/patrimoine/posteproduction');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $posteproduction = Posteproductions::find($id);

      $categories = DB::select("select CategorieID, Libelle from categorie WHERE `CategorieparenteID` =9 AND `BaseID` = '".$baseid."' order by Libelle");
      $categories = $this->objectsToArray($categories, 'CategorieID', 'Libelle');

      $energies = array( 1 => 'Eau', 2 => 'Electricité', 3 => 'Chaleur (chauffage)', 4 => 'Chaleur froide (refroidissement)');

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0  ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");
      
      $compteurElectricitesSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurposteproductions on ( compteur.CompteurID=compteurposteproductions.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0  and compteurposteproductions.PosteproductionID={$posteproduction->PosteproductionID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      $compteurElectricitesSelected = $this->objectsToArray($compteurElectricitesSelected, 'CompteurID', 'CompteurID');

      return View::make('tbge.patrimoine.posteproduction.edit')
        ->with('posteproduction', $posteproduction)
        ->with('energies', $energies)
        ->with('categories', $categories)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('compteurElectricitesSelected', $compteurElectricitesSelected);
    }

    public function update($id){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Nom' => 'required'
          ), 
        array(
          'Nom.required' => "Le nom du poste de production est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/patrimoine/posteproduction/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $posteproduction = Posteproductions::find($id);
          $posteproduction->MouvrageID = Config::get('enertrack.MouvrageID');
          $posteproduction->Nom = \Input::get('Nom');
          $posteproduction->Energie = \Input::get('Energie');
          $posteproduction->CategorieID = \Input::get('CategorieID');
          $posteproduction->Latitude = \Input::get('Latitude');
          $posteproduction->Longitude = \Input::get('Longitude');
          $posteproduction->Anneeconstruction = \Input::get('Anneeconstruction');

          $posteproduction->save();

          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurposteproduction_ids = array();
            $compteur_arr = \Input::get('compteurElectricitesID');
            foreach ($compteur_arr as $key => $compteur_id){
              $size = Compteurposteproductions::where('CompteurID', $compteur_id)->where('PosteproductionID',  $posteproduction->PosteproductionID)->count();
              if($size <= 0){
                $compteurposteproduction = new Compteurposteproductions();
                $compteurposteproduction->PosteproductionID = $posteproduction->PosteproductionID;
                $compteurposteproduction->CompteurID = $compteur_id;
                $compteurposteproduction->BaseID = $baseid;
                $compteurposteproduction->Pourcentage = 100;
                $compteurposteproduction->save();
              }
              $compteurposteproduction_ids[] = $compteur_id;
            }

            $existing_compteurposteproductions = DB::select("SELECT compteur.CompteurID, compteurposteproductions.PosteproductionID FROM compteur inner join compteurposteproductions on ( compteur.CompteurID=compteurposteproductions.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and compteurposteproductions.PosteproductionID={$posteproduction->PosteproductionID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
            foreach ($existing_compteurposteproductions as $compteurposteproduction){
              if(!in_array($compteurposteproduction->CompteurID, $compteurposteproduction_ids)){
                DB::table('compteurposteproductions')->where('CompteurID', $compteurposteproduction->CompteurID)->where('PosteproductionID', $compteurposteproduction->PosteproductionID)->delete();
              }
            }
          }

          Session::flash('posteproduction.success', "Mise-à-jour du poste de production effectuée avec succès");
          return Redirect::to('tbge/patrimoine/posteproduction');
        }
    }

    public function destroy($id)
    {
      $posteproduction = Posteproductions::find($id);
      $posteproduction->delete();

      // redirect
      Session::flash('posteproduction.success', "Poste de production supprimé avec succès !");
      return Redirect::to('tbge/patrimoine/posteproduction');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}