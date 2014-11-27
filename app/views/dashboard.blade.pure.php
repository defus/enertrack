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
            <h1 class="page-header">Tableau de bord</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">26</div>
                            <div>Factures</div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL::to('facture') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Voir détails</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">12</div>
                            <div>Compteurs</div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL::to('compteur') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Voir détails</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">124</div>
                            <div>Patrimoines</div>
                        </div>
                    </div>
                </div>
                <a href="{{ URL::to('patrimoine') }}">
                    <div class="panel-footer">
                        <span class="pull-left">Voir détails</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Etat des maitres d'ouvrage (MO) ayant des données pour l'année n-1 (Total)
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>_</th>
                                    <th>Nom</th>  
                                    <th>Fréquentation </th>
                                    <th>Conso. KWh EF en {{$annee}}</th>
                                    <th>Conso. KWh EP en {{$annee}}</th>
                                    <th>Conso. eau m3 en {{$annee}}</th>
                                    <th>Emission GES en KgCO2 en {{$annee}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tableau_a_total as $key => $value)
                                <tr>
                                    <td></td>
                                    <td>Total</td>
                                    <td></td>
                                    <td align=right>{{$value['Totalconsoenergie']}}</td>
                                    <td align=right>{{$value['Totalconsoep']}}</td>
                                    <td align=right>{{$value['Totalconsoeau']}}</td>
                                    <td align=right>{{$value['Totalemissionges']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Etat des maitres d'ouvrage (MO) ayant des données pour l'année n-1
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>_</th>
                                    <th>Nom</th>  
                                    <th>Fréquentation </th>
                                    <th>Conso. KWh EF en {{$annee}}</th>
                                    <th>Conso. KWh EP en {{$annee}}</th>
                                    <th>Conso. eau m3 en {{$annee}}</th>
                                    <th>Emission GES en KgCO2 en {{$annee}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tableau_a as $key => $value)
                                <tr>
                                    <td  BGCOLOR="#{{ $value['Couleur'] }}"></td>
                                    <td><a href="index.php?MouvrageID={{ $value['MouvrageID']}}&BaseID={{ $value['BaseID']}}"> {{$value['Societe']}}</a> </td>
                                    <td>{{$value['Frequentation']}} {{$value['Typefrequentation']}}</td>
                                    <td align=right>{{$value['Consoenergie']}}</td>
                                    <td align=right>{{$value['Consoep']}}</td>
                                    <td align=right>{{$value['Consoeau']}}</td>
                                    <td align=right>{{$value['Emissionges']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Consommation {{$annee}} par habitant
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    Faire un graphique
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Maitres d'ouvrage absents du tableau ci-dessus pour cause de données manquantes pour {{$annee}}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Categorie</th>
                                    <th>Code postal</th>
                                    <th>Ville</th>
                                    <th>Date dernière facture</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tableau_b as $key => $value)
                                <tr>
                                    <td>{{$value['Societe']}}</td>
                                    <td>{{$value['Libelle']}}</td>
                                    <td>{{$value['Codepostal']}}</td>
                                    <td>{{$value['Ville']}}</td>
                                    <td>{{$value['Datefacture']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$phrase}}
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <tbody>
                                @foreach($mon_tableauattente as $key => $value)
                                <tr>
                                    <td><a href="index.php?MouvrageID={{$value['MouvrageID']}}&BaseID={{$value['BaseID']}}"> {{$value['Societe']}}</a> </td>
                                    <td>{{$value['Libelle']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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