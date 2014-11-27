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
@section('title') Modifier un batiment @stop

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
    $('#compteurEauxSelect2').select2({
        allowClear: true,
        placeholder: "Sélectionner un compteur d'eau",
        closeOnSelect : false
    });
    $('#compteurElectricitesSelect2').select2({
        allowClear: true,
        placeholder: "Sélectionner un compteur d'électricité",
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
            <h1 class="page-header">Mise-à-jour des informations du batiment </h1>
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
                            {{ Form::model($batiment, array('route' => array('tbge.patrimoine.batiment.update', $batiment->BatimentID), 'method' => 'put', 'role' => 'form')) }}
                                <div class="form-group @if($errors->first('Nom') != '') has-error @endif">
                                    <label>Nom *</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'placeholder' => "Entrer la valeur ...", 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Nom', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Adresse</label>
                                    {{ Form::text('Adresse1', Input::old('Adresse1'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Complément d'adresse</label>
                                    {{ Form::text('Adresse2', Input::old('Adresse2'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Complément d'adresse</label>
                                    {{ Form::text('Adresse3', Input::old('Adresse3'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>altitude</label>
                                    {{ Form::number('altitude', Input::old('altitude'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Latitude</label>
                                    {{ Form::number('Latitude', Input::old('Latitude'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Longitude</label>
                                    {{ Form::number('Longitude', Input::old('Longitude'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Catégorie de batiment</label>
                                    {{ Form::select('Patrimoine', $patrimoines, Input::old('Patrimoine'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group @if($errors->first('Anneeconstruction') != '') has-error @endif">
                                    <label>Année de construction *</label>
                                    {{ Form::number('Anneeconstruction', Input::old('Anneeconstruction'), array('class' => 'form-control' ) ) }}
                                    {{ $errors->first('Anneeconstruction', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nombre d'étages</label>
                                    {{ Form::number('NbrEtage', Input::old('NbrEtage'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Surface (m²)</label>
                                    {{ Form::number('Surface', Input::old('Surface'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nombre d’employés qui travaillent dans le bâtiment de manière régulière</label>
                                    {{ Form::number('NbrEmployee', Input::old('NbrEmployee'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Compteurs d’électricité</label>
                                    <select id="compteurElectricitesSelect2" name="compteurElectricitesID[]" class="form-control" multiple>
                                        @if(count($compteurElectricites) > 0)
                                            @foreach($compteurElectricites as $key => $value)
                                            <optgroup label="{{$value->Energie}}">
                                                <option value="{{$value->CompteurID}}" @if(in_array($value->CompteurID, $compteurElectricitesSelected)) selected="selected" @endif>{{$value->Nom . ' | ' . $value->Reference}}</option>
                                            </optgroup>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Capacité installée/ surface couverte en panneaux, pour la production d’électricité (PV)</label>
                                    {{ Form::number('Pv', Input::old('Pv'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Compteurs d’eau associés et consommation</label>
                                    <select id="compteurEauxSelect2" name="compteurEauxID[]" class="form-control" multiple>
                                        @if(count($compteurEaux) > 0)
                                            @foreach($compteurEaux as $key => $value)
                                            <optgroup label="{{$value->Energie}}">
                                                <option value="{{$value->CompteurID}}" @if(in_array($value->CompteurID, $compteurEauxSelected)) selected="selected" @endif>{{$value->Nom . ' | ' . $value->Reference}}</option>
                                            </optgroup>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Système de chauffage d’eau (le cas échéant)</label>
                                    {{ Form::text('SystemeChauffageEau', Input::old('SystemeChauffageEau'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Capacité installée/ surface couverte en panneaux, pour la production d’eau chaude (CES)</label>
                                    {{ Form::number('Ces', Input::old('Ces'), array('class' => 'form-control') ) }}
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