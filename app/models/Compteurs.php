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
        return $this->belongsTo('Contacts', 'FournisseurID', 'CoordonneeID');
      }

      public function getIdAttribute(){
        return $this->attributes['CompteurID'];
      }
      
      public function getEditUrlAttribute()
      {
          return URL::to('tbge/compteur/' .  $this->attributes['CompteurID'] . '/edit');
      }

      public function getDeleteUrlAttribute()
      {
          return URL::to('tbge/compteur/' . $this->attributes['CompteurID'] );
      }

      protected $appends = array('id', 'edit_url', 'delete_url');
    }