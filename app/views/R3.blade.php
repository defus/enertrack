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
{{ HTML::script('assets/js/jspdf.min.js') }}
{{ HTML::script('assets/js/jspdf.plugin.from_html.js') }}
{{ HTML::script('assets/js/jspdf.plugin.split_text_to_size.js') }}
{{ HTML::script('assets/js/jspdf.plugin.standard_fonts_metrics.js') }}
{{ HTML::script('assets/js/viewmodels/r2ViewModel.js') }}
{{ HTML::script('http://canvg.googlecode.com/svn/trunk/rgbcolor.js') }}
{{ HTML::script('http://canvg.googlecode.com/svn/trunk/canvg.js') }}

<script>
$(document).ready(function() {
    var vm = new r2ViewModel();
    ko.applyBindings(vm);
    //vm.startLoadingData("/reports/r2/data");
    //vm.startLoadingData("/reports/r1/dataYear",true);
    //console.log('Done Document',ko.toJSON(vm));
                  
    vm.start();
                  
                  var doc = new jsPDF();
                  var specialElementHandlers = {
                  '#editor': function (element, renderer) {
                  return true;
                  }
                  };
                  
                  $('#cmd').click(function () {
                                  
                                  var svg  = document.getElementById('container'),
                                  
                                  svg = svg.getElementsByTagName('svg')[0];
                                  
                                  xml  = new XMLSerializer().serializeToString(svg);
                                  
                                  xml = btoa(unescape(encodeURIComponent(xml)));
                                  
                                  //console.log(xml);
                                  
                                  var data = "data:image/svg+xml;base64," + (xml),
                                  img  = new Image();
                                  
                                  img.setAttribute('src', data);
                                  //document.getElementById('editor').appendChild(img);
                                  
                                  /*doc.fromHTML($('#content').html(), 15, 15, {
                                   'width': 170,
                                   'elementHandlers': specialElementHandlers
                                   });
                                   doc.save('sample-file.pdf');*/
                                  
                                  var canvas = document.getElementById("editor");
                                  
                                  canvg(canvas, xml);
                                  var img	= canvas.toDataURL("image/jpeg", 1.0) ;
                                  document.getElementById('editor').appendChild('<img src="'+img+'"/>');
                                  
                                  var doc = new jsPDF();
                                  
                                  doc.setFontSize(40);
                                  doc.text(35, 25, "Paranyan loves jsPDF");
                                 // doc.addImage(data, 'base64', 15, 40, 180, 160);
                                  //doc.save("Report.pdf");
                                  });

});
</script>
@stop {{-- Page content --}} @section('content')

<div id="page-wrapper">

<H1 class="page-header text-center">Test Génération PDF Hight Chart</H1>
<div id="content">
    <h3>Titre du Rapport PDF</h3>
    <div id="container"></div>
</div>


<button id="cmd">generer le PDF</button>

</div>
<!-- /#page-wrapper -->

@stop
