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
                            {{ Form::open(array('url' => URL::to('patrimoine/eclairage') , 'role' => 'form')) }}
                                <div class="form-group">
                                    <label>Maitre d'ouvrage</label>
                                    {{  Form::select('MouvrageID', $mos, Input::old('MouvrageID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group @if($errors->first('Nom') != '') has-error @endif">
                                    <label>Nom du poste d'éclairage *</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'placeholder' => "Entrer la valeur ...", 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Nom', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Catégorie</label>
                                    {{  Form::select('CategorieID', $categories, Input::old('CategorieID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Année de mise en service</label>
                                    {{ Form::number('Anneeconstruction', Input::old('Anneeconstruction'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Puissance</label>
                                    {{ Form::number('Puissance', Input::old('Puissance'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Puissance mésurée</label>
                                    {{ Form::number('Puissancemesuree', Input::old('Puissancemesuree'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nombre de points lumineux</label>
                                    {{ Form::number('Nbrpointlumineux', Input::old('Nbrpointlumineux'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Kms eclairés</label>
                                    {{ Form::number('Kmeclaires', Input::old('Kmeclaires'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Déclencheur</label>
                                    {{ Form::text('Declencheur', Input::old('Declencheur'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nombre d'heures d'eclairage annuel</label>
                                    {{ Form::number('NbrHeuresans', Input::old('NbrHeuresans'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Station méteo</label>
                                    {{  Form::select('StationdjuID', $stationDjus, Input::old('StationdjuID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Descriptif</label>
                                    {{ Form::textarea('Descriptif', Input::old('Descriptif'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Contact</label>
                                    {{  Form::select('CoordonneeID', $contacts, Input::old('CoordonneeID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Commentaires</label>
                                    {{ Form::textarea('Commentaire', Input::old('Commentaire'), array('class' => 'form-control') ) }}
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