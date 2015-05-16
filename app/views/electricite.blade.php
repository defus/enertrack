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
{{ HTML::style('assets/css/w2ui.css') }}
@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')
{{ HTML::script('assets/js/w2ui.js') }}
{{ HTML::script('assets/js/bootstrap.min.js') }}
{{ HTML::script('assets/js/knockout-3.1.0.js') }}
{{ HTML::script('assets/js/hc.js') }}
{{ HTML::script('assets/js/viewmodels/electriciteViewModel.js') }}

<script>
$(document).ready(function() {
    var vm = new electriciteViewModel();
    ko.applyBindings(vm);
                  
    vm.start();
});

</script>
@stop {{-- Page content --}} @section('content')

<div id="page-wrapper">

<H1 class="page-header text-center">Rapports des Consommations &Eacute;lectriques</H1>


</div>
<!-- /#page-wrapper -->

@stop
