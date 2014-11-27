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
@section('title') Tableau de bord @stop

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
            <h1 class="page-header">Nous avons besoin d'une carte, apparament nous nous sommes perdu !</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Erreur 404 - La page que vous avez demandé n'existe pas sur le serveur !
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <h3>Quelle page souhaitez-vous consulter ?</h3>

                    <p>
                      We couldn't find the page you requested on our servers. We're really sorry
                      about that. It's our fault, not yours. We'll work hard to get this page
                      back online as soon as possible.
                    </p>

                    <p>
                      Peut-être souhaitez-vous aller à <a href="{{{ URL::to('/') }}}">l'acceil de l'application</a>?
                    </p>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->

@stop

