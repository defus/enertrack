<?php
    class MetricFactory
    {
      public static function create($metric){
        switch ($metric) {
          case 'elect.sum':
            $metricInstance = new MetricElectSum();
            break;
          case 'elect.eclairage.sum':
            $metricInstance = new MetricElectEclairageSum();
            break;
          case 'elect.batiment.sum':
            $metricInstance = new MetricElectBatimentSum();
            break;
          case 'eau.sum':
            $metricInstance = new MetricEauSum();
            break;
          case 'eau.arriveeau.sum':
            $metricInstance = new MetricEauArriveeauSum();
            break;
          case 'eau.batiment.sum':
            $metricInstance = new MetricEauBatimentSum();
            break;
          case 'carburant.sum':
            $metricInstance = new MetricCarburantSum();
            break;
          default:
            throw new Exception("Invalide metric name : " . $metric, 1);
            break;
        }
        return $metricInstance;
      }
    }