<?php

class eauController extends BaseController {
    static $eau = <<<EOD
    
    
    
EOD;
    
    public function eauPage() {
        return \View::make('eau', []);
    }
    
    public function eauData() {
        return null;
    }
    
   
    
    

}