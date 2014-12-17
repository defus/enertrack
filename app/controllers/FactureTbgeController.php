<?php

class FactureTbgeController extends \BaseController {

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $factures = Factures::where('BaseID', 'like', $baseid)->orderBy('Debutperiode', 'DESC')->get();

      return  View::make('tbge.facture.index')
        ->with('factures', $factures);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $compteurs = array();
      $compteurs['batiment'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, batiment.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurbatiments  ON (compteur.CompteurID=compteurbatiments.CompteurID and compteur.BaseID=compteurbatiments.BaseID ) INNER JOIN batiment  ON (batiment.BatimentID=compteurbatiments.BatimentID and batiment.BaseID=compteurbatiments.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['eclairage'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, eclairage.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteureclairages  ON (compteur.CompteurID=compteureclairages.CompteurID and compteur.BaseID=compteureclairages.BaseID ) INNER JOIN eclairage  ON (eclairage.EclairageID=compteureclairages.EclairageID and eclairage.BaseID=compteureclairages.BaseID) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['vehicule'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, vehicule.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurvehicules  ON (compteur.CompteurID=compteurvehicules.CompteurID and compteur.BaseID=compteurvehicules.BaseID ) INNER JOIN vehicule  ON (vehicule.VehiculeID=compteurvehicules.VehiculeID and vehicule.BaseID=compteurvehicules.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['posteproduction'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, posteproduction.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurposteproductions  ON (compteur.CompteurID=compteurposteproductions.CompteurID and compteur.BaseID=compteurposteproductions.BaseID ) INNER JOIN posteproduction  ON (posteproduction.PosteproductionID=compteurposteproductions.PosteproductionID and posteproduction.BaseID=compteurposteproductions.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['autreposte'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, autreposte.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurautrepostes  ON (compteur.CompteurID=compteurautrepostes.CompteurID and compteur.BaseID=compteurautrepostes.BaseID ) INNER JOIN autreposte  ON (autreposte.AutreposteID=compteurautrepostes.AutreposteID and autreposte.BaseID=compteurautrepostes.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['espacevert'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, espacevert.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurespaceverts  ON (compteur.CompteurID=compteurespaceverts.CompteurID and compteur.BaseID=compteurespaceverts.BaseID ) INNER JOIN espacevert  ON (espacevert.EspacevertID=compteurespaceverts.EspacevertID and espacevert.BaseID=compteurespaceverts.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['arriveeau'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, arriveeau.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurarriveeaux  ON (compteur.CompteurID=compteurarriveeaux.CompteurID and compteur.BaseID=compteurarriveeaux.BaseID ) INNER JOIN arriveeau  ON (arriveeau.ArriveeauID=compteurarriveeaux.ArriveeauID and arriveeau.BaseID=compteurarriveeaux.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['tous'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, 'tous' as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
        
      return View::make('tbge.facture.create')
        ->with('compteurs', $compteurs);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'CompteurID' => 'required',
          'Debutperiode' => 'required|date',
          'Finperiode' => 'required|date',
          'Totalttc' => 'required',
          'Consommation' => 'required'
          ), 
        array(
          'CompteurID.required' => "Merci de sélectionner le compteur associé à la facture",
          'Debutperiode.required' => "Merci de remplir le champ Du (date de début)",
          'Debutperiode.date' => "La date de début n'est pas une date valide au format ???",
          'Finperiode.required' => "Merci de remplir le champ Au",
          'Finperiode.date' => "La date de début n'est pas une date valide au format ???",
          'Totalttc.required' => "Merci de remplir le champ Cout TTC",
          'Consommation.required' => "Merci de remplir le champ Consommation"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/facture/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $facture = new Factures();
          $facture->MouvrageID = Config::get('enertrack.MouvrageID');
          $facture->BaseID = $baseid;
          $facture->Nom = \Input::get('Nom');
          $facture->CompteurID = \Input::get('CompteurID');
          $facture->Debutperiode = \Input::get('Debutperiode');
          $facture->Finperiode = \Input::get('Finperiode');
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
      
      $compteurs = array();
      $compteurs['batiment'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, batiment.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurbatiments  ON (compteur.CompteurID=compteurbatiments.CompteurID and compteur.BaseID=compteurbatiments.BaseID ) INNER JOIN batiment  ON (batiment.BatimentID=compteurbatiments.BatimentID and batiment.BaseID=compteurbatiments.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['eclairage'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, eclairage.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteureclairages  ON (compteur.CompteurID=compteureclairages.CompteurID and compteur.BaseID=compteureclairages.BaseID ) INNER JOIN eclairage  ON (eclairage.EclairageID=compteureclairages.EclairageID and eclairage.BaseID=compteureclairages.BaseID) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['vehicule'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, vehicule.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurvehicules  ON (compteur.CompteurID=compteurvehicules.CompteurID and compteur.BaseID=compteurvehicules.BaseID ) INNER JOIN vehicule  ON (vehicule.VehiculeID=compteurvehicules.VehiculeID and vehicule.BaseID=compteurvehicules.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['posteproduction'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, posteproduction.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurposteproductions  ON (compteur.CompteurID=compteurposteproductions.CompteurID and compteur.BaseID=compteurposteproductions.BaseID ) INNER JOIN posteproduction  ON (posteproduction.PosteproductionID=compteurposteproductions.PosteproductionID and posteproduction.BaseID=compteurposteproductions.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['autreposte'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, autreposte.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurautrepostes  ON (compteur.CompteurID=compteurautrepostes.CompteurID and compteur.BaseID=compteurautrepostes.BaseID ) INNER JOIN autreposte  ON (autreposte.AutreposteID=compteurautrepostes.AutreposteID and autreposte.BaseID=compteurautrepostes.BaseID )WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['espacevert'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, espacevert.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurespaceverts  ON (compteur.CompteurID=compteurespaceverts.CompteurID and compteur.BaseID=compteurespaceverts.BaseID ) INNER JOIN espacevert  ON (espacevert.EspacevertID=compteurespaceverts.EspacevertID and espacevert.BaseID=compteurespaceverts.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['arriveeau'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, arriveeau.Nom as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) INNER JOIN compteurarriveeaux  ON (compteur.CompteurID=compteurarriveeaux.CompteurID and compteur.BaseID=compteurarriveeaux.BaseID ) INNER JOIN arriveeau  ON (arriveeau.ArriveeauID=compteurarriveeaux.ArriveeauID and arriveeau.BaseID=compteurarriveeaux.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      $compteurs['tous'] = DB::select("select compteur.CompteurID,  compteur.Numero,  energie.Nom as Energie,  compteur.Reference,  compteur.Localisation, 'tous' as Patrimoine FROM compteur LEFT JOIN energie  ON (compteur.EnergieID=energie.EnergieID and compteur.BaseID=energie.BaseID ) WHERE compteur.Clos=0 AND compteur.BaseID='".$baseid."' order by Numero");
      
      $facture = Factures::find($id);

      return View::make('tbge.facture.edit')
        ->with('facture', $facture)
        ->with('compteurs', $compteurs);

    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'CompteurID' => 'required',
          'Debutperiode' => 'required|date',
          'Finperiode' => 'required|date',
          'Totalttc' => 'required',
          'Consommation' => 'required'
          ), 
        array(
          'CompteurID.required' => "Merci de remplir le champ compteur associé",
          'Debutperiode.required' => "Merci de remplir le champ Du",
          'Debutperiode.date' => "La date de début n'est pas une date valide au format ???",
          'Finperiode.required' => "Merci de remplir le champ Au",
          'Finperiode.date' => "La date de début n'est pas une date valide au format ???",
          'Totalttc.required' => "Merci de remplir le champ Cout TTC",
          'Consommation.required' => "Merci de remplir le champ Consommation"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('tbge/facture/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $facture = Factures::find($id);
          $facture->Nom = \Input::get('Nom');
          $facture->CompteurID = \Input::get('CompteurID');
          $facture->Debutperiode = \Input::get('Debutperiode');
          $facture->Finperiode = \Input::get('Finperiode');
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

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}