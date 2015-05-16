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
{{ HTML::script('assets/js/viewmodels/factureReleveViewModel.js') }}
{{ HTML::script('http://canvg.googlecode.com/svn/trunk/rgbcolor.js') }}
{{ HTML::script('http://canvg.googlecode.com/svn/trunk/canvg.js') }}
<script>
$(document).ready(function() {
    var vm = new factureReleveViewModel();
    ko.applyBindings(vm);
    vm.start();
                  
                  var canvas = document.createElement('canvas');
                  
                  var svg  = document.getElementById('container'),
                  
                  svg = svg.getElementsByTagName('svg')[0];
                  
                  svgData  = new XMLSerializer().serializeToString(svg);
                  
                  svgData = btoa(unescape(encodeURIComponent(svgData)));
                  
                  console.log(svg);
                  
                  canvas.width = 1129;
                  canvas.height = 400;
                  
                  var ctx = canvas.getContext('2d');
                  
                  var img = document.createElement('img');
                  
                  canvg(canvas, svgData);
                  
                  img.setAttribute('src', 'data:image/svg+xml;base64,' + (svgData));
                  
                  
                  img.onload = function() {
                  console.log(canvas);
                        //ctx.drawImage(img, 0, 0);
                        //window.open(canvas.toDataURL('image/png'));
                  
                  var img	= canvas.toDataURL("image/png") ;
                  document.getElementById('editor').appendChild('<img src="'+img+'"/>');
                  
                  };
});
                  
</script>
@stop {{-- Page content --}} @section('content')

<div id="page-wrapper">

    <H1 class="page-header text-center">Les Factures et Les relev&eacute;s</sub><H1>

<div id="container"></div>

<div id="editor"></div>
<canvas id="canvas"></canvas>
</div>
<!-- /#page-wrapper -->

@stop
