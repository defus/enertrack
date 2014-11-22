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
@section('title') Créer un batiment @stop

{{-- Page specific CSS files --}}
{{-- {{ HTML::style('--Path to css--') }} --}}
@section('css')
<!-- DataTables CSS -->
{{ HTML::style('assets/css/plugins/dataTables.bootstrap.css') }}
@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>

</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Créer un batiment </h1>
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
                            {{ Form::open(array('url' => URL::to('patrimoine/batiment') , 'role' => 'form')) }}
                                <div class="form-group">
                                    <label>Maitre d'ouvrage</label>
                                    {{  Form::select('MouvrageID', $mos, Input::old('MouvrageID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group @if($errors->first('Nom') != '') has-error" @endif">
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
                                    <label>Code postal</label>
                                    {{ Form::number('Codepostal', Input::old('Codepostal'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Ville</label>
                                    {{ Form::text('Ville', Input::old('Ville'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Pays</label>
                                    {{ Form::text('Pays', Input::old('Pays'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Cadastre</label>
                                    {{ Form::text('Cadastre', Input::old('Cadastre'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Contact</label>
                                    {{  Form::select('CoordonneeID', $contacts, Input::old('CoordonneeID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group @if($errors->first('Anneeconstruction') != '') has-error" @endif">
                                    <label>Année de construction *</label>
                                    {{ Form::number('Anneeconstruction', Input::old('Anneeconstruction'), array('class' => 'form-control' ) ) }}
                                    {{ $errors->first('Anneeconstruction', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Patrimoine</label>
                                    {{ Form::select('Patrimoine', array('1'=>"Inconnu", '2'=>"Aucun", '3'=>"Monument historique", '4'=>"Secteur Sauvegardé", '5'=>"ZPPAUP ou AMVAP", '6'=>"Patrimoine mondial de l'UNESCO", '7'=>"Parc Naturel"), Input::old('Patrimoine'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Voisinage</label>
                                    {{ Form::select('Voisinage', array('1'=>"Inconnu", '2'=>"Libre sur tous les cotés", '3'=>"Accolé à un batiment sur 1 grand coté", '4'=>"Accolé à un batiment sur 1 petit coté", '5'=>"Accolé à un batiment sur 2 grands cotés", '6'=>"Accolé à un batiment sur 2 petits cotés", '7'=>"Accolé à un batiment sur 3 cotés ou plus"), Input::old('Voisinage'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Orientation</label>
                                    {{ Form::select('Orientation', array('1'=>"Inconnu", '2'=>"Nord", '3'=>"Nord-Est", '4'=>"Est", '5'=>"Sud-Est", '6'=>"Sud", '7'=>"Sud-Ouest", '8'=>"Ouest", '9'=>"Nord-Ouest"), Input::old('Orientation'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Exposition</label>
                                    {{ Form::select('Exposition', array('1'=>"Inconnue", '2'=>"Peu exposé", '3'=>"Moyennement exposé", '4'=>"Très exposé"), Input::old('Exposition'), array('class' => 'form-control')) }}
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
                                    <label>Station méteo</label>
                                    {{  Form::select('StationdjuID', $stationDjus, Input::old('StationdjuID'), array('class' => 'form-control')) }}
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