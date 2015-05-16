<?php

class FactureTbgeController extends \BaseController {

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      return  View::make('tbge.facture.index');
    }

    public function datatable(){

      $baseid = Auth::user()->BaseID; 

      $draw = \Input::get('draw');
      $start = \Input::get('start', 0);
      $length = \Input::get('length', 10);
      $search = \Input::get('search');
      $order = \Input::get('order');
      $columns = \Input::get('columns');


      $query = DB::table('facture')
        ->leftJoin('compteur', 'facture.CompteurID', '=', 'compteur.CompteurID')
        ->leftJoin('coordonnee', 'facture.FournisseurID', '=', 'coordonnee.CoordonneeID')
        ->where('compteur.BaseID', '=', $baseid);

      $total = $query->count();

      if($search['value'] != ''){
        $query->where(function($q) use($search){
          $q->where(DB::raw('LOWER(facture.Nom)'), 'LIKE', Str::lower('%' . trim($search['value']) . '%' ));
          $q->orwhere(DB::raw('LOWER(compteur.Reference)'), 'LIKE', Str::lower('%' . trim($search['value']) . '%' ));
          $q->orwhere(DB::raw('LOWER(compteur.Numero)'), 'LIKE', Str::lower('%' . trim($search['value']) . '%' ));
        });
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
      $list = $query->select('facture.*', 'compteur.Numero as compteur_numero', 'compteur.Reference as compteur_reference', 'coordonnee.Societe as fournisseur')->get();

      $datatable = new DataTableResponse($draw, $total, $total_search, $list, null);

      return Response::json($datatable);      
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      return View::make('tbge.facture.create');
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'CompteurID' => 'required',
          'Debutperiode' => 'required|date_format:"d/m/Y"',
          'Finperiode' => 'required|date_format:"d/m/Y"',
          'Totalttc' => 'required|numeric',
          'Consommation' => 'required|numeric'
          ), 
        array(
          'CompteurID.required' => "Merci de sélectionner le compteur associé à la facture",
          'Debutperiode.required' => "Merci de remplir le champ Du (date de début)",
          'Debutperiode.date_format' => "La date de début n'est pas une date valide au format (DD/MM/YYYY)",
          'Finperiode.required' => "Merci de remplir le champ Au",
          'Finperiode.date_format' => "La date de début n'est pas une date valide au format (DD/MM/YYYY)",
          'Totalttc.required' => "Merci de remplir le champ Cout TTC",
          'Consommation.required' => "Merci de remplir le champ Consommation",
          'Totalttc.numeric' => "Le Coût TTC doit-être au format (#0,00) avec deux chiffres après la virgule",
          'Consommation.numeric' => "La consommation doit-être au format (#0) sans virgule"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/facture/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $dateDebut = \Carbon\Carbon::createFromFormat('d/m/Y', Input::get('Debutperiode'));
          $dateFin = \Carbon\Carbon::createFromFormat('d/m/Y', Input::get('Finperiode'));

          $facture = new Factures();
          $facture->MouvrageID = Config::get('enertrack.MouvrageID');
          $facture->BaseID = $baseid;
          $facture->Nom = \Input::get('Nom');
          $facture->CompteurID = \Input::get('CompteurID');
          $facture->Debutperiode = $dateDebut->toDateString();
          $facture->Finperiode = $dateFin->toDateString();
          $facture->Totalttc = \Input::get('Totalttc');
          $facture->Consommation = \Input::get('Consommation');
          $facture->ValeurObservation = \Input::get('ValeurObservation');
          $facture->DateObservation = \Input::get('DateObservation');

          $facture->save();

          $modifierUrl = URL::to('tbge/facture/' . $facture->FactureID . '/edit');
          Session::flash('success', "<p>Création de la facture effectuée avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier la facture</a></p>");
          return Redirect::to('tbge/facture');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $facture = Factures::find($id);

      return View::make('tbge.facture.edit')
        ->with('facture', $facture);

    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'CompteurID' => 'required',
          'Debutperiode' => 'required|date_format:"d/m/Y"',
          'Finperiode' => 'required|date_format:"d/m/Y"',
          'Totalttc' => 'required|numeric',
          'Consommation' => 'required|numeric'
          ), 
        array(
          'CompteurID.required' => "Merci de sélectionner le compteur associé à la facture",
          'Debutperiode.required' => "Merci de remplir le champ Du (date de début)",
          'Debutperiode.date_format' => "La date de début n'est pas une date valide au format (DD/MM/YYYY)",
          'Finperiode.required' => "Merci de remplir le champ Au",
          'Finperiode.date_format' => "La date de début n'est pas une date valide au format (DD/MM/YYYY)",
          'Totalttc.required' => "Merci de remplir le champ Cout TTC",
          'Consommation.required' => "Merci de remplir le champ Consommation",
          'Totalttc.numeric' => "Le Coût TTC doit-être au format (#0,00) avec deux chiffres après la virgule",
          'Consommation.numeric' => "La consommation doit-être au format (#0) sans virgule"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/facture/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $dateDebut = \Carbon\Carbon::createFromFormat('d/m/Y', Input::get('Debutperiode'));
          $dateFin = \Carbon\Carbon::createFromFormat('d/m/Y', Input::get('Finperiode'));

          $facture = Factures::find($id);
          $facture->Nom = \Input::get('Nom');
          $facture->CompteurID = \Input::get('CompteurID');
          $facture->Debutperiode = $dateDebut;
          $facture->Finperiode = $dateFin;
          $facture->Totalttc = \Input::get('Totalttc');
          $facture->Consommation = \Input::get('Consommation');
          $facture->ValeurObservation = \Input::get('ValeurObservation');
          $facture->DateObservation = \Input::get('DateObservation');

          $facture->save();

          $modifierUrl = URL::to('tbge/facture/' . $facture->FactureID . '/edit');
          Session::flash('success', "<p>Mise-à-jour de la facture effectuée avec succès ! <a href='{$modifierUrl}' class='btn btn-success'>Modifier la facture</a></p>");
          return Redirect::to('tbge/facture');
        }
    }

    public function destroy($id)
    {
      $facture = Factures::find($id);
      $facture->delete();

      // redirect
      Session::flash('success', "Facture supprimée avec succès !");
      return Redirect::to('tbge/facture');
    }

    public function importCsv()
    {
      $baseid = Auth::user()->BaseID; 

      return  View::make('tbge.facture.importcsv');
    }


    public function importCsvPosted()
    {
      $baseid = Auth::user()->BaseID; 

      if (Input::hasFile('csvFile')) {
        $file            = Input::file('csvFile');
        $extension = $file->getClientOriginalExtension();
        if('csv' !== $extension){
          return Redirect::to('tbge/facture/import/csv')
              ->with('message.error', "Le fichier à importer doit-être de type CSV !");
        }

        $file_name = $file->getClientOriginalName();
        $file_path = $file->getRealPath();

        if (($handle = fopen($file_path, "r")) === FALSE) {
          return Redirect::to('tbge/facture/import/csv')
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
        return  View::make('tbge.facture.importcsvimported')
          ->with('header', $tableau_head)
          ->with('data', $tableau_data);
      }

      return  View::make('tbge.facture.importcsv');
    }

    public function doImport(){
      $baseid = Auth::user()->BaseID; 

      DB::beginTransaction();

      //DB::statement('SET FOREIGN_KEY_CHECKS=0;');

      //DB::table('compteurarriveeaux')->truncate();
      //DB::table('arriveeau')->truncate();

      //DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      
      Validator::extend('compteursValide', function($attribute, $value, $parameters)
      {
          if(empty($value)){
            return false;
          }

          $compteurs = Compteurs::where('Reference', $value)->get();
          if(count($compteurs) > 0){
            return true;
          }else{
            return true;
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
              'Debutperiode' => 'required|date',
              'Finperiode' => 'required|date',
              'Totalttc' => 'required|numeric',
              "CompteurID" => 'compteursValide'
              ), array(
                'required' => "Le champ :attribute est obligatoire"
              )
          );

          if ($validation->fails()) {
            DB::rollback();
            dd($row);
              /*return Redirect::to('tbge/facture/import/csv')
                  ->withErrors($validation);*/
          } else {
            $compteurs = Compteurs::where('Reference', $row['CompteurID'])->get();

            $factures = Factures::where('Nom', $row['CompteurID'])->get();
            if($factures->count() <= 0){
              $facture = new Factures();
            }else{
              $facture = $factures[0];
            }

            $facture->MouvrageID = Config::get('enertrack.MouvrageID');
            $facture->BaseID = $baseid;
            $facture->Nom = $row['Numero'];
            if($compteurs->count() >0){
              $facture->CompteurID = $compteurs[0]->CompteurID;  
            }else{
              dd($row);
            }
            $facture->Debutperiode = $row['Debutperiode'];
            $facture->Finperiode = $row['Finperiode'];
            $facture->Totalttc = $row['Totalttc'];
            $facture->Consommation = $row['Consommation'];
            $facture->ValeurObservation = null;
            $facture->DateObservation = null;

            $facture->save();

            $nombreLigneImportee = $nombreLigneImportee + 1;
          }
        }
      }

      DB::commit();
      //DB::rollback();
      //dd("OK");

      Session::flash('success', "<p>Factures importés avec succès ! $nombreLigneImportee lignes importées </p>");
      return Redirect::to('tbge/facture');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}