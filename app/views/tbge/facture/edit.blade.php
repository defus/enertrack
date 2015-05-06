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
@section('title') Modifier une facture @stop

{{-- Page specific CSS files --}}
{{-- {{ HTML::style('--Path to css--') }} --}}
@section('css')
{{ HTML::style('assets/select2-3.5.2/select2.css') }}
{{ HTML::style('assets/select2-3.5.2/select2-bootstrap.css') }}
{{ HTML::style('assets/jquery-ui-1.11.2/themes/base/all.css') }}
@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')
{{ HTML::script('assets/select2-3.5.2/select2.min.js') }}
{{ HTML::script('assets/select2-3.5.2/select2_locale_fr.js') }}
{{ HTML::script('assets/jQuery-Mask-Plugin-1.11.2/dist/jquery.mask.min.js') }}
{{ HTML::script('assets/jquery-ui-1.11.2/ui/core.js') }}
{{ HTML::script('assets/jquery-ui-1.11.2/ui/widget.js') }}
{{ HTML::script('assets/jquery-ui-1.11.2/ui/datepicker.js') }}
{{ HTML::script('assets/jquery-ui-1.11.2/demos/datepicker/datepicker-fr.js') }}
<script>
$(document).ready(function() {
    $('#Debutperiode').datepicker( $.datepicker.regional["fr"]);
    $('#Finperiode').datepicker( $.datepicker.regional["fr"] );
    $('#Totalttc').mask('#0.00', {reverse: true});
    $('#Consommation').mask('#', {reverse: true});

    function repoFormatResult(repo) {
      repo.id = repo.CompteurID;
      var markup = '<div class="row">' +
           '<div class="col-lg-3"><i class="fa fa-code-fork"></i> ' + repo.Numero + '</div>' +
           '<div class="col-lg-3"><i class="fa fa-code-fork"></i> ' + repo.Reference + '</div>' +
           '<div class="col-lg-3"><i class="fa fa-star"></i> ' + repo.energie.Nom + '</div>' +
           '<div class="col-lg-3"><a href="' + repo.edit_url + '" class="btn btn-xs btn-success"> <i class="fa fa-edit"></i></a> &nbsp;</div>' +
        '</div>';

      return markup;
    }

    function repoFormatSelection(repo) {
      return 'N°: ' + repo.Numero + ' - Ref: ' + repo.Reference;
    }

    $('#compteur').select2({
        placeholder: "Rechercher un compteur",
        minimumInputLength: 1,
        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
            url: "{{ URL::to('tbge/compteur/select2/ajax') }}",
            dataType: 'json',
            quietMillis: 250,
            data: function (term, page) {
                return {
                    q: term, // search term
                    page: page
                };
            },
            results: function (data, page) { // parse the results into the format expected by Select2.
                // since we are using custom formatting functions we do not need to alter the remote JSON data
                var more = (page * 10) < data.recordsFiltered;
                return { results: data.data, more: more };
            },
            cache: true
        },
        initSelection: function(element, callback) {
            var id = $(element).val();
            if (id !== "") {
                var compteur = {{$facture->Compteur->toJson()}};
                callback(compteur);
            }
        },
        formatResult: repoFormatResult, // omitted for brevity, see the source of this page
        formatSelection: repoFormatSelection,  // omitted for brevity, see the source of this page
        dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
        escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
    });
});
</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Mise-à-jour des informations de la facture </h1>
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
                            {{ Form::model($facture, array('route' => array('tbge.facture.update', $facture->FactureID), 'method' => 'put', 'role' => 'form')) }}
                                <div class="form-group">
                                    <label>Numero de facture</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Compteur associé *</label>
                                    <input type="hidden" class="bigdrop form-control" id="compteur" name="CompteurID" value="{{$facture->compteur->CompteurID}}" />
                                </div>
                                <div class="form-group @if($errors->first('Debutperiode') != '')) has-error @endif">
                                    <label>Du *</label>
                                    <input type="text" name="Debutperiode" id="Debutperiode" value="{{$facture->debutperiode_f}}" class="form-control">
                                    {{ $errors->first('Debutperiode', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group @if($errors->first('Finperiode') != '')) has-error @endif">
                                    <label>Au *</label>
                                    <input type="text" name="Finperiode" id="Finperiode" value="{{$facture->finperiode_f}}" class="form-control">
                                    {{ $errors->first('Finperiode', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group @if($errors->first('Totalttc') != '') has-error @endif">
                                    <label>Cout TTC (MAD) *</label>
                                    {{ Form::text('Totalttc', Input::old('Totalttc'), array('class' => 'form-control', 'placeholder' => "Montant total de la facture en MAD ttc (Abonnement compris)", 'id' => 'Totalttc') ) }}
                                    {{ $errors->first('Totalttc', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group @if($errors->first('Consommation') != '') has-error @endif">
                                    <label>Consommation d’électricité (kWh), d’eau (m3), de carburant (litre) *</label>
                                    {{ Form::text('Consommation', Input::old('Consommation'), array('class' => 'form-control', 'placeholder' => "Consommation totale pour la période", 'id' => 'Consommation') ) }}
                                    {{ $errors->first('Consommation', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Valeur observée du relevé contradictoire</label>
                                    {{ Form::number('ValeurObservation', Input::old('ValeurObservation'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Jour de la saisie du relevé contradictoire</label>
                                    <input type="date" name="DateObservation" value="{{$facture->DateObservation}}" class="form-control">
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