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
@section('title') Liste des budgets et fréquentation pour un maitre d'ouvrage @stop

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
{{ HTML::script('assets/js/plugins/dataTables/extensions/TableTools-2.2.3/js/dataTables.tableTools.min.js') }}
<script>
$(document).ready(function() {
    $('#dataTables-example').dataTable({
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
            <h1 class="page-header">Budgets et fréquentations <a href="{{ URL::to('moan/create') }}" class="btn btn-primary pull-right">Créer un budget et une fréquentation annuel</a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des budget et fréquentations pour les maitres d'ouvrages
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
                                    <th>Année</th>
                                    <th>Fréquentation</th>
                                    <th>Unité de fréquentation</th>
                                    <th>Budget de fonctionnement</th>
                                    <th class="no-sort" style="width:17px;min-width:75px;max-width:75px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($moans as $key => $value)
                                <tr>
                                    <td>{{$value->Mo->Societe}}</td>
                                    <td>{{$value->Annee}}</td>
                                    <td>{{$value->Frequentation}}</td>
                                    <td>{{$value->Typefrequentation}}</td>
                                    <td>{{$value->Budget}}</td>
                                    <td nowrap="nowrap">
                                        <div class="pull-right">
                                            <a href="{{ URL::to('moan/' . $value->MoanID . '/edit') }}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </a>&nbsp;
                                            {{ Form::open(array('url' => 'moan/' . $value->MoanID, 'class' => 'pull-right')) }}
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