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
{{ HTML::script('assets/js/viewmodels/r1ViewModel.js') }}
<script>
$(document).ready(function() {
    var vm = new r1ViewModel();
    ko.applyBindings(vm);
    vm.startLoadingData("/reports/r1/data");
    vm.startLoadingData("/reports/r1/dataPatrimoines",true);
    vm.startLoadingData("/reports/r1/dataYear",true);
    //console.log('Done Document',ko.toJSON(vm));
});
</script>
@stop {{-- Page content --}} @section('content')

<div id="page-wrapper">

	<H1 class="page-header text-center">Les Consommations Annuelles et
		Trimestrielles par Patrimoine</H1>
	<div class="row" role="tabpanel">
		<ul class="nav nav-tabs nav-justified">
			<li class="active" role="presentation"><a data-toggle="tab"
				href="#trimestrielles">Globales Trimestrielles</a></li>
			<li role="presentation"><a data-toggle="tab" href="#annuelles">Globales
					Annuelles</a></li>
			<li role="presentation"><a data-toggle="tab" href="#par_patrimoine">D&eacute;tails
					Patrimoines</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade in active" id="trimestrielles"
			role="tabpanel">
			<br>
			<div class="panel-group" id="accordion1" role="tablist"
				data-bind="foreach:$root.availableYears" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab"
						data-bind="attr:{id:'heading_year_'+$data}"">
						<h4 class="panel-title text-center">
							<a data-toggle="collapse" data-parent="#accordion1"
								data-bind="click:function(){$root.drawYear(1*$data);},attr:{href:'#collapse_year_'+$data,'aria-controls':'collapse_year_'+$data}"
								aria-expanded="false"> Consommations Trimestrielles par
								Patrimoine: Ann&eacute;e <span data-bind="text:$data"></span>
							</a>
						</h4>
					</div>
					<div class="panel-collapse collapse row"
						data-bind="attr:{id:'collapse_year_'+$data,'aria-labelledby':'heading_year_'+$data}"
						role="tabpanel">
						<div class="panel-body col-md-12">
							<div class="row">
								<div class="col-xs-12 col-md-10  text-center"
									data-bind="attr:{id:$root.buildTrimestreGraphId($data,1)}"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-xs-12 col-md-10  text-center"
									data-bind="attr:{id:$root.buildTrimestreGraphId($data,2)}"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-xs-12 col-md-10  text-center"
									data-bind="attr:{id:$root.buildTrimestreGraphId($data,3)}"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-xs-12 col-md-10 text-center"
									data-bind="attr:{id:$root.buildTrimestreGraphId($data,4)}"></div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="tab-pane fade" id="annuelles" role="tabpanel">
			<br>
			<div class="panel-group" id="accordion2" role="tablist"
				data-bind="foreach:$root.availableJustYears"
				aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab"
						data-bind="attr:{id:'heading_just_year_'+$data}">
						<h4 class="panel-title text-center">
							<a data-toggle="collapse" data-parent="#accordion2"
								data-bind="click:function(){$root.drawYear(1*$data,true);},attr:{href:'#collapse_just_year_'+$data,'aria-controls':'collapse_just_year_'+$data}"
								aria-expanded="false"> Consommations Annuelles par Patrimoine:
								Ann&eacute;e <span data-bind="text:$data"></span>
							</a>
						</h4>
					</div>
					<div class="panel-collapse collapse row"
						data-bind="attr:{id:'collapse_just_year_'+$data,'aria-labelledby':'heading_just_year_'+$data}"
						role="tabpanel">
						<div class="panel-body col-md-12">
							<div class="row">
								<div class="col-xs-12 col-md-10  text-center"
									data-bind="attr:{id:'just_year_'+$data}"></div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="tab-pane fade" id="par_patrimoine" role="tabpanel">
			<br>
			<div class="panel-group" id="accordion3" role="tablist"
				data-bind="foreach:$root.availableJustYears"
				aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab"
						data-bind="attr:{id:'heading_patrimoines_year_'+$data}">
						<h4 class="panel-title text-center">
							<a data-toggle="collapse" data-parent="#accordion3"
								data-bind="attr:{href:'#collapse_patrimoines_year_'+$data,'aria-controls':'collapse_patrimoines_year_'+$data}"
								aria-expanded="false"> Consommations de <span
								data-bind="text:$data"></span> Pour Chaque Patrimoine
							</a>
						</h4>
					</div>
					<div class="panel-collapse collapse row"
						data-bind="attr:{id:'collapse_patrimoines_year_'+$data,'aria-labelledby':'heading_patrimoines_year_'+$data}"
						role="tabpanel">
						<div class="panel-body col-md-12">
							<div class="col-xs-12 col-md-12  text-center"
								data-bind="attr:{id:'patrimoines_'+$data}">

								<div class="row">
									<ul class="nav nav-tabs nav-justified">
										<li class="active" role="presentation"><a data-toggle="tab"
											data-bind="click:function(){$root.drawYearPatrimoine(1*$data,'e');},attr:{href:'#e_'+$data}">&Eacute;clairages</a></li>
										<li role="presentation"><a data-toggle="tab"
											data-bind="click:function(){$root.drawYearPatrimoine(1*$data,'b');},attr:{href:'#b_'+$data}">B&acirc;timents</a></li>
										<li role="presentation"><a data-toggle="tab"
											data-bind="click:function(){$root.drawYearPatrimoine(1*$data,'v');},attr:{href:'#v_'+$data}">V&eacute;hicules</a></li>
										<li role="presentation"><a data-toggle="tab"
											data-bind="click:function(){$root.drawYearPatrimoine(1*$data,'ev');},attr:{href:'#ev_'+$data}">Espaces
												Verts</a></li>
										<li role="presentation"><a data-toggle="tab"
											data-bind="click:function(){$root.drawYearPatrimoine(1*$data,'ae');},attr:{href:'#ae_'+$data}">Arriv&eacute;es
												d'eau</a></li>
										<li role="presentation"><a data-toggle="tab"
											data-bind="click:function(){$root.drawYearPatrimoine(1*$data,'pp');},attr:{href:'#pp_'+$data}">Postes
												Production</a></li>
										<li role="presentation"><a data-toggle="tab"
											data-bind="click:function(){$root.drawYearPatrimoine(1*$data,'ap');},attr:{href:'#ap_'+$data}">Autres
												Postes</a></li>
										<li class="active" role="presentation"><a data-toggle="tab"
											data-bind="click:function(){$root.drawYearPatrimoine(1*$data,'unknown');},attr:{href:'#unknown_'+$data}">Non
												Cat&eacute;goris&eacute;s</a></li>

									</ul>

									<div class="tab-content">
										<div class="tab-pane fade in active"
											data-bind="attr:{id:'e_'+$data}" role="tabpanel">
											<br> Contenu Graph <span
												data-bind="text:'Eclairages : ' +$data"></span>
										</div>

										<div class="tab-pane fade in" data-bind="attr:{id:'b_'+$data}"
											role="tabpanel">
											<br> Contenu Graph <span
												data-bind="text:'Batiments : ' +$data"></span>
										</div>

										<div class="tab-pane fade in" data-bind="attr:{id:'v_'+$data}"
											role="tabpanel">
											<br> Contenu Graph <span
												data-bind="text:'Vehicules : ' +$data"></span>
										</div>

										<div class="tab-pane fade in"
											data-bind="attr:{id:'ev_'+$data}" role="tabpanel">
											<br> Contenu Graph <span
												data-bind="text:'Espaces Verts : ' +$data"></span>
										</div>

										<div class="tab-pane fade in"
											data-bind="attr:{id:'ae_'+$data}" role="tabpanel">
											<br> Contenu Graph <span
												data-bind="text:'Points d\'Eaux : ' +$data"></span>
										</div>

										<div class="tab-pane fade in"
											data-bind="attr:{id:'pp_'+$data}" role="tabpanel">
											<br> Contenu Graph <span
												data-bind="text:'Postes de Production : ' +$data"></span>
										</div>

										<div class="tab-pane fade in"
											data-bind="attr:{id:'ap_'+$data}" role="tabpanel">
											<br> Contenu Graph <span
												data-bind="text:'Autres Postes : ' +$data"></span>
										</div>

										<div class="tab-pane fade in"
											data-bind="attr:{id:'unknown_'+$data}" role="tabpanel">
											<br> Contenu Graph <span
												data-bind="text:'Non categorises : ' +$data"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>


</div>
<!-- /#page-wrapper -->

@stop
