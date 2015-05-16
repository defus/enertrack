<?php

class electriciteController extends BaseController {
    static $electricite = <<<EOD
    
    
    
EOD;
    
    public function electricitePage() {
        return \View::make('electricite', []);
    }
    
    public function electriciteData() {
        return null;
    }
    
   
    
    

}