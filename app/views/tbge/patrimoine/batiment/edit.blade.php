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
        placeholder: "Sélectionner un compteur d'eau"
    });
    $('#compteurElectricitesSelect2').select2({
        allowClear: true,
        placeholder: "Sélectionner un compteur d'électricité"
    });
    $('#patrimoineSelect2').select2({
        allowClear: true,
        placeholder: "Sélectionner la catégorie"
    });
    $('#divisionSelect2').select2({
        allowClear: true,
        placeholder: "Sélectionner les divisions"
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
                                <div class="form-group">
                                    <label>Référence</label>
                                    {{ Form::text('Reference', Input::old('Reference'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group @if($errors->first('Nom') != '') has-error @endif">
                                    <label>Nom du bâtiment *</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'placeholder' => "Entrer la valeur ...", 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Nom', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Compteur(s) d’électricité associé(s)</label>
                                    <select id="compteurElectricitesSelect2" name="compteurElectricitesID[]" class="form-control" multiple>
                                        @if(count($compteurElectricites) > 0)
                                            <optgroup label="Compteurs d'électricité">
                                            @foreach($compteurElectricites as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(in_array($value->CompteurID, $compteurElectricitesSelected)) selected="selected" @endif>{{'N°: ' . $value->Numero . ' | Ref: ' . $value->Reference}}</option>
                                            @endforeach
                                            </optgroup>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Compteurs d’eau associés</label>
                                    <select id="compteurEauxSelect2" name="compteurEauxID[]" class="form-control" multiple>
                                        @if(count($compteurEaux) > 0)
                                            <optgroup label="Compteurs d'eau">
                                            @foreach($compteurEaux as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(in_array($value->CompteurID, $compteurEauxSelected)) selected="selected" @endif>{{'N°: ' . $value->Numero . ' | Ref: ' . $value->Reference}}</option>
                                            @endforeach
                                            </optgroup>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Adresse/Description</label>
                                    {{ Form::text('Adresse1', Input::old('Adresse1'), array('class' => 'form-control') ) }}
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
                                    <label>Année de construction</label>
                                    {{ Form::number('Anneeconstruction', Input::old('Anneeconstruction'), array('class' => 'form-control' ) ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nombre d’employés réguliers / résidents</label>
                                    {{ Form::number('NbrEmployee', Input::old('NbrEmployee'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Les divisions qui sont représentées dans le bâtiment</label>
                                    <select id="divisionSelect2" name="Division[]" class="form-control" multiple>
                                        @if(count($divisions) > 0)
                                            <optgroup label="Liste des divisions">
                                            @foreach($divisions as $key => $division)
                                                <option value="{{$division}}" @if(in_array($division, explode('-', $batiment->Division))) selected="selected" @endif>{{$division}}</option>
                                            @endforeach
                                            </optgroup>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Catégorie de bâtiment</label>
                                    <select id="patrimoineSelect2" name="Patrimoine" class="form-control">
                                        @if(count($patrimoines) > 0)
                                            @foreach($patrimoines as $categorie => $sousCategories)
                                            <optgroup label="{{$categorie}}">
                                                @foreach($sousCategories as $sousCAtegorieKey => $sousCategorieLabel)
                                                    <option value="{{$sousCAtegorieKey}}" @if($sousCAtegorieKey == $batiment->Patrimoine) selected="selected" @endif>{{$sousCategorieLabel}}</option>
                                                @endforeach
                                            </optgroup>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Surface (m²)</label>
                                    {{ Form::number('Surface', Input::old('Surface'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nombre d'étages</label>
                                    {{ Form::number('NbrEtage', Input::old('NbrEtage'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Surface chauffée (m²)</label>
                                    {{ Form::number('SurfaceChauffe', Input::old('SurfaceChauffe'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Adoption mesures  Efficacité énergétique (EE)</label>
                                    {{ Form::checkbox('MesuresEE', Input::old('MesuresEE') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Description Mesures EE</label>
                                    {{ Form::text('MesuresEEDesc', Input::old('MesuresEEDesc'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Adoption mesures  Gestion Rationnelle Eau(GRE)</label>
                                    {{ Form::checkbox('MesuresGRE', Input::old('MesuresGRE') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Description Mesures GRE</label>
                                    {{ Form::text('MesuresEEDesc', Input::old('MesuresEEDesc'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Capacité installée/ surface couverte en panneaux, pour la production d’électricité (PV)</label>
                                    {{ Form::number('Pv', Input::old('Pv'), array('class' => 'form-control') ) }}
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