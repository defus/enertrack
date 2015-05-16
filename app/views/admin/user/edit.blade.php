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
@section('title') Modifier un utilisateur @stop

{{-- Page specific CSS files --}}
{{-- {{ HTML::style('--Path to css--') }} --}}
@section('css')
{{ HTML::style('assets/css/plugins/dataTables.bootstrap.css') }}
@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')
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
            <h1 class="page-header">Mise-à-jour des informations de l'utilisateur </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Merci de remplir le formulaire ci-dessous pour modifier l'utilisateur
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            @if ( $errors->count() > 0 )
                                @foreach( $errors->all() as $message )
                                    <div class="alert alert-warning">
                                        {{$message}}
                                    </div>
                                @endforeach
                            @endif
                            {{ Form::model($user, array('route' => array('admin.user.update', $user->UtilisateurID), 'method' => 'put', 'role' => 'form')) }}
                                <div class="form-group @if($errors->first('Username') != '') has-error @endif">
                                    <label>Login *</label>
                                    {{ Form::text('Username', Input::old('Username'), array('class' => 'form-control', 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Username', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Est un bureau d'étude ?</label>
                                    {{ Form::checkbox('isbe', Input::old('isbe') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Est un administrateur ?</label>
                                    {{ Form::checkbox('isadmin', Input::old('isadmin') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    {{ Form::email('Mail', Input::old('Mail'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    {{ Form::password('password', array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Vérifier le mot de passe</label>
                                    {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                                </div>
                                {{ Form::submit('Enregistrer', array('class'=>'btn btn-primary')) }}
                                {{ link_to(URL::previous(), 'Annuler', ['class' => 'btn btn-default']) }}
                            {{ Form::close() }}
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- panel -->
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ajouter un rôle à l'utilisateur
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {{ Form::open(array('url' => URL::to('admin/role') , 'role' => 'form')) }}
                                {{Form::hidden('UtilisateurID', $user->UtilisateurID)}}
                                <div class="form-group @if($errors->first('Role') != '') has-error @endif">
                                    <label>Rôle *</label>
                                    {{ Form::select('Role', $roles, Input::old('Role'), array('class' => 'form-control' ) ) }}
                                    {{ $errors->first('Role', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Maître d'ouvrage</label>
                                    {{ Form::select('MouvrageID', $mos, Input::old('MouvrageID'), array('class' => 'form-control') ) }}
                                </div>
                                {{ Form::submit('Ajouter', array('class'=>'btn btn-primary')) }}
                            {{ Form::close() }}
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liste des roles de l'utilisateur
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Role</th>
                                            <th>Maitre d'ouvrage</th>
                                            <th class="no-sort" style="width:17px;min-width:75px;max-width:75px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($userroles as $key => $value)
                                        <tr>
                                            <td>{{$value->Role}}</td>
                                            <td>{{$value->Mo->Societe}}</td>
                                            <td nowrap="nowrap">
                                                {{ Form::open(array('url' => 'admin/role/' . $user->UtilisateurID, 'class' => 'pull-right')) }}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {{ Form::hidden('Role', $value->Role) }}
                                                    {{ Form::hidden('MouvrageID', $value->record_id) }}
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
                        <!-- /.col-lg-6 (nested) -->
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