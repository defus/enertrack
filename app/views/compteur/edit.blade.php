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
@section('title') Modifier un compteur @stop

{{-- Page specific CSS files --}}
{{-- {{ HTML::style('--Path to css--') }} --}}
@section('css')

@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')

@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Mise-à-jour des informations du compteur </h1>
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
                            {{ Form::model($compteur, array('route' => array('compteur.update', $compteur->CompteurID), 'method' => 'put', 'role' => 'form')) }}
                                <div class="form-group">
                                    <label>Maitre d'ouvrage</label>
                                    {{  Form::select('MouvrageID', $mos, Input::old('MouvrageID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group @if($errors->first('Nom') != '') has-error @endif">
                                    <label>Nom du compteur *</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'placeholder' => "Entrer le nom du compteur ...", 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Nom', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    {{ Form::select('Type', array('CONSO'=>"Consommation d’énergie", 'CONSOEAU'=>"Consommation d’eau", 'CONSOLIEPROD'=>"Consommation liée à un de vos postes de production", 'MP'=>"Consommation en matière première pour fabrication", 'PROD' => "Production  d’énergie", 'PRODEAU'=> "Production d’eau chaude", 'FABRICATION'=> "Fabrication de produits manufacturés"), Input::old('Type'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Consommable</label>
                                    {{ Form::select('EnergieID', $energies, Input::old('EnergieID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Compteur de production lié</label>
                                    {{ Form::select('CompteurprodID', $compteurprods, Input::old('CompteurprodID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Compteur d'énergie</label>
                                    {{ Form::checkbox('Estenergie', Input::old('Estenergie') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Reférence de contrat</label>
                                    {{ Form::text('Reference', Input::old('Reference'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Numéro/ réference physique du compteur</label>
                                    {{ Form::text('Numero', Input::old('Numero'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Localisation</label>
                                    {{ Form::text('Localisation', Input::old('Localisation'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Fournisseur</label>
                                    {{ Form::select('FournisseurID', $fournisseurs, Input::old('FournisseurID'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Commentaire</label>
                                    {{ Form::textarea('Commentaire', Input::old('Commentaire'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Seuil</label>
                                    {{ Form::number('Seuil', Input::old('Seuil'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Objectif de consommation pour ce compteur (facultatif)</label>
                                    {{ Form::number('Objectif', Input::old('Objectif'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Clos ?</label>
                                    {{ Form::checkbox('Clos', Input::old('Clos')) }}
                                </div>
                                <div class="form-group">
                                    <label>Ancienne reference (si le fournisseura modifié la reference)</label>
                                    {{ Form::text('Reference2', Input::old('Reference2'), array('class' => 'form-control') ) }}
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