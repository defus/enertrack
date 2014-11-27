<?php

class EspacevertTbgeController extends \BaseController {

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

      $compteurEaux = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");
      
      $systemearrosages = array(1 => 'Manuel', 2 => 'Goutteur isolé', 3 => 'Microjets', 4 => 'Turbine et tuyère escamotables', 5 => 'Enrouleur');

      return View::make('tbge.patrimoine.espacevert.create')
        ->with('compteurEaux', $compteurEaux)
        ->with('compteurElectricites', $compteurElectricites)
        ->with('systemearrosages', $systemearrosages);
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

          $espacevert->save();

          //Ajouter les associations compteurs
          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurs_arr = \Input::get('compteurElectricitesID');
            foreach($compteurs_arr as $compteur_id){
              $compteurespacevert = new Compteurespaceverts();
              $compteurespacevert->EspacevertID = $espacevert->EspacevertID;
              $compteurespacevert->CompteurID = $compteur_id;
              $compteurespacevert->BaseID = $baseid;
              $compteurespacevert->Pourcentage = 100;
              $compteurespacevert->save();
            }
          }
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

          Session::flash('espacevert.success', "Création de l'espace vert effectuée avec succès");
          return Redirect::to('tbge/patrimoine/espacevert');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $espacevert = Espaceverts::find($id);

      $systemearrosages = array(1 => 'Manuel', 2 => 'Goutteur isolé', 3 => 'Microjets', 4 => 'Turbine et tuyère escamotables', 5 => 'Enrouleur');

      $compteurEaux = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");

      $compteurElectricites = DB::select("SELECT compteur.CompteurID ,compteur.Nom, compteur.Reference, compteur.Localisation, compteur.BaseID, energie.Nom as Energie, energie.Couleur  FROM compteur left join energie on ( compteur.EnergieID=energie.EnergieID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference  ");
      
      $compteurEauxSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurespaceverts on ( compteur.CompteurID=compteurespaceverts.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSOEAU') and compteurespaceverts.EspacevertID={$espacevert->EspacevertID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      $compteurEauxSelected = $this->objectsToArray($compteurEauxSelected, 'CompteurID', 'CompteurID');

      $compteurElectricitesSelected = DB::select("SELECT compteur.CompteurID FROM compteur inner join compteurespaceverts on ( compteur.CompteurID=compteurespaceverts.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') and compteurespaceverts.EspacevertID={$espacevert->EspacevertID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
      $compteurElectricitesSelected = $this->objectsToArray($compteurElectricitesSelected, 'CompteurID', 'CompteurID');

      return View::make('tbge.patrimoine.espacevert.edit')
        ->with('systemearrosages', $systemearrosages)
        ->with('espacevert', $espacevert)
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

          if(is_array(\Input::get('compteurElectricitesID'))){
            $compteurespacevert_ids = array();
            $compteur_arr = \Input::get('compteurElectricitesID');
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

            $existing_compteurespaceverts = DB::select("SELECT compteur.CompteurID, compteurespaceverts.EspacevertID FROM compteur inner join compteurespaceverts on ( compteur.CompteurID=compteurespaceverts.CompteurID) WHERE compteur.BaseID='$baseid' and compteur.Clos=0 and (compteur.Type='CONSO') and compteurespaceverts.EspacevertID={$espacevert->EspacevertID} ORDER BY compteur.EnergieID, compteur.Nom, compteur.Reference");
            foreach ($existing_compteurespaceverts as $compteurespacevert){
              if(!in_array($compteurespacevert->CompteurID, $compteurespacevert_ids)){
                DB::table('compteurespaceverts')->where('CompteurID', $compteurespacevert->CompteurID)->where('EspacevertID', $compteurespacevert->EspacevertID)->delete();
              }
            }
          }

          Session::flash('espacevert.success', "Mise-à-jour du espacevert effectuée avec succès");
          return Redirect::to('tbge/patrimoine/espacevert');
        }
    }

    public function destroy($id)
    {
      $espacevert = Espaceverts::find($id);
      $espacevert->delete();

      // redirect
      Session::flash('espacevert.success', "Espace vert supprimé avec succès !");
      return Redirect::to('tbge.patrimoine/espacevert');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}