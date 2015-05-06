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
@section('title') Ajouter un poste d'éclairage @stop

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
            <h1 class="page-header">Ajouter un poste d'éclairage </h1>
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
                                <div class="form-group">
                                    <label>Reférence</label>
                                    {{ Form::text('Reference', Input::old('Reference'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group @if($errors->first('Nom') != '') has-error @endif">
                                    <label>Nom / Description *</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Nom', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Secteur d'éclairage</label>
                                    {{ Form::text('Secteur', Input::old('Secteur'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Armoires</label>
                                    {{ Form::text('Armoires', Input::old('Armoires'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Compteurs d'électricité associé</label>
                                    <select id="compteurElectricitesSelect2" name="compteurElectricitesID[]" class="form-control" multiple>
                                        @if(count($compteurElectricites) > 0)
                                            <optgroup label="Compteurs d'électricité">
                                            @foreach($compteurElectricites as $key => $value)
                                                <option value="{{$value->CompteurID}}">{{'N°: ' . $value->Numero . ' | Ref: ' . $value->Reference}}</option>
                                            @endforeach
                                            </optgroup>
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
                                    <label>Éléments électriques et système d’allumage (avec horaire)</label>
                                    {{ Form::textarea('EltElecSystAllum', Input::old('EltElecSystAllum'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Type de tarif</label>
                                    {{ Form::select('TypeTarif', $typeTarifs, Input::old('TypeTarif'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Puissance souscrite (KWh)</label>
                                    {{ Form::number('PuissanceSouscrite', Input::old('PuissanceSouscrite'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Puissance installée (KWh)</label>
                                    {{ Form::number('PuissanceInstalle', Input::old('PuissanceInstalle'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Puissance appelée (KWh)</label>
                                    {{ Form::number('PuissanceAppele', Input::old('PuissanceAppele'), array('class' => 'form-control') ) }}
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
                                    <label>Marque des lampes et ballasts</label>
                                    {{ Form::text('MarqueLampe', Input::old('MarqueLampe'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nombre de jours d'interventions de maintenance par trimestre, par point lumineux </label>
                                    {{ Form::number('NbrJourIntervServ', Input::old('NbrJourIntervServ'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Latitude</label>
                                    {{ Form::number('Latitude', Input::old('Latitude'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Longitude</label>
                                    {{ Form::number('Longitude', Input::old('Longitude'), array('class' => 'form-control') ) }}
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