<?php
class MetricElectSum implements IMetric{

  public function getHeader(){
    return new Serie("Total (KWh)", 0, 24*3600*1000, 'column', 0);
  }

  public function getValue($start, $end){
    
    $conso = DB::select("select SUM(Consommation) Consommation 
          from facture
            INNER JOIN compteur on compteur.CompteurID = facture.CompteurID 
            INNER JOIN energie on energie.EnergieID=compteur.EnergieID 
          WHERE energie.Nom like 'Electricité'
            AND Finperiode < '$end'
            AND Finperiode >= '$start'")[0]->Consommation;

    return array( $start, isset($conso) ? $conso : 0);
  }

}