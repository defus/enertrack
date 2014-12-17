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
{{ HTML::style('http://www.highcharts.com/media/com_demo/highslide.css') }}
@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')
{{ HTML::script('assets/Highcharts-4.0.4/js/highcharts.js') }}
{{ HTML::script('assets/Highcharts-4.0.4/js/modules/data.js') }}
{{ HTML::script('assets/Highcharts-4.0.4/js/modules/exporting.js') }}
{{ HTML::script('http://www.highcharts.com/media/com_demo/highslide-full.min.js') }}
{{ HTML::script('http://www.highcharts.com/media/com_demo/highslide.config.js') }}
 {{ HTML::script('assets/js/highcharts.js') }}
<script>


</script
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tableau de bord : Consommation d'électricité</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Varitation de la Consommation globale
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div id="container" style="min-width:310px; height: 400px; margin: 0 auto"></div>

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