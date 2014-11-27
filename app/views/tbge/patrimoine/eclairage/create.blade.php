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
@section('title') Créer un poste d'éclairage @stop

{{-- Page specific CSS files --}}
{{-- {{ HTML::style('--Path to css--') }} --}}
@section('css')
{{ HTML::style('assets/select2-3.5.2/select2.css') }}
{{ HTML::style('assets/select2-3.5.2/select2-bootstrap.css') }}
@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')
{{ HTML::script('assets/select2-3.5.2/select2.min.js') }}
{{ HTML::script('assets/select2-3.5.2/select2_locale_fr.js') }}
<script>
$(document).ready(function() {
    $('#compteurElectricitesSelect2').select2({
        allowClear: true,
        placeholder: "Sélectionner un compteur",
        closeOnSelect : false
    });
});
</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Créer un poste d'éclairage </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     Merci de remplir le formulaire ci-dessous
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if ( $errors->count() > 0 )
                                @foreach( $errors->all() as $message )
                                    <div class="alert alert-warning">
                                        {{$message}}
                                    </div>
                                @endforeach
                            @endif
                            {{ Form::open(array('url' => URL::to('tbge/patrimoine/eclairage') , 'role' => 'form')) }}
                                <div class="form-group @if($errors->first('Nom') != '') has-error @endif">
                                    <label>Secteur d'éclairage *</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Nom', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Armoire/ compteur associé</label>
                                    <select id="compteurElectricitesSelect2" name="compteurElectricitesID[]" class="form-control" multiple>
                                        @if(count($compteurElectricites) > 0)
                                            @foreach($compteurElectricites as $key => $value)
                                            <optgroup label="{{$value->Energie}}">
                                                <option value="{{$value->CompteurID}}">{{$value->Nom . ' | ' . $value->Reference}}</option>
                                            </optgroup>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nombre de points lumineux</label>
                                    {{ Form::number('Nbrpointlumineux', Input::old('Nbrpointlumineux'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Catégorie</label>
                                    {{ Form::select('CategorieID', $categories, Input::old('CategorieID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Puissance  consommée (en kWh) et luminosité</label>
                                    {{ Form::number('Puissance', Input::old('Puissance'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nombre d’heures de fonctionnement par an</label>
                                    {{ Form::number('NbrHeuresans', Input::old('NbrHeuresans'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Type de technologie utilisée</label>
                                    {{ Form::select('TypeTechnologie', $typeTechnologies, Input::old('TypeTechnologie'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Marque de lampes</label>
                                    {{ Form::text('MarqueLampe', Input::old('MarqueLampe'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nombre de jours d'interruption de service par trimestre, par point lumineux</label>
                                    {{ Form::number('NbrJourInterrupServ', Input::old('NbrJourInterrupServ'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nombre de jours d'interventions de maintenance par trimestre, par point lumineux </label>
                                    {{ Form::number('NbrJourIntervServ', Input::old('NbrJourIntervServ'), array('class' => 'form-control') ) }}
                                </div>
                                {{ Form::submit('Enregistrer', array('class'=>'btn btn-primary')) }}
                                {{ link_to(URL::previous(), 'Annuler', ['class' => 'btn btn-default']) }}
                            {{ Form::close() }}
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->

@stop