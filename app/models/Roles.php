<?php
    class Roles extends Eloquent
    {
      protected $table = 'roles';

      protected $primaryKey = null;

      public $incrementing = false;

      public $timestamps = false;
      
      public function Mo()
      {
        return $this->belongsTo('Mos', 'record_id', 'MouvrageID');
      }
    }