<?php
    class Moans extends Eloquent
    {
      protected $table = 'moan';

      protected $primaryKey = 'MoanID';

      public $timestamps = false;
      
      public function Mo()
      {
        return $this->belongsTo('Mos', 'MouvrageID');
      }
    }