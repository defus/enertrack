<?php

class CompteurController extends \BaseController {

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $compteurs = Compteurs::where('BaseID', 'like', $baseid)->get();
      return  View::make('compteur.index')->with('compteurs', $compteurs);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $batiments = DB::select("select BatimentID, Nom from batiment WHERE `BaseID` = '".$baseid."' order by Nom");
      $vehicules = DB::select("select VehiculeID, Nom from vehicule WHERE `BaseID` = '".$baseid."' order by Nom");
      $eclairages = DB::select("select EclairageID, Nom from eclairage WHERE `BaseID` = '".$baseid."' order by Nom");
      $posteproductions = DB::select("select PosteproductionID, Nom from posteproduction WHERE `BaseID` = '".$baseid."' order by Nom");
      $autrepostes = DB::select("select AutreposteID, Nom from autreposte WHERE `BaseID` = '".$baseid."' order by Nom");
      
      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $energies = DB::select("select EnergieID, Nom from energie WHERE `BaseID` = '".$baseid."' order by Nom");
      $energies = $this->objectsToArray($energies, 'EnergieID', 'Nom');

      $fournisseurs = DB::select("select CoordonneeID, Societe from coordonnee WHERE  Type='Fournisseur'   AND BaseID='".$baseid."' order by Societe");
      $fournisseurs = $this->objectsToArray($fournisseurs, 'CoordonneeID', 'Societe');

      $compteurexistants = DB::select("select compteur.CompteurID,  energie.Nom + compteur.Reference + compteur.Localisation as compteur FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) WHERE compteur.BaseID='".$baseid."' order by compteur.Nom");
      $compteurexistants = $this->objectsToArray($compteurexistants, 'CompteurID', 'compteur');

      $compteurprods = DB::select("select CompteurID, Nom   FROM compteur  WHERE BaseID='".$baseid."' AND (Type='PROD' OR Type='PRODEAU' OR Type='FABRICATION') order by Nom");
      $compteurprods = $this->objectsToArray($compteurprods, 'CompteurID', 'Nom');
      
      return View::make('compteur.create')
        ->with('mos', $mos)
        ->with('energies', $energies)
        ->with('fournisseurs', $fournisseurs)
        ->with('compteurexistants', $compteurexistants)
        ->with('compteurprods', $compteurprods)
        ->with('batiments', $batiments)
        ->with('vehicules', $vehicules)
        ->with('eclairages', $eclairages)
        ->with('posteproductions', $posteproductions)
        ->with('autrepostes', $autrepostes);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required',
          'Type' => 'required',
          'EnergieID' => 'required',
          'patrimoine' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du compteur est obligatoire !",
          'Type.required' => "Le type est obligatoire !",
          'EnergieID.required' => "La consommation est obligatoire !",
          'patrimoine.required' => "Le patrimoine est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('compteur/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $patrimoine = \Input::get('patrimoine');
          $patrimoine = explode('-', $patrimoine);
          dd($patrimoine);

          $compteur = new Compteurs();
          $compteur->MouvrageID = \Input::get('MouvrageID');
          $compteur->BaseID = $baseid;
          $compteur->Nom = \Input::get('Nom');
          $compteur->Type = \Input::get('Type');
          $compteur->EnergieID = \Input::get('EnergieID');
          $compteur->CompteurprodID = \Input::get('CompteurprodID');
          $compteur->Estenergie = \Input::get('Estenergie');
          $compteur->Reference = \Input::get('Reference');
          $compteur->Localisation = \Input::get('Localisation');
          $compteur->FournisseurID = \Input::get('FournisseurID');
          $compteur->Caracteristique = \Input::get('Caracteristique');
          $compteur->Nomprestataire = \Input::get('Nomprestataire');
          $compteur->Commentaire = \Input::get('Commentaire');
          $compteur->Seuil = \Input::get('Seuil');
          $compteur->Objectif = \Input::get('Objectif');
          $compteur->Seuil = \Input::get('Seuil');
          $compteur->Clos = \Input::get('Clos');
          $compteur->Reference2 = \Input::get('Reference2');

          $compteur->save();

          Session::flash('success', "Création du compteur effectué avec succès");
          return Redirect::to('compteur');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $energies = DB::select("select EnergieID, Nom from energie WHERE `BaseID` = '".$baseid."' order by Nom");
      $energies = $this->objectsToArray($energies, 'EnergieID', 'Nom');

      $fournisseurs = DB::select("select CoordonneeID, Societe from coordonnee WHERE  Type='Fournisseur'  AND BaseID='".$baseid."' order by Societe");
      $fournisseurs = $this->objectsToArray($fournisseurs, 'CoordonneeID', 'Societe');

      $compteurexistants = DB::select("select compteur.CompteurID,  energie.Nom + compteur.Reference + compteur.Localisation as compteur FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) WHERE compteur.BaseID='".$baseid."' order by compteur.Nom");
      $compteurexistants = $this->objectsToArray($compteurexistants, 'CompteurID', 'compteur');

      $compteurprods = DB::select("select CompteurID, Nom   FROM compteur  WHERE BaseID='".$baseid."' AND (Type='PROD' OR Type='PRODEAU' OR Type='FABRICATION') order by Nom");
      $compteurprods = $this->objectsToArray($compteurprods, 'CompteurID', 'Nom');

      $compteur = Compteurs::find($id);

      return View::make('compteur.edit')
        ->with('compteur', $compteur)
        ->with('mos', $mos)
        ->with('energies', $energies)
        ->with('fournisseurs', $fournisseurs)
        ->with('compteurexistants', $compteurexistants)
        ->with('compteurprods', $compteurprods);
    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'MouvrageID' => 'required',
          'Nom' => 'required',
          'Type' => 'required',
          'EnergieID' => 'required'
          ), 
        array(
          'MouvrageID.required' => "Le maitre d'ouvrage est obligatoire !",
          'Nom.required' => "Le nom du compteur est obligatoire !",
          'Type.required' => "Le type est obligatoire !",
          'EnergieID.required' => "La consommation est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('compteur/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $compteur = Compteurs::find($id);
          $compteur->MouvrageID = \Input::get('MouvrageID');
          $compteur->Nom = \Input::get('Nom');
          $compteur->Type = \Input::get('Type');
          $compteur->EnergieID = \Input::get('EnergieID');
          $compteur->CompteurprodID = \Input::get('CompteurprodID');
          $compteur->Estenergie = \Input::get('Estenergie');
          $compteur->Reference = \Input::get('Reference');
          $compteur->Localisation = \Input::get('Localisation');
          $compteur->FournisseurID = \Input::get('FournisseurID');
          $compteur->Caracteristique = \Input::get('Caracteristique');
          $compteur->Nomprestataire = \Input::get('Nomprestataire');
          $compteur->Commentaire = \Input::get('Commentaire');
          $compteur->Seuil = \Input::get('Seuil');
          $compteur->Objectif = \Input::get('Objectif');
          $compteur->Seuil = \Input::get('Seuil');
          $compteur->Clos = \Input::get('Clos');
          $compteur->Reference2 = \Input::get('Reference2');

          $compteur->save();

          Session::flash('success', "Mise-à-jour du compteur effectuée avec succès");
          return Redirect::to('compteur');
        }
    }

    public function destroy($id)
    {
      $compteur = Compteurs::find($id);
      $compteur->delete();

      // redirect
      Session::flash('success', "Compteur supprimé avec succès !");
      return Redirect::to('compteur');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}