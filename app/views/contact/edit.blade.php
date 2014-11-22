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
@section('title') Modifier un contact @stop

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
$(document).ready(function() {
    $('#dataTables-example').dataTable();
});
</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Mise-à-jour des informations du contact </h1>
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
                            {{ Form::model($contact, array('route' => array('contact.update', $contact->CoordonneeID), 'method' => 'put', 'role' => 'form')) }}
                                <div class="form-group">
                                    <label>Maitre d'ouvrage</label>
                                    {{  Form::select('MouvrageID', $mos, Input::old('MouvrageID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group @if($errors->first('Societe') != '') has-error" @endif">
                                    <label>Societé *</label>
                                    {{ Form::text('Societe', Input::old('Societe'), array('class' => 'form-control', 'placeholder' => "Entrer la société ...", 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Societe', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    {{ Form::select('Type', array('MO'=>"Maitre d'ouvrage", 'BE'=>"Bureau d'étude", 'Fournisseur'=>"Fournisseur", 'Utilisateur'=>"Utilisateur"), Input::old('Type'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Prénom</label>
                                    {{ Form::text('Prenom', Input::old('Prenom'), array('class' => 'form-control', 'placeholder' => 'Entrer le prénom') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nom</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'placeholder' => 'Entrer le nom') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    {{ Form::text('Tel', Input::old('Tel'), array('class' => 'form-control', 'placeholder' => 'Entrer le téléphone') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Mail</label>
                                    {{ Form::email('Mail', Input::old('Mail'), array('class' => 'form-control', 'placeholder' => 'Entrer le mail') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Adresse 1</label>
                                    {{ Form::text('Adresse1', Input::old('Adresse1'), array('class' => 'form-control', 'placeholder' => "Entrer l'adresse 1") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Adresse 2</label>
                                    {{ Form::text('Adresse2', Input::old('Adresse2'), array('class' => 'form-control', 'placeholder' => "Entrer l'adresse 2") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Adresse 3</label>
                                    {{ Form::text('Adresse3', Input::old('Adresse3'), array('class' => 'form-control', 'placeholder' => "Entrer l'adresse 3") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Code postal</label>
                                    {{ Form::number('Codepostal', Input::old('Codepostal'), array('class' => 'form-control', 'placeholder' => "Entrer le code postal") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Ville</label>
                                    {{ Form::text('Ville', Input::old('Ville'), array('class' => 'form-control', 'placeholder' => "Entrer la ville") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Pays</label>
                                    {{ Form::text('Pays', Input::old('Pays'), array('class' => 'form-control', 'placeholder' => "Entrer le pays") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Site web</label>
                                    {{ Form::text('Site', Input::old('Site'), array('class' => 'form-control', 'placeholder' => "Entrer le site web") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Commentaire</label>
                                    {{ Form::textarea('Commentaire', Input::old('Commentaire'), array('class' => 'form-control', 'placeholder' => "Entrer le commentaire") ) }}
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