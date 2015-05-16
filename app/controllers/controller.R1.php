<?php
include_once '../dataaccess/class.R1Grid.php';
include_once '../controllers/class.Controller.php';
class R1Controller extends RequestController {
	function R1Controller($request) {
		parent::__construct ( 'r1', $request );
		$this->instance = parent::createInstance ();
	}
	//
	function handleRequest() {
		$retVal = parent::handleRequest ( $_REQUEST );
		return $retVal;
	}
}

$cmd = R1Controller::retrieveRequestParam ( R1Controller::$COMMAND_CMD_KEY );

if (R1Controller::$REQUEST_PARAM_NOT_SET == $cmd) {
	echo R1Controller::encodeReturnDataToJSON ( Grid::buildErrorResult ( Grid::$DEFAULT_REQUEST_PARAMS_ERROR . " Missing param: 'cmd'" ) );
	exit ();
}

if ('get-records' != $cmd) {
	echo R1Controller::encodeReturnDataToJSON ( Grid::buildErrorResult ( Grid::$DEFAULT_REQUEST_PARAMS_ERROR . "Commande NON Supportée!!" ) );
	exit ();
}

$controller = new R1Controller ( $_REQUEST );

$retVal = $controller->handleRequest ( $controller->requestData );

echo Controller::encodeReturnDataToJSON ( $retVal );
