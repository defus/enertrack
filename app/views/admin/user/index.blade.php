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
@section('title') Liste des uilisateurs @stop

{{-- Page specific CSS files --}}
{{-- {{ HTML::style('--Path to css--') }} --}}
@section('css')
<!-- DataTables CSS -->
{{ HTML::style('{{ URL::to('/')}}/assets/css/plugins/dataTables.bootstrap.css') }}
{{ HTML::style('{{ URL::to('/')}}/assets/js/plugins/dataTables/extensions/TableTools-2.2.3/css/dataTables.tableTools.min.css') }}
@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')
{{ HTML::script('{{ URL::to('/')}}/assets/js/plugins/dataTables/extensions/TableTools-2.2.3/js/dataTables.tableTools.min.js') }}
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
            <h1 class="page-header">Utilisateurs <a href="{{ URL::to('admin/user/create') }}" class="btn btn-primary pull-right">Créer un utilisateur</a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des utilisateurs
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
                                    <th>Login</th>
                                    <th>Est Bureau d'étude ?</th>
                                    <th>Est administrateur</th>
                                    <th class="no-sort" style="width:17px;min-width:75px;max-width:75px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $value)
                                <tr>
                                    <td>{{$value->Username}}</td>
                                    <td>{{$value->isbe}}</td>
                                    <td>{{$value->isadmin}}</td>
                                    <td nowrap="nowrap">
                                        <a href="{{ URL::to('admin/user/' . $value->UtilisateurID . '/edit') }}" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>&nbsp;
                                        {{ Form::open(array('url' => 'admin/user/' . $value->UtilisateurID, 'class' => 'pull-right')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        {{ Form::close() }}
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