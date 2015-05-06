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
@section('title') Liste des factures @stop

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
    var baseUrl = "{{URL::to('/')}}";

    $('#dataTables-example').dataTable({
        "dom": 'T<"clear">lfrtip',
        "processing": true,
        "serverSide": true,
        "ajax": "{{ URL::to('tbge/facture/datatable/ajax') }}",
        "columns": [
            {"name": "facture.Nom", "targets": 0, "data": "Nom" },
            {"name": "compteur.Reference", "targets": 1},
            {"name": "facture.Debutperiode", "targets": 2, "data": "Debutperiode", "type": "date", className: "text-right"},
            {"name": "facture.Finperiode", "targets": 3, "data": "Finperiode", "type": "date", className: "text-right"},
            {"name": "facture.Totalttc", "targets": 4, "data": "Totalttc", "type": "currency", className: "text-right"},
            {"name": "facture.Consommation", "targets": 5, "data": "Consommation", "type": "num", className: "text-right"},
            {"name": "Action", "targets": 6, "searchable": false, "orderable": false, "width":"60px"}
        ],
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return  'N°: ' + row.compteur_numero + ' - Ref: ' + row.compteur_reference;
                },
                "type": "html",
                "targets": 1
            },{
                "render": function ( data, type, row ) {
                    return  '<div class="pull-right">' +
                                '<a href="' + baseUrl + '/tbge/facture/' + row.FactureID + '/edit" class="btn btn-xs btn-success"> <i class="fa fa-edit"></i></a> &nbsp;' +
                                '<form method="POST" action="'+baseUrl + '/tbge/facture/' + row.FactureID + '" accept-charset="UTF-8" class="pull-right"><input name="_token" type="hidden" value="VgCwyBAy8xM1DsqNDnyi5VBl8x1fUNixo4h3NCcY"><input name="_method" type="hidden" value="DELETE"><button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></form>'+
                            '</div>';
                },
                "type": "html",
                "targets": 6
            },
            //{ "visible": false,  "targets": [ 3 ] }
        ],
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
            <h1 class="page-header">Factures <a href="{{ URL::to('tbge/facture/create') }}" class="btn btn-success pull-right">Ajouter une facture</a></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des factures saisies
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Success-Messages -->
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ $message }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Numero de facture&nbsp;</th>
                                    <th>Compteur associé&nbsp;</th>
                                    <th>Du&nbsp;</th>
                                    <th>Au&nbsp;</th>
                                    <th>Coût TTC&nbsp;</th>
                                    <th>Consommation&nbsp;</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
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