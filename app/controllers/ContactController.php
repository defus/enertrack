<?php

class ContactController extends \BaseController {

    public function index()
    {
      $baseid = Auth::user()->BaseID; 

      $contacts = Contacts::where('BaseID', 'like', $baseid)->orderBy('CoordonneeID', 'ASC')->get();
      return  View::make('contact.index')->with('contacts', $contacts);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 

      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');
      
      return View::make('contact.create')
        ->with('mos', $mos);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Societe' => 'required'
          ), 
        array(
          'Societe.required' => "La Societe est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('contact/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $contact = new Contacts();
          $contact->Societe = \Input::get('Societe');
          $contact->BaseID = $baseid;
          $contact->Prenom = \Input::get('Prenom');
          $contact->Nom = \Input::get('Nom');
          $contact->Tel = \Input::get('Tel');
          $contact->Mail = \Input::get('Mail');
          $contact->Adresse1 = \Input::get('Adresse1');
          $contact->Adresse2 = \Input::get('Adresse2');
          $contact->Adresse3 = \Input::get('Adresse3');
          $contact->Codepostal = \Input::get('Codepostal');
          $contact->Ville = \Input::get('Ville');
          $contact->Pays = \Input::get('Pays');
          $contact->Site = \Input::get('Site');
          $contact->Commentaire = \Input::get('Commentaire');
          $contact->MouvrageID = \Input::get('MouvrageID');
          $contact->UtilisateurID = \Input::get('UtilisateurID');
          
          $contact->save();

          Session::flash('success', "Création du contact effectué avec succès");
          return Redirect::to('contact');
        }
    }

    public function show($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $contact = Contacts::find($id);

      return View::make('contact.show')
        ->with('contact', $contact)
        ->with('mos', $mos);
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $contact = Contacts::find($id);

      return View::make('contact.edit')
        ->with('contact', $contact)
        ->with('mos', $mos);
    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'Societe' => 'required'
          ), 
        array(
          'Societe.required' => "La Societe est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('contact/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $contact = Contacts::find($id);
          $contact->Societe = \Input::get('Societe');
          $contact->Prenom = \Input::get('Prenom');
          $contact->Nom = \Input::get('Nom');
          $contact->Tel = \Input::get('Tel');
          $contact->Mail = \Input::get('Mail');
          $contact->Adresse1 = \Input::get('Adresse1');
          $contact->Adresse2 = \Input::get('Adresse2');
          $contact->Adresse3 = \Input::get('Adresse3');
          $contact->Codepostal = \Input::get('Codepostal');
          $contact->Ville = \Input::get('Ville');
          $contact->Pays = \Input::get('Pays');
          $contact->Site = \Input::get('Site');
          $contact->Commentaire = \Input::get('Commentaire');
          $contact->MouvrageID = \Input::get('MouvrageID');
          $contact->UtilisateurID = \Input::get('UtilisateurID');

          $contact->save();

          Session::flash('success', "Mise-à-jour du contact effectuée avec succès");
          return Redirect::to('contact');
        }
    }

    public function destroy($id)
    {
      $contact = Contacts::find($id);
      $contact->delete();

      // redirect
      Session::flash('success', "Contact supprimé avec succès !");
      return Redirect::to('contact');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}