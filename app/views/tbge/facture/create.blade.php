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
@section('title') Ajouter une facture @stop

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
    $('#compteur').select2({
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
            <h1 class="page-header">Ajouter une facture </h1>
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
                            {{ Form::open(array('url' => URL::to('tbge/facture') , 'role' => 'form')) }}
                                <div class="form-group">
                                    <label>Numero de facture *</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'placeholder' => "Facultatif - Sert pour le classement") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Compteur associé *</label>
                                    <select id="compteur" name="CompteurID" class="form-control">

                                        @if(count($compteurs['eclairage']) > 0)
                                        <optgroup label="Compteurs d'éclairages">
                                            @foreach($compteurs['eclairage'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{'N°: ' . $value->Numero . ' - Ref: ' . $value->Reference . ' - Patrimoine: ' . $value->Patrimoine}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif

                                        @if(count($compteurs['vehicule']) > 0)
                                        <optgroup label="Compteurs de véhicules">
                                            @foreach($compteurs['vehicule'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{'N°: ' . $value->Numero . ' - Ref: ' . $value->Reference . ' - Patrimoine: ' . $value->Patrimoine}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif

                                        @if(count($compteurs['batiment']) > 0)
                                        <optgroup label="Compteurs de bâtiments">
                                            @foreach($compteurs['batiment'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{'N°: ' . $value->Numero . ' - Ref: ' . $value->Reference . ' - Patrimoine: ' . $value->Patrimoine}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif

                                        @if(count($compteurs['arriveeau']) > 0)
                                        <optgroup label="Compteurs de points d'arrivée d'eau">
                                            @foreach($compteurs['arriveeau'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{'N°: ' . $value->Numero . ' - Ref: ' . $value->Reference . ' - Patrimoine: ' . $value->Patrimoine}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif

                                        @if(count($compteurs['espacevert']) > 0)
                                        <optgroup label="Compteurs d'espace vert">
                                            @foreach($compteurs['espacevert'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{'N°: ' . $value->Numero . ' - Ref: ' . $value->Reference . ' - Patrimoine: ' . $value->Patrimoine}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif


                                        @if(count($compteurs['posteproduction']) > 0)
                                       <optgroup label="Compteurs de postes de production">
                                            @foreach($compteurs['posteproduction'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{'N°: ' . $value->Numero . ' - Ref: ' . $value->Reference . ' - Patrimoine: ' . $value->Patrimoine}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif

                                        @if(count($compteurs['autreposte']) > 0)
                                       <optgroup label="Compteurs de postes (autres)">
                                            @foreach($compteurs['autreposte'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{'N°: ' . $value->Numero . ' - Ref: ' . $value->Reference . ' - Patrimoine: ' . $value->Patrimoine}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif

                                        @if(count($compteurs['tous']) > 0)
                                       <optgroup label="Tous les compteurs">
                                            @foreach($compteurs['tous'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{'N°: ' . $value->Numero . ' - Ref: ' . $value->Reference}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group @if($errors->first('Debutperiode') != '')) has-error @endif">
                                    <label>Du *</label>
                                    <input type="date" name="Debutperiode" value="{{Input::old('Debutperiode')}}" class="form-control">
                                    {{ $errors->first('Debutperiode', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group @if($errors->first('Finperiode') != '')) has-error @endif">
                                    <label>Au *</label>
                                    <input type="date" name="Finperiode" value="{{Input::old('Finperiode')}}" class="form-control">
                                    {{ $errors->first('Finperiode', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group @if($errors->first('Totalttc') != '')) has-error @endif">
                                    <label>Cout TTC *</label>
                                    {{ Form::number('Totalttc', Input::old('Totalttc'), array('class' => 'form-control', 'placeholder' => "Montant total de la facture en MAD ttc (Abonnement compris)") ) }}
                                    {{ $errors->first('Totalttc', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group @if($errors->first('Consommation') != '')) has-error @endif">
                                    <label>Consommation d’électricité (kWh et MAD), d’eau (m3 et MAD), de carburant (l et MAD) *</label>
                                    {{ Form::number('Consommation', Input::old('Consommation'), array('class' => 'form-control', 'placeholder' => "Consommation totale pour la période") ) }}
                                    {{ $errors->first('Consommation', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Valeur observée du relevé contradictoire</label>
                                    {{ Form::number('ValeurObservation', Input::old('ValeurObservation'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Jour de la saisie du relevé contradictoire</label>
                                    <input type="date" name="DateObservation" value="{{Input::old('DateObservation')}}" class="form-control">
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