<?php
    class Factures extends Eloquent
    {
      protected $table = 'facture';

      protected $primaryKey = 'FactureID';

      public $timestamps = false;
      
      public function __construct() {
        parent::__construct();

        //Set the format used by Carbon when converting date to string
        \Carbon\Carbon::setToStringFormat('d-m-Y');
        //all dates like 2014-03-25 17:37:54 look like 25-03-2014 17:37:54 now
      }

      public function Mo()
      {
        return $this->belongsTo('Mos', 'MouvrageID');
      }

      public function Compteur()
      {
        return $this->belongsTo('Compteurs', 'CompteurID');
      }

      public function Fournisseur()
      {
        return $this->belongsTo('Contacts', 'FournisseurID', 'CoordonneeID');
      }
    }