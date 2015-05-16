<?php
    class Contacts extends Eloquent
    {
      protected $table = 'coordonnee';

      protected $primaryKey = 'CoordonneeID';

      public $timestamps = false;
      
      public function Mo()
      {
        return $this->belongsTo('Mos', 'MouvrageID');
      }
    }