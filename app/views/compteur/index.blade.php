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
@section('title') Consultation des compteurs @stop

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
            <h1 class="page-header">Compteurs <a href="{{ URL::to('compteur/create') }}" class="btn btn-primary pull-right">Créer un compteur</a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Consultation des compteurs enregistrés
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Success-Messages -->
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{{ $message }}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Maitre d'ouvrage</th>
                                    <th>Nom du compteur</th>
                                    <th>Type</th>
                                    <th>Consommable</th>
                                    <th>Reference de contrat</th>
                                    <th>Numéro</th>
                                    <th>Localisation</th>
                                    <th>Fournisseur</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compteurs as $key => $value)
                                <tr>
                                    <td>{{ isset($value->Mo->Societe) ? $value->Mo->Societe : '' }}</td>
                                    <td>{{$value->Nom}}</td>
                                    <td>{{$value->Type}}</td>
                                    <td>{{ isset($value->Energie->Nom) ? $value->Energie->Nom : '' }}</td>
                                    <td>{{$value->Reference}}</td>
                                    <td>{{$value->Numero}}</td>
                                    <td>{{$value->Localisation}}</td>
                                    <td>{{ isset($value->Fournisseur->Societe) ? $value->Fournisseur->Societe : '' }}</td>
                                    <td>
                                        <div class="pull-right">
                                            <a href="{{ URL::to('compteur/' . $value->CompteurID . '/edit') }}" class="btn btn-sm btn-primary">Editer</a> 
                                            {{ Form::open(array('url' => 'compteur/' . $value->CompteurID, 'class' => 'pull-right')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                {{ Form::submit("Supprimer", array('class' => 'btn btn-sm btn-danger')) }}
                                            {{ Form::close() }}
                                        </div>
                                      </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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