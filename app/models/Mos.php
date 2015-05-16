<?php
    class Mos extends Eloquent
    {
      protected $table = 'mouvrage';

      protected $primaryKey = 'MouvrageID';

      public $timestamps = false;
      
      public function Categorie()
      {
        return $this->belongsTo('Categories', 'CategorieID');
      }
    }