<?php

class MoanController extends \BaseController {

    public function index()
    {
      $moans = Moans::orderBy('MoanID', 'ASC')->get();
      return  View::make('moan.index')->with('moans', $moans);
    }

    public function create()
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      return View::make('moan.create')
        ->with('mos', $mos);
    }

    public function store(){
      $baseid = Auth::user()->BaseID; 

      $validation = Validator::make(\Input::all(), 
        array(
          'Annee' => 'required'
          ), 
        array(
          'Annee.required' => "L'année est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('moan/create')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $moan = new Moans();
          $moan->Annee = \Input::get('Annee');
          $moan->BaseID = $baseid;
          $moan->Budget = \Input::get('Budget');
          $moan->Frequentation = \Input::get('Frequentation');
          $moan->Typefrequentation = \Input::get('Typefrequentation');
          $moan->Objectif = \Input::get('Objectif');
          $moan->MouvrageID = \Input::get('MouvrageID');
          
          $moan->save();

          Session::flash('success', "Création du budget et fréquentation effectué avec succès");
          return Redirect::to('moan');
        }
    }

    public function edit($id)
    {
      $username = Auth::user()->Username;
      $baseid = Auth::user()->BaseID; 
      
      $mos = DB::select("select MouvrageID, Societe from mouvrage WHERE `BaseID` = '".$baseid."' order by Societe");
      $mos = $this->objectsToArray($mos, 'MouvrageID', 'Societe');

      $moan = Moans::find($id);

      return View::make('moan.edit')
        ->with('moan', $moan)
        ->with('mos', $mos);
    }

    public function update($id){

      $validation = Validator::make(\Input::all(), 
        array(
          'Annee' => 'required'
          ), 
        array(
          'Annee.required' => "L'année est obligatoire !"
        )
      );

      if ($validation->fails()) {
          return Redirect::to('moan/' . $id . '/edit')
              ->withErrors($validation)
              ->withInput(\Input::all());
        } else {
          $moan = Moans::find($id);
          $moan->Annee = \Input::get('Annee');
          $moan->Budget = \Input::get('Budget');
          $moan->Frequentation = \Input::get('Frequentation');
          $moan->Typefrequentation = \Input::get('Typefrequentation');
          $moan->Objectif = \Input::get('Objectif');
          $moan->MouvrageID = \Input::get('MouvrageID');

          $moan->save();

          Session::flash('success', "Mise-à-jour du budget et de la fréquentation du maitre d'ouvrage effectuée avec succès");
          return Redirect::to('moan');
        }
    }

    public function destroy($id)
    {
      $moan = Moans::find($id);
      $moan->delete();

      // redirect
      Session::flash('success', "Budget et fréquentation du maitre d'ouvrage supprimé avec succès !");
      return Redirect::to('moan');
    }

    private function objectsToArray($objs, $key, $val){
      $arr = array();
      foreach($objs as $obj){
        $arr[$obj->$key] = $obj->$val;
      }
      return $arr;
    }
}