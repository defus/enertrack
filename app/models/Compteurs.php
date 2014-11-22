<?php
    class Compteurs extends Eloquent
    {
      protected $table = 'compteur';

      protected $primaryKey = 'CompteurID';

      public $timestamps = false;
      
      public function Mo()
      {
        return $this->belongsTo('Mos', 'MouvrageID');
      }

      public function Energie()
      {
        return $this->belongsTo('Energies', 'EnergieID');
      }

      public function Fournisseur()
      {
        return $this->belongsTo('Contacts', 'CoordonneeID');
      }
    }