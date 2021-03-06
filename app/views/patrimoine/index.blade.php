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
@section('title') Liste des patrimoines @stop

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
    $('#dataTables-batiments').dataTable({
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });
    $('#dataTables-eclairages').dataTable({
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });
    $('#dataTables-vehicules').dataTable({
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });
    $('#dataTables-posteproductions').dataTable({
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });
    $('#dataTables-autrepostes').dataTable({
      "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    });
});
</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Patrimoines</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Batiments
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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-batiments">
                            <thead>
                                <tr>
                                    <th>Maitre d'ouvrage</th>
                                    <th>Nom</th>
                                    <th>Adresse 1</th>
                                    <th>Code postal</th>
                                    <th>Ville</th>
                                    <th>Contact</th>
                                    <th>Année de construction</th>
                                    <th class="no-sort" style="width:17px;min-width:75px;max-width:75px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($batiments as $key => $value)
                                <tr>
                                    <td>{{ $value->Societe }}</td>
                                    <td>{{$value->Nom}}</td>
                                    <td>{{$value->Adresse1}}</td>
                                    <td>{{$value->Codepostal}}</td>
                                    <td>{{$value->Ville}}</td>
                                    <td>{{$value->Contact}}</td>
                                    <td>{{$value->Anneeconstruction}}</td>
                                    <td nowrap="nowrap">
                                        <div class="pull-right">
                                            <a href="{{ URL::to('patrimoine/batiment/' . $value->BatimentID . '/edit') }}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </a>&nbsp;
                                            {{ Form::open(array('url' => 'patrimoine/batiment/' . $value->BatimentID, 'class' => 'pull-right')) }}
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
                                    <th>Maitre d'ouvrage</th>
                                    <th>Nom du poste d'eclairage</th>
                                    <th>Catégorie</th>
                                    <th>Nombre de points lumineux</th>
                                    <th>Kms eclairés</th>
                                    <th>Declencheur</th>
                                    <th>Contact</th>
                                    <th class="no-sort" style="width:17px;min-width:75px;max-width:75px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($eclairages as $key => $value)
                                <tr>
                                    <td>{{ $value->Societe }}</td>
                                    <td>{{$value->Nom}}</td>
                                    <td>{{$value->categorie}}</td>
                                    <td>{{$value->Nbrpointlumineux}}</td>
                                    <td>{{$value->Kmeclaires}}</td>
                                    <td>{{$value->Declencheur}}</td>
                                    <td>{{$value->Contact}}</td>
                                    <td nowrap="nowrap">
                                        <div class="pull-right">
                                            <a href="{{ URL::to('patrimoine/eclairage/' . $value->EclairageID . '/edit') }}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </a>&nbsp;
                                            {{ Form::open(array('url' => 'patrimoine/eclairage/' . $value->EclairageID, 'class' => 'pull-right')) }}
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    Véhicules
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Success-Messages -->
                    @if ($message = Session::get('vehicule.success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{{ $message }}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-vehicules">
                            <thead>
                                <tr>
                                    <th>Maitre d'ouvrage</th>
                                    <th>Nom du véhicule</th>
                                    <th>Catégorie</th>
                                    <th>Carburant</th>
                                    <th>Marque</th>
                                    <th>Modèle</th>
                                    <th>Puissance fiscale</th>
                                    <th>Année de construction</th>
                                    <th>Contact</th>
                                    <th class="no-sort" style="width:17px;min-width:75px;max-width:75px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehicules as $key => $value)
                                <tr>
                                    <td>{{ $value->Societe }}</td>
                                    <td>{{$value->Nom}}</td>
                                    <td>{{$value->categorie}}</td>
                                    <td>{{$value->Carburant}}</td>
                                    <td>{{$value->Marque}}</td>
                                    <td>{{$value->Modele}}</td>
                                    <td>{{$value->Puissance}}</td>
                                    <td>{{$value->Anneeconstruction}}</td>
                                    <td>{{$value->Contact}}</td>
                                    <td nowrap="nowrap">
                                        <div class="pull-right">
                                            <a href="{{ URL::to('patrimoine/vehicule/' . $value->VehiculeID . '/edit') }}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </a>&nbsp;
                                            {{ Form::open(array('url' => 'patrimoine/vehicule/' . $value->VehiculeID, 'class' => 'pull-right')) }}
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    Postes de production
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
                                    <th>Maitre d'ouvrage</th>
                                    <th>Nom du poste</th>
                                    <th>Catégorie</th>
                                    <th>Adresse 1</th>
                                    <th>Année de mise en service</th>
                                    <th>Production théorique</th>
                                    <th>Contact</th>
                                    <th class="no-sort" style="width:17px;min-width:75px;max-width:75px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posteproductions as $key => $value)
                                <tr>
                                    <td>{{$value->Societe }}</td>
                                    <td>{{$value->Nom}}</td>
                                    <td>{{$value->categorie}}</td>
                                    <td>{{$value->Adresse1}}</td>
                                    <td>{{$value->Anneeconstruction}}</td>
                                    <td>{{$value->Productiontheorique}}</td>
                                    <td>{{$value->Contact}}</td>
                                    <td nowrap="nowrap">
                                        <div class="pull-right">
                                            <a href="{{ URL::to('patrimoine/posteproduction/' . $value->PosteproductionID . '/edit') }}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </a>&nbsp;
                                            {{ Form::open(array('url' => 'patrimoine/posteproduction/' . $value->PosteproductionID, 'class' => 'pull-right')) }}
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    Autre Postes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Success-Messages -->
                    @if ($message = Session::get('autreposte.success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{{ $message }}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-autrepostes">
                            <thead>
                                <tr>
                                    <th>Maitre d'ouvrage</th>
                                    <th>Nom du poste</th>
                                    <th>Catégorie</th>
                                    <th>Année de construction</th>
                                    <th>Contact</th>
                                    <th class="no-sort" style="width:17px;min-width:75px;max-width:75px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($autrepostes as $key => $value)
                                <tr>
                                    <td>{{$value->Societe }}</td>
                                    <td>{{$value->Nom}}</td>
                                    <td>{{$value->categorie}}</td>
                                    <td>{{$value->Anneeconstruction}}</td>
                                    <td>{{$value->Contact}}</td>
                                    <td nowrap="nowrap">
                                        <div class="pull-right">
                                            <a href="{{ URL::to('patrimoine/autreposte/' . $value->AutreposteID . '/edit') }}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </a>&nbsp;
                                            {{ Form::open(array('url' => 'patrimoine/autreposte/' . $value->AutreposteID, 'class' => 'pull-right')) }}
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