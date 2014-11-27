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
@section('title') Consultation des éclairages @stop

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
    $('#dataTables-eclairages').dataTable();
});
</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Postes d'éclairages <a href="{{ URL::to('tbge/patrimoine/eclairage/create') }}" class="btn btn-success pull-right">Ajouter un poste d'éclairage</a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Postes d'éclairage publics
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Success-Messages -->
                    @if ($message = Session::get('eclairage.success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{{ $message }}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-eclairages">
                            <thead>
                                <tr>
                                    <th>Secteur d'éclairage</th>
                                    <th>Catégorie</th>
                                    <th>Nombre de points lumineux</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eclairages as $key => $value)
                                <tr>
                                    <td>{{$value->Nom}}</td>
                                    <td>{{$value->categorie}}</td>
                                    <td>{{$value->Nbrpointlumineux}}</td>
                                    <td>
                                        <div class="pull-right">
                                            <a href="{{ URL::to('tbge/patrimoine/eclairage/' . $value->EclairageID . '/edit') }}" class="btn btn-sm btn-success">Editer</a> 
                                            {{ Form::open(array('url' => 'tbge/patrimoine/eclairage/' . $value->EclairageID, 'class' => 'pull-right')) }}
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
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->

@stop