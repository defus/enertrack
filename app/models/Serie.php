<?php
    class Serie extends Eloquent
    {
      function __construct($name1,  $pointStart1, $pointInterval1, $type1, $yAxis1) {
          $this->setAttribute('name', $name1);
          $this->setAttribute('pointStart', $pointStart1);
          $this->setAttribute('pointInterval', $pointInterval1);
          $this->setAttribute('type', $type1);
          $this->setAttribute('yAxis', $yAxis1);
      } 
    }