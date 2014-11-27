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
@section('title') Modifier un véhicule @stop

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
            <h1 class="page-header">Mise-à-jour des informations du véhicule </h1>
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
                            {{ Form::model($vehicule, array('route' => array('tbge.patrimoine.vehicule.update', $vehicule->VehiculeID), 'method' => 'put', 'role' => 'form')) }}
                                <div class="form-group @if($errors->first('Nom') != '') has-error @endif">
                                    <label>Numéro d’immatriculation *</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Nom', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Compteurs associés</label>
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
                                    <label>Type de véhicule</label>
                                    {{ Form::select('CategorieID', $categories, Input::old('CategorieID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Service</label>
                                    {{ Form::select('Service', $services, Input::old('Service'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Marque du véhicule ou engin</label>
                                    {{ Form::text('Marque', Input::old('Marque'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Modèle</label>
                                    {{ Form::text('Modele', Input::old('Modele'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Taille</label>
                                    {{ Form::text('Taille', Input::old('Taille'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Type de carburant</label>
                                    {{ Form::select('Carburant', $carburants, Input::old('Carburant'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Consommation de carburant aux  100 km (L)</label>
                                    {{ Form::number('Conso', Input::old('Conso'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Distance (km) parcourue par mois</label>
                                    {{ Form::number('DistanceParcourue', Input::old('DistanceParcourue'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nombre de jours en réparation du véhicule</label>
                                    {{ Form::number('NbrJrReparation', Input::old('NbrJrReparation'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Puissance fiscale</label>
                                    {{ Form::number('Puissance', Input::old('Puissance'), array('class' => 'form-control') ) }}
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