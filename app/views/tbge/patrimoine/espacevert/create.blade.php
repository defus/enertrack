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
@section('title') Créer un espace vert @stop

{{-- Page specific CSS files --}}
{{-- {{ HTML::style('--Path to css--') }} --}}
@section('css')
{{ HTML::style('assets/select2-3.5.2/select2.css') }}
{{ HTML::style('assets/select2-3.5.2/select2-bootstrap.css') }}
@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')
{{ HTML::script('assets/select2-3.5.2/select2.min.js') }}
{{ HTML::script('assets/select2-3.5.2/select2_locale_fr.js') }}
<script>
$(document).ready(function() {
    $('#compteurEauxSelect2').select2({
        allowClear: true,
        placeholder: "Sélectionner un compteur d'eau",
        closeOnSelect : false
    });
    $('#arriveeauSelect2').select2({
        allowClear: true
    });
});
</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Créer un espace vert </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                     Merci de remplir le formulaire ci-dessous
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
                            {{ Form::open(array('url' => URL::to('tbge/patrimoine/espacevert') , 'role' => 'form')) }}
                                <div class="form-group">
                                    <label>Référence</label>
                                    {{ Form::text('Reference', Input::old('Reference'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Point d’arrivée d’eau</label>
                                    <select id="arriveeauSelect2" name="ArriveeauID" class="form-control">
                                        @if(count($arriveeaux) > 0)
                                        <optgroup label="Points d'arrivée d'eau">
                                            @foreach($arriveeaux as $key => $value)
                                                <option value="{{$value->ArriveeauID}}" @if(Input::old('ArriveeauID') === $value->ArriveeauID) selected="selected" @endif>{{$value->Nom}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Sous-compteur</label>
                                    <select id="compteurEauxSelect2" name="compteurEauxID[]" class="form-control" multiple>
                                        @if(count($compteurEaux) > 0)
                                            <optgroup label="Compteurs d'eau">
                                            @foreach($compteurEaux as $key => $value)
                                                <option value="{{$value->CompteurID}}">{{'N°: ' . $value->Numero . ' - Ref: ' . $value->Reference}}</option>
                                            @endforeach
                                            </optgroup>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Catégorie</label>
                                    {{ Form::select('Categorie', $categories, Input::old('Categorie'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group @if($errors->first('Nom') != '') has-error @endif">
                                    <label>Nom / Description *</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'placeholder' => "Entrer la valeur ...", 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Nom', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Surface totale (m²)</label>
                                    {{ Form::number('Surface', Input::old('Surface'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Alignement des arbres (km)</label>
                                    {{ Form::number('AlignementArbres', Input::old('AlignementArbres'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Type de système d'arrosage</label>
                                    {{ Form::select('SystArrosage', $systemearrosages, Input::old('SystArrosage'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Latitude</label>
                                    {{ Form::number('Latitude', Input::old('Latitude'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Longitude</label>
                                    {{ Form::number('Longitude', Input::old('Longitude'), array('class' => 'form-control') ) }}
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
    </div>
    <!-- /.row -->

</div>
<!-- /#page-wrapper -->

@stop