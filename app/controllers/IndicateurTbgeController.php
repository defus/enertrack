<?php

class IndicateurTbgeController extends \BaseController {

    public function electriciteGlobal()
    {
      $contents = View::make('tbge.indicateur.electricite.global');
      $response = Response::make($contents, '200');
      $response->header('Content-Type', 'application/json');
      return $response;
    }
}