<?php

class carburantController extends BaseController {
    static $carburant = <<<EOD
    
    
    
EOD;
    
    public function carburantPage() {
        return \View::make('carburant', []);
    }
    
    public function carburantData() {
        return null;
    }
    
   
    
    

}