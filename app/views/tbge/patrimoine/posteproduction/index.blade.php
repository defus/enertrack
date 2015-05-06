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
@section('title') Liste des postes de production @stop

{{-- Page specific CSS files --}}
{{-- {{ HTML::style('--Path to css--') }} --}}
@section('css')
<!-- DataTables CSS -->
{{ HTML::style('assets/css/plugins/dataTables.bootstrap.css') }}
{{ HTML::style('assets/js/plugins/dataTables/extensions/TableTools-2.2.3/css/dataTables.tableTools.min.css') }}
@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    $('#dataTables-posteproductions').dataTable({
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "{{ URL::to('/')}}/assets/js/plugins/dataTables/extensions/TableTools-2.2.3/swf/copy_csv_xls_pdf.swf"
        },
        "language": {
            "url": "{{ URL::to('/')}}/assets/js/plugins/dataTables/French.lang"
        }
    });
});
</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Postes de production <a href="{{ URL::to('tbge/patrimoine/posteproduction/create') }}" class="btn btn-success pull-right">Ajouter un poste de production</a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des postes de production enregistrés dans l'application
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Success-Messages -->
                    @if ($message = Session::get('posteproduction.success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{{ $message }}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-posteproductions">
                            <thead>
                                <tr>
                                    <th>Numéro d’identification du poste</th>
                                    <th>Nom du poste</th>
                                    <th>Année de mise en service</th>
                                    <th class="no-sort" style="width:75px;min-width:75px;max-width:75px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posteproductions as $key => $value)
                                <tr>
                                    <td>{{$value->Reference}}</td>
                                    <td>{{$value->Nom}}</td>
                                    <td>{{$value->Anneeconstruction}}</td>
                                    <td nowrap="nowrap">
                                        <div class="pull-right">
                                            <a href="{{ URL::to('tbge/patrimoine/posteproduction/' . $value->PosteproductionID . '/edit') }}" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>&nbsp;
                                            {{ Form::open(array('url' => 'tbge/patrimoine/posteproduction/' . $value->PosteproductionID, 'class' => 'pull-right')) }}
                                                {{ Form::hidden('_method', 'DELETE') }}
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
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