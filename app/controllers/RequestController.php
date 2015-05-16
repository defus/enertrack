<?php
class RequestController extends BaseController {
	static $COMMAND_CMD_KEY = "cmd";
	static $COMMAND_LIMIT_KEY = "limit";
	static $COMMAND_OFFSET_KEY = "offset";
	static $COMMAND_SELECTED_KEY = "selected";
	static $COMMAND_SEARCH_LOGIC_KEY = "searchLogic";
	static $COMMAND_SEARCH_KEY = "search";
	static $COMMAND_SORT_KEY = "sort";
	
	//
	static $REQUEST_PARAM_NOT_SET = "request-param-not-set";
	
	//
	static $CONTROLLERS_FOLDER_PATH = "../controllers/";
	static $GRIDS_FOLDER_PATH = "../dataaccess/";
	
	//
	static $AVAILABLE_CONTROLLERS = [ 
			"users",
			"roles",
			"domaines",
			"themes",
			"formations",
			"societes",
			"clients",
			"plannings",
			"participants",
			"consultants",
			"pays",
			"commerciaux",
			"email_templates" 
	];
	
	//
	var $dataClass;
	var $instance;
	var $requestData;
	
	//
	function __construct($controllerType, $requestData) {
		$this->dataClass = static::getGridDataClassNameFromTableName ( $controllerType );
		$this->requestData = $requestData;
	}
	function createInstance() {
		$retVal = new $this->dataClass ();
		// var_dump ( $retVal );
		return $retVal;
	}
	function handleGetRecordsCommand($requestData) {
		if (! isset ( $requestData ))
			$requestData = $this->requestData;
		
		if (! ($this->instance instanceof Grid)) {
			return Grid::buildErrorResult ( "Internal Error: Controller Instance Mismatch. Contacter tapsaid@gmail.com" );
		}
		
		return $this->instance->getRecords ( $requestData );
	}
	function handleGetRecordCommand($requestData) {
		if (! isset ( $requestData ))
			$requestData = $this->requestData;
		
		if (! $this->instance instanceof Grid) {
			return Grid::buildErrorResult ( "Internal Error: Controller Instance Mismatch. Contacter tapsaid@gmail.com" );
		}
		
		$recid = isset ( $requestData ['recid'] ) ? $requestData ['recid'] : 0;
		
		return $this->instance->getFormRecord ( $recid );
	}
	function handleGetFormRecordCommand($requestData) {
		return $this->handleGetRecordCommand ( $requestData );
	}
	function handleInsertRecordsCommand($requestData) {
		if (! isset ( $requestData ))
			$requestData = $this->requestData;
		if (! $this->instance instanceof Grid) {
			return Grid::buildErrorResult ( "Insert Error: Controller Instance Mismatch. Contacter tapsaid@gmail.com" );
		}
		if (! isset ( $requestData ['record'] ))
			return Grid::buildErrorResult ( "Insert Error: No Record to Insert. Contacter tapsaid@gmail.com" );
		return $this->instance->insertRecord ( $requestData ['record'] );
	}
	function handleDeleteRecordsCommand($requestData) {
		if (! isset ( $requestData ))
			$requestData = $this->requestData;
		
		if (! $this->instance instanceof Grid) {
			return Grid::buildErrorResult ( "Delete Error: Controller Instance Mismatch. Contacter tapsaid@gmail.com" );
		}
		
		if (! key_exists ( 'selected', $requestData ) | ! is_array ( $requestData ['selected'] )) {
			return Grid::buildErrorResult ( "Delete Error: Unable to get selection for deletion. Contacter tapsaid@gmail.com" );
		}
		
		return $this->instance->deleteRecords ( $requestData ['selected'] );
	}
	function handleUpdateRecordCommand($requestData) {
		if (! isset ( $requestData ))
			$requestData = $this->requestData;
		
		if (! $this->instance instanceof Grid) {
			return Grid::buildErrorResult ( "Update Error: Controller Instance Mismatch. Contacter tapsaid@gmail.com" );
		}
		
		return $this->instance->updateRecord ( $requestData ['record'] );
	}
	function retrieveOwnRequestParam($key) {
		// var_dump ( $_REQUEST [$key] );
		if (isset ( $this->requestData [$key] ))
			return $this->requestData [$key];
		
		if (isset ( $_REQUEST [$key] ))
			return $_REQUEST [$key];
		
		return Controller::$REQUEST_PARAM_NOT_SET;
	}
	
	//
	function handleRequest($requestData) {
		if (empty ( $requestData ))
			$requestData = $this->requestData;
		
		$cmd = $this->retrieveOwnRequestParam ( static::$COMMAND_CMD_KEY );
		
		// echo "CMD: $cmd";
		
		if ($cmd == Grid::$GET_RECORDS_CMD) {
			return $this->handleGetRecordsCommand ( $requestData );
		}
		
		if ($cmd == Grid::$GET_RECORD_CMD) {
			return $this->handleGetRecordCommand ( $requestData );
		}
		
		if ($cmd == Grid::$GET_FORM_RECORD_CMD) {
			return $this->handleGetFormRecordCommand ( $requestData );
		}
		
		if ($cmd == Grid::$SAVE_RECORD_CMD) {
			if (! empty ( $requestData ['recid'] ) && $requestData ['recid'] > 0)
				return $this->handleUpdateRecordCommand ( $requestData );
			
			return $this->handleInsertRecordsCommand ( $requestData );
		}
		
		if ($cmd == Grid::$DELETE_RECORDS_CMD) {
			return $this->handleDeleteRecordsCommand ( $requestData );
		}
		
		return Grid::buildErrorResult ( "Internal Error! Unknown Command Sent: ." . json_encode ( $requestData ) . " Contacter tapsaid@gmail.com" );
	}
	//
	static function getGridDataClassNameFromTableName($tableName) {
		
		$firstChar = substr ( $tableName, 0, 1 );
		$firstChar = strtoupper ( $firstChar );
		$remainingPart = substr ( $tableName, 1 );
		
		$retVal = "";
		$retVal .= $firstChar;
		$retVal .= $remainingPart;
		$retVal .= "Grid";
		
		return $retVal;
	}
	static function retrieveRequestParam($key) {
		$retVal = Controller::$REQUEST_PARAM_NOT_SET;
		
		if (isset ( $_REQUEST [$key] ))
			$retVal = $_REQUEST [$key];
			
			// echo $retVal;
		
		return $retVal;
	}
	static function encodeReturnDataToJSON($array) {
		$retVal = json_encode ( ( object ) $array );
		// var_dump ( $retVal );
		return $retVal;
	}
}