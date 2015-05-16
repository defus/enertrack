<?php

/*
 * |-------------------------------------------------------------------------- | Application Routes |-------------------------------------------------------------------------- | | Here is where you can register all of the routes for an application. | It's a breeze. Simply tell Laravel the URIs it should respond to | and give it the Closure to execute when that URI is requested. |
 */
Route::group ( array (
		'prefix',
		'/' 
), function () {
	
	Route::match ( array (
			'GET',
			'POST' 
	), '/login', 'UserController@login' );
	
	Route::get ( 'logout', 'UserController@logout' );
	
	// Secure-Routes
	Route::group ( array (
			'before' => array (
					'auth' 
			) 
	), function () {
		Route::get ( '', 'DashboardController@showDashboard2' );
		Route::get ( 'api/graph', 'DashboardController@graph' );
		
		Route::get ( 'patrimoine', 'PatrimoineController@index' );
		
		Route::resource ( 'patrimoine/batiment', 'BatimentController' );
		
		Route::resource ( 'patrimoine/eclairage', 'EclairageController' );
		
		Route::resource ( 'patrimoine/vehicule', 'VehiculeController' );
		
		Route::resource ( 'patrimoine/posteproduction', 'PosteproductionController' );
		
		Route::resource ( 'patrimoine/autreposte', 'AutreposteController' );
		
		Route::resource ( 'compteur', 'CompteurController' );
		
		Route::resource ( 'facture', 'FactureController' );
		
		// TBGE
		Route::get ( 'tbge/patrimoine', 'PatrimoineTbgeController@index' );
		
		Route::resource ( 'tbge/patrimoine/batiment', 'BatimentTbgeController' );
		Route::get ( 'tbge/patrimoine/batiment/import/csv', 'BatimentTbgeController@importCsv' );
		Route::post ( 'tbge/patrimoine/batiment/import/csv/post', 'BatimentTbgeController@importCsvPosted' );
		Route::post ( 'tbge/patrimoine/batiment/import/csv/doimport', 'BatimentTbgeController@doImport' );
		
		Route::resource ( 'tbge/patrimoine/espacevert', 'EspacevertTbgeController' );
		Route::get ( 'tbge/patrimoine/espacevert/import/csv', 'EspacevertTbgeController@importCsv' );
		Route::post ( 'tbge/patrimoine/espacevert/import/csv/post', 'EspacevertTbgeController@importCsvPosted' );
		Route::post ( 'tbge/patrimoine/espacevert/import/csv/doimport', 'EspacevertTbgeController@doImport' );
		
		Route::resource ( 'tbge/patrimoine/arriveeau', 'ArriveeauTbgeController' );
		Route::get ( 'tbge/patrimoine/arriveeau/import/csv', 'ArriveeauTbgeController@importCsv' );
		Route::post ( 'tbge/patrimoine/arriveeau/import/csv/post', 'ArriveeauTbgeController@importCsvPosted' );
		Route::post ( 'tbge/patrimoine/arriveeau/import/csv/doimport', 'ArriveeauTbgeController@doImport' );
		
		Route::resource ( 'tbge/patrimoine/eclairage', 'EclairageTbgeController' );
		Route::get ( 'tbge/patrimoine/eclairage/import/csv', 'EclairageTbgeController@importCsv' );
		Route::post ( 'tbge/patrimoine/eclairage/import/csv/post', 'EclairageTbgeController@importCsvPosted' );
		Route::post ( 'tbge/patrimoine/eclairage/import/csv/doimport', 'EclairageTbgeController@doImport' );
		
		Route::resource ( 'tbge/patrimoine/vehicule', 'VehiculeTbgeController' );
		Route::get ( 'tbge/patrimoine/vehicule/import/csv', 'VehiculeTbgeController@importCsv' );
		Route::post ( 'tbge/patrimoine/vehicule/import/csv/post', 'VehiculeTbgeController@importCsvPosted' );
		Route::post ( 'tbge/patrimoine/vehicule/import/csv/doimport', 'VehiculeTbgeController@doImport' );
		
		Route::resource ( 'tbge/patrimoine/posteproduction', 'PosteproductionTbgeController' );
		
		Route::resource ( 'tbge/compteur', 'CompteurTbgeController' );
		Route::get ( 'tbge/compteur/datatable/ajax', 'CompteurTbgeController@datatable' );
		Route::get ( 'tbge/compteur/select2/ajax', 'CompteurTbgeController@select2' );
		Route::get ( 'tbge/compteur/import/csv', 'CompteurTbgeController@importCsv' );
		Route::post ( 'tbge/compteur/import/csv/post', 'CompteurTbgeController@importCsvPosted' );
		Route::post ( 'tbge/compteur/import/csv/doimport', 'CompteurTbgeController@doImport' );
		
		Route::resource ( 'tbge/facture', 'FactureTbgeController' );
		Route::get ( 'tbge/facture/datatable/ajax', 'FactureTbgeController@datatable' );
		Route::get ( 'tbge/facture/import/csv', 'FactureTbgeController@importCsv' );
		Route::post ( 'tbge/facture/import/csv/post', 'FactureTbgeController@importCsvPosted' );
		Route::post ( 'tbge/facture/import/csv/doimport', 'FactureTbgeController@doImport' );
		
		Route::get ( 'tbge/indicateur/electricite/global', 'IndicateurTbgeController@electriciteGlobal' );
		
		// Reports Generation
		
		Route::get ( 'reports/r1/page', 'R1Controller@r1Page' );
		Route::post ( 'reports/r1/data', 'R1Controller@r1Data' );
		Route::post ( 'reports/r1/dataYear', 'R1Controller@r1DataYearly' );
		
		Route::get ( 'reports/facture_releve/page', 'factureReleveController@factureRelevePage' );
		Route::post ( 'reports/facture_releve/data', 'factureReleveController@factureReleveData' );
		
		Route::get ( 'reports/co2/page', 'co2Controller@co2Page' );
		Route::post ( 'reports/co2/data', 'co2Controller@co2Data' );
		
		Route::get ( 'reports/electricite/page', 'electriciteController@electricitePage' );
		Route::post ( 'reports/electricite/data', 'electriciteController@electriciteData' );
		
		Route::get ( 'reports/eau/page', 'eauController@eauPage' );
		Route::post ( 'reports/eau/data', 'eauController@eauData' );
		
		Route::get ( 'reports/carburant/page', 'carburantController@carburantPage' );
		Route::post ( 'reports/carburant/data', 'ecarburantController@carburantData' );
		
		// Next
		Route::resource ( 'mo', 'MoController' );
		
		Route::get ( 'mo/download/{image}', 'MoController@download' );
		
		Route::resource ( 'moan', 'MoanController' );
		
		Route::resource ( 'contact', 'ContactController' );
		
		// Admin
		Route::resource ( 'admin/user', 'UserController' );
		
		Route::resource ( 'admin/role', 'RoleController' );
	} );
} );
