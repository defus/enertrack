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
@section('title') Créer un maitre d'ouvrage @stop

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
            <h1 class="page-header">Maitres d'ouvrage</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Modifier les informations du maitre d'ouvrage 
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
                            {{ Form::model($mo, array('route' => array('mo.update', $mo->MouvrageID), 'method' => 'put', 'role' => 'form', 'files' => true)) }}
                                <div class="form-group">
                                    <label>Maitre d'ouvrage *</label>
                                    {{ Form::text('Societe', Input::old('Societe'), array('class' => 'form-control', 'placeholder' => 'Entrer le nom du maitre d\'ouvrage ...', 'autofocus' => '' ) ) }}
                                </div>
                                <div class="form-group">
                                    <label>Catégorie *</label>
                                    {{  Form::select('CategorieID', $categories, Input::old('CategorieID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Code postal</label>
                                    {{ Form::number('Codepostal', Input::old('Codepostal'), array('class' => 'form-control', 'placeholder' => 'Entrer le code postal') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Ville</label>
                                    {{ Form::text('Ville', Input::old('Ville'), array('class' => 'form-control', 'placeholder' => 'Entrer la ville') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Bureau d'étude</label>
                                    {{  Form::select('BureauetudeID', $bes, Input::old('BureauetudeID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Station météo</label>
                                    {{  Form::select('StationdjuID', $stationDjus, Input::old('StationdjuID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Logo</label>
                                    @if(isset($mo->Logo))
                                    <img src="{{ URL::to('mo/download/' . $mo->Logo) }}" class="img-thumbnail" alt="Logo">
                                    @endif
                                    {{ Form::file('Logo'); }}
                                </div>
                                <div class="form-group">
                                    <label>Présentation</label>
                                    {{ Form::textarea('Commentaire', Input::old('Commentaire'), array('class' => 'form-control', 'placeholder' => 'Entrer le commentaire', 'rows' => '3') ) }}
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