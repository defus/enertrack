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
@section('title') Créer un budget et une fréquentation pour un maitre d'ouvrage @stop

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
            <h1 class="page-header">Mise-à-jour du budget et de la fréquentation annuelle pour un maitre d'ouvrage </h1>
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
                            {{ Form::model($moan, array('route' => array('moan.update', $moan->MoanID), 'method' => 'put', 'role' => 'form')) }}
                                <div class="form-group">
                                    <label>Maitre d'ouvrage</label>
                                    {{  Form::select('MouvrageID', $mos, Input::old('MouvrageID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group @if($errors->first('Annee') != '') has-error" @endif">
                                    <label>Anneé *</label>
                                    {{ Form::number('Annee', Input::old('Annee'), array('class' => 'form-control', 'placeholder' => "Entrer l'année ...", 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Annee', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Fréquentation</label>
                                    {{ Form::number('Frequentation', Input::old('Frequentation'), array('class' => 'form-control', 'placeholder' => 'Entrer la fréquentation') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Unité de fréquentation</label>
                                    {{  Form::select('Typefrequentation', array('Habitants'=>'Habitants', 'Nuitees'=>'Nuitees', 'Visiteurs'=>'Visiteurs', 'Salarie'=>'Salarie', 'Unites'=>'Unites'), Input::old('Typefrequentation'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Budget de fonctionnement</label>
                                    {{ Form::number('Budget', Input::old('Budget'), array('class' => 'form-control', 'placeholder' => 'Entrer le budget') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Objectif</label>
                                    {{ Form::number('Objectif', Input::old('Objectif'), array('class' => 'form-control', 'placeholder' => 'Entrer l\'objectif') ) }}
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