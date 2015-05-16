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
@section('title') Créer un compteur @stop

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
    $('#patrimoine').select2({
        allowClear: true
    });
});
</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Ajouter un compteur </h1>
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
                            {{ Form::open(array('url' => URL::to('tbge/compteur') , 'role' => 'form')) }}
                                <div class="form-group">
                                    <label>Numéro de compteur</label>
                                    {{ Form::text('Numero', Input::old('Numero'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group @if($errors->first('Reference') != '') has-error @endif">
                                    <label>Numéro de contrat (référence du compteur si électricité, police si eau, matricule si véhicule) *</label>
                                    {{ Form::text('Reference', Input::old('Reference'), array('class' => 'form-control', 'autofocus' => '') ) }}
                                    {{ $errors->first('Reference', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Patrimoine associé au compteur</label>
                                    <select id="patrimoine" name="patrimoine" class="form-control">
                                        <optgroup label="Eclairages">
                                            @foreach($eclairages as $key => $value)
                                                <option value="{{$value->EclairageID}}">{{$value->Nom}}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Points d'arrivee d'eau">
                                            @foreach($arriveeaux as $key => $value)
                                                <option value="{{$value->ArriveeauID}}">{{$value->Nom}}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Vehicules">
                                            @foreach($vehicules as $key => $value)
                                                <option value="{{$value->VehiculeID}}">{{$value->Nom}}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Batiments">
                                            @foreach($batiments as $key => $value)
                                                <option value="{{$value->BatimentID}}">{{$value->Nom}}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Postes de production">
                                            @foreach($posteproductions as $key => $value)
                                                <option value="{{$value->PosteproductionID}}">{{$value->Nom}}</option>
                                            @endforeach
                                        </optgroup>
                                        @if(count($autrepostes) >0) 
                                        <optgroup label="Autre postes">
                                            @foreach($autrepostes as $key => $value)
                                                <option value="{{$value->AutreposteID}}">{{$value->Nom}}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Espaces verts">
                                            @foreach($espaceverts as $key => $value)
                                                <option value="{{$value->EspacevertID}}">{{$value->Nom}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Type d'énergie consommée / produite</label>
                                    {{ Form::select('EnergieID', $energies, Input::old('EnergieID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Type de compteur</label>
                                    {{ Form::select('Type', $typeCompteurs, Input::old('Type'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Fournisseur</label>
                                    {{ Form::select('FournisseurID', $fournisseurs, Input::old('FournisseurID'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Valeur de référence (selon le patrimoine auquel le compteur est associé)</label>
                                    {{ Form::number('Objectif', Input::old('Objectif'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Valeur cible (selon le patrimoine auquel le compteur est associé)</label>
                                    {{ Form::number('Seuil', Input::old('Seuil'), array('class' => 'form-control') ) }}
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