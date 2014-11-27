<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::group(array('prefix','/'), function() {

  Route::match(array('GET','POST'),'/login','UserController@login');

  Route::get('logout','UserController@logout');

  // Secure-Routes
  Route::group(array('before' => array('auth', 'permission')), function()
  {
      Route::get('', 'DashboardController@showDashboard');

      Route::resource('mo', 'MoController');
      Route::get('mo/download/{image}', 'MoController@download');

      Route::resource('moan', 'MoanController');

      Route::resource('contact', 'ContactController');

      Route::get('patrimoine', 'PatrimoineController@index');

      Route::resource('patrimoine/batiment', 'BatimentController');

      Route::resource('patrimoine/eclairage', 'EclairageController');

      Route::resource('patrimoine/vehicule', 'VehiculeController');

      Route::resource('patrimoine/posteproduction', 'PosteproductionController');

      Route::resource('patrimoine/autreposte', 'AutreposteController');

      Route::resource('compteur', 'CompteurController');

      Route::resource('facture', 'FactureController');

      //TBGE
      Route::get('tbge/patrimoine', 'PatrimoineTbgeController@index');

      Route::resource('tbge/patrimoine/batiment', 'BatimentTbgeController');

      Route::resource('tbge/patrimoine/espacevert', 'EspacevertTbgeController');

      Route::resource('tbge/patrimoine/eclairage', 'EclairageTbgeController');

      Route::resource('tbge/patrimoine/vehicule', 'VehiculeTbgeController');

      Route::resource('tbge/patrimoine/posteproduction', 'PosteproductionTbgeController');

      Route::resource('tbge/compteur', 'CompteurTbgeController');

      Route::resource('tbge/facture', 'FactureTbgeController');

  });

});
