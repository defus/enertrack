<?php
interface IMetric{

  public function getHeader();

  public function getValue($start, $end);
  
}