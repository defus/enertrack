<?php
/**
 * login.blade.php 
 * {File description}
 * 
 * @author defus
 * @created Nov 13, 2014
 * 
 */
?>
{{-- Page template --}}
@extends('templates.normal')

{{-- Page title --}}
@section('title') Tableau de bord @stop

{{-- Page specific CSS files --}}
{{-- {{ HTML::style('--Path to css--') }} --}}
@section('css')
{{ HTML::style('assets/daterangepicker/daterangepicker-bs3.css') }}
@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')
{{ HTML::script('assets/daterangepicker/moment.js') }}
{{ HTML::script('assets/daterangepicker/daterangepicker.js') }}
{{ HTML::script('assets/Highstock-2.0.4/js/highstock.js') }}
{{ HTML::script('assets/Highstock-2.0.4/js/modules/exporting.js') }}
{{ HTML::script('assets/js/highcharts.js?_' . time()) }}
<script>
$(document).ready(function() {
    var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
        }

    var optionSet1 = {
      startDate: moment().subtract(1, 'year'),
      endDate: moment(),
      //minDate: '01/01/2012',
      //maxDate: '12/31/2014',
      //dateLimit: { days: 60 },
      showDropdowns: true,
      showWeekNumbers: true,
      timePicker: false,
      timePickerIncrement: 1,
      timePicker12Hour: true,
      ranges: {
         'Ce mois': [moment().startOf('month'), moment().endOf('month')],
         'Le mois derniers': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
         'Ce trimestre': [moment().subtract(3, 'month').startOf('month'), moment().endOf('month')],
         'Le trimestre dernier': [moment().subtract(6, 'month').startOf('month'), moment().subtract(3, 'month').endOf('month')],
         "Cette année": [moment().subtract(1, 'year').startOf('month'), moment().endOf('month')],
         "L'année dernière": [moment().subtract(2, 'year').startOf('month'), moment().subtract(1, 'year').endOf('month')]
      },
      opens: 'left',
      buttonClasses: ['btn btn-default'],
      applyClass: 'btn-small btn-success',
      cancelClass: 'btn-small',
      format: 'DD/MM/YYYY',
      separator: ' à ',
      locale: {
          applyLabel: 'Ok',
          cancelLabel: 'Annuler',
          fromLabel: 'De',
          toLabel: 'A',
          customRangeLabel: 'Personnaliser',
          daysOfWeek: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve','Sa'],
          monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
          firstDay: 1
      }
    };
    $('#reportrange span').html(moment().subtract(1, 'year').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    $('#reportrange').daterangepicker(optionSet1, cb);
    $('#reportrange').on('show.daterangepicker', function() { console.log("show event fired"); });
    $('#reportrange').on('hide.daterangepicker', function() { console.log("hide event fired"); });
    $('#reportrange').on('apply.daterangepicker', function(ev, picker) { 
        var start = picker.startDate.format('YYYY-MM-DD');
        var end = picker.endDate.format('YYYY-MM-DD');
        getGraph("containerConsoElect", ['elect.sum', 'elect.eclairage.sum', 'elect.batiment.sum'], start, end, "Variation de la consommation d'électricité", null, "KWh");
        getGraph('containerConsoEau', ['eau.sum', 'eau.arriveeau.sum', 'eau.batiment.sum'], start, end, "Variation de la consommation d'eau", null, "m3");
        getGraph('containerConsoCarburant', ['carburant.sum'], null, null, "Variation de la consommation de carburant", null, "litre");

    });
    $('#reportrange').on('cancel.daterangepicker', function(ev, picker) { console.log("cancel event fired"); });

    var loading = $('.loading').hide().clone();
    var nodata = $('.nodata').hide().clone();

    getGraph('containerConsoElect', ['elect.sum', 'elect.eclairage.sum', 'elect.batiment.sum'], null, null, "Variation de la consommation d'électricité", null, "KWh");

    getGraph('containerConsoEau', ['eau.sum', 'eau.arriveeau.sum', 'eau.batiment.sum'], null, null, "Variation de la consommation d'eau", null, "m3");

    getGraph('containerConsoCarburant', ['carburant.sum'], null, null, "Variation de la consommation de carburant", null, "litre");


});
</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tableau de bord</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="message loading">
                <div class="progress"><div class="progress-bar progress-bar-striped active" style="width: 100%;"></div></div>
                Votre rapport est en cours de génération. Cela prendra quelques minutes ...
            </div>
            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; margin: 10px 10px; border: 1px solid #ccc">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span></span> <b class="caret"></b>
            </div>
            <div class="message nodata">Il n'y a aucune donnée à afficher pour l'intervalle de temps sélectionné !</div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="containerConsoElect" style="min-width:310px; height: 400px; margin: 0 auto"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="containerConsoEau" style="min-width:310px; height: 400px; margin: 0 auto"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="containerConsoCarburant" style="min-width:310px; height: 400px; margin: 0 auto"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->

@stop