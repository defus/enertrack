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
@section('title') Validation des compteurs à importer @stop

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
var oTable = null;
$(document).ready(function() {
    oTable = $('#dataTables-compteurs').dataTable({
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "{{ URL::to('/')}}/assets/js/plugins/dataTables/extensions/TableTools-2.2.3/swf/copy_csv_xls_pdf.swf"
        },
        //"sScrollY": "400px",
        "bPaginate": false,
        "language": {
            "url": "{{ URL::to('/')}}/assets/js/plugins/dataTables/French.lang"
        }
    });
    $('#chkAllSelect').change(function() {
       if($(this).is(':checked')) {            
            $('.chkSelect', oTable.fnGetNodes()).prop("checked", true);
        } else {
            $('.chkSelect', oTable.fnGetNodes()).prop("checked", false);
        } 
        var data = $('input, select').serialize();
        return false;
    });
    $('#form').submit(function () {
        $("input:checked", oTable.fnGetNodes()).each(function(){
            $('<input type="checkbox" name="questions" ' + 'value="' + $(this).val() + '" type="hidden" checked="checked" />').css("display", "none").appendTo('#form');
        });
    });
});
</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Compteurs à importer</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des compteurs à importer dans la base de données
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Success-Messages -->
                    @if ($message = Session::get('batiment.success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{{ $message }}}
                        </div>
                    @endif
                    {{ Form::open(array('url' => URL::to('tbge/compteur/import/csv/doimport') , 'role' => 'form' )) }}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-compteurs">
                                <thead>
                                    <tr>
                                        <th>
                                            {{Form::checkbox('chkAllSelect', '1', true, array('id' => 'chkAllSelect', 'class' => 'form-control'))}}
                                        </th>
                                        @foreach($header as $key => $value)
                                            <th>{{$value}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $d_key => $d_value)
                                    <tr>
                                        <td>
                                            {{Form::checkbox('selecte[' . $d_key . ']', '1', true, array('class' => 'chkSelect'))}}
                                        </td>
                                        @foreach($header as $h_key => $h_value)
                                            <td>
                                                {{$d_value[$h_key]}}
                                                {{Form::hidden('col['.$d_key.']['.$header[$h_key].']', $d_value[$h_key])}}
                                            </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ Form::submit('Enregistrer', array('class'=>'btn btn-primary')) }}
                        {{ link_to(URL::previous(), 'Annuler', ['class' => 'btn btn-default']) }}
                    {{ Form::close() }}
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