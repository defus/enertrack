<?php

class EclairageTbgeController extends \BaseController {

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

      $typeTechnologies = array(1 => "Lampes à incandescence", 2 => "LED", 3 => "Solaire");
      
      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      return View::make('tbge.patrimoine.eclairage.create')
        ->with('typeTechnologies', $typeTechnologies)
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
          $eclairage->Nom = \Input::get('Nom');
          $eclairage->Nbrpointlumineux = \Input::get('Nbrpointlumineux');
          $eclairage->CategorieID = \Input::get('CategorieID');
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

          Session::flash('eclairage.success', "Création du poste d'éclairage effectuée avec succès");
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

      $typeTechnologies = array(1 => "Lampes à incandescence", 2 => "LED", 3 => "Solaire");
      
      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      $compteurElectricitesSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteureclairages on ( compteur.CompteurID=compteureclairages.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and compteureclairages.EclairageID={$eclairage->EclairageID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      $compteurElectricitesSelected = $this->objectsToArray($compteurElectricitesSelected, 'CompteurID', 'CompteurID');
      
      return View::make('tbge.patrimoine.eclairage.edit')
        ->with('eclairage', $eclairage)
        ->with('typeTechnologies', $typeTechnologies)
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
          $eclairage->Nom = \Input::get('Nom');
          $eclairage->Nbrpointlumineux = \Input::get('Nbrpointlumineux');
          $eclairage->CategorieID = \Input::get('CategorieID');
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

          Session::flash('eclairage.success', "Mise-à-jour du poste d'éclairage effectuée avec succès");
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

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}