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
@section('title') Créer un poste de production @stop

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
    $('#compteurElectricitesSelect2').select2({
        allowClear: true,
        closeOnSelect : false
    });
    $('#compteurEauxSelect2').select2({
        allowClear: true,
        closeOnSelect : false
    });
    $('#categorieSelect2').select2({
        allowClear: true,
        closeOnSelect : false
    });

    $('.forage').hide();
    $('.equipement-chaleur').hide();
    $('.gpe-frigorifique').hide();
    $('.gpe-electrogene').hide();

    $('#TypeSelect').on('change', function(){
        var selectedValue = "forage";
        $('#TypeSelect option:selected').each(function() {
          selectedValue = $( this ).text();
        });

        $('.forage').hide();
        $('.equipement-chaleur').hide();
        $('.gpe-frigorifique').hide();
        $('.gpe-electrogene').hide();

        if(selectedValue == "Forage"){
            selectedValue = "forage";
        }else if(selectedValue == "Équipement de production de chaleur"){
            selectedValue = "equipement-chaleur";
        }if(selectedValue == "Groupe frigorifique"){
            selectedValue = "gpe-frigorifique";
        }if(selectedValue == "Groupe électrogène / Équipement de production d’électricité"){
            selectedValue = "gpe-electrogene";
        }

        $('.'+selectedValue).show();
    });

    $('#TypeSelect').change();

});
</script>
@stop

{{-- Page content --}}
@section('content')

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Créer un poste de production </h1>
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
                            {{ Form::open(array('url' => URL::to('tbge/patrimoine/posteproduction') , 'role' => 'form')) }}
                                <div class="form-group">
                                    <label>Numéro d’identification du poste</label>
                                    {{ Form::text('Reference', Input::old('Reference'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group @if($errors->first('Nom') != '') has-error @endif">
                                    <label>Nom/Description du poste *</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'autofocus' => '' ) ) }}
                                    {{ $errors->first('Nom', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Compteur(s) d’électricité associé(s)</label>
                                    <select id="compteurElectricitesSelect2" name="compteurElectricitesID[]" class="form-control" multiple>
                                        @if(count($compteurElectricites) > 0)
                                            <optgroup label="Compteurs d'électricité">
                                            @foreach($compteurElectricites as $key => $value)
                                                <option value="{{$value->CompteurID}}">{{'N°: ' . $value->Numero . ' | Ref: ' . $value->Reference}}</option>
                                            @endforeach
                                            </optgroup>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Compteurs d’eau associés</label>
                                    <select id="compteurEauxSelect2" name="compteurEauxID[]" class="form-control" multiple>
                                        @if(count($compteurEaux) > 0)
                                            <optgroup label="Compteurs d'eau">
                                            @foreach($compteurEaux as $key => $value)
                                                <option value="{{$value->CompteurID}}">{{'N°: ' . $value->Numero . ' | Ref: ' . $value->Reference}}</option>
                                            @endforeach
                                            </optgroup>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Type de produits</label>
                                    {{ Form::select('Energie', $energies, Input::old('Energie'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Catégorie du poste de production</label>
                                    {{ Form::select('Type', $types, Input::old('Type'), array('id' => 'TypeSelect', 'class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label class="forage">Puissance de la pompe</label>
                                    <label class="equipement-chaleur  gpe-frigorifique gpe-electrogene">Puissance utile de l'équipement (kWh)</label>
                                    {{ Form::number('Puissance', Input::old('Puissance'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label class="forage">Nombre d'heures de pompages par mois</label>
                                    <label class="equipement-chaleur gpe-frigorifique gpe-electrogene">Nombre d’heures de fonctionnement par mois</label>
                                    {{ Form::number('NbrHeureFct', Input::old('NbrHeureFct'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group forage">
                                    <label>Quantité d'eau pompée par mois</label>
                                    {{ Form::number('QteEauPompeMois', Input::old('QteEauPompeMois'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group equipement-chaleur  gpe-frigorifique gpe-electrogene">
                                    <label>Modèle et marque</label>
                                    {{ Form::text('ModeleMarqueEquipement', Input::old('ModeleMarqueEquipement'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Latitude</label>
                                    {{ Form::number('Latitude', Input::old('Latitude'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Longitude</label>
                                    {{ Form::number('Longitude', Input::old('Longitude'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Année de mise en service</label>
                                    {{ Form::number('Anneeconstruction', Input::old('Anneeconstruction'), array('class' => 'form-control') ) }}
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