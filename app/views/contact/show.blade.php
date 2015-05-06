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
@section('title') Coordonnées de l'administrateur @stop

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
            <h1 class="page-header">Coordonnées de l'administrateur </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Informations de la personne à contacter pour l'ajout des informations manquantes dans le reférentiel
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
                                    <label>Societé</label>
                                    <p class="form-control-static">{{$contact->Societe}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Prénom</label>
                                    <p class="form-control-static">{{$contact->Prenom}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Nom</label>
                                    <p class="form-control-static">{{$contact->Nom}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <p class="form-control-static">{{$contact->Tel}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Mail</label>
                                    <p class="form-control-static"><a href="mailto:{{$contact->Mail}}">{{$contact->Mail}}</a></p>
                                </div>
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