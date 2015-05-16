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
@section('title') Créer une facture @stop

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
            <h1 class="page-header">Créer une facture </h1>
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
                            {{ Form::open(array('url' => URL::to('facture') , 'role' => 'form')) }}
                                
                            <fieldset>
                                <legend>Consommation pour cette période</legend>

                                <div class="form-group">
                                    <label>Maitre d'ouvrage</label>
                                    {{  Form::select('MouvrageID', $mos, Input::old('MouvrageID'), array('class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Compteur</label>
                                    <select id="compteur" name="CompteurID" class="form-control">
                                        @if(count($compteurs['batiment']) > 0)
                                       <optgroup label="Compteurs de bâtiments">
                                            @foreach($compteurs['batiment'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{$value->Nom . ' - ' . $value->Patrimoine}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif

                                        @if(count($compteurs['vehicule']) > 0)
                                       <optgroup label="Compteurs de véhicules">
                                            @foreach($compteurs['vehicule'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{$value->Nom . ' - ' . $value->Patrimoine}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif

                                        @if(count($compteurs['eclairage']) > 0)
                                       <optgroup label="Compteurs d'éclairages">
                                            @foreach($compteurs['eclairage'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{$value->Nom . ' - ' . $value->Patrimoine}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif

                                        @if(count($compteurs['posteproduction']) > 0)
                                       <optgroup label="Compteurs de postes de production">
                                            @foreach($compteurs['posteproduction'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{$value->Nom . ' - ' . $value->Patrimoine}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endif

                                        @if(count($compteurs['autreposte']) > 0)
                                       <optgroup label="Compteurs de postes (autres)">
                                            @foreach($compteurs['autreposte'] as $key => $value)
                                                <option value="{{$value->CompteurID}}" @if(Input::old('CompteurID') === $value->CompteurID) selected="selected" @endif>{{$value->Nom . ' - ' . $value->Patrimoine}}</option>
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
                                    {{ Form::number('Totalttc', Input::old('Totalttc'), array('class' => 'form-control', 'placeholder' => "Montant total de la facture en MAD TTC (Abonnement compris)") ) }}
                                    {{ $errors->first('Totalttc', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group @if($errors->first('Consommation') != '')) has-error @endif">
                                    <label>Consommation *</label>
                                    {{ Form::number('Consommation', Input::old('Consommation'), array('class' => 'form-control', 'placeholder' => "Consommation totale pour la période") ) }}
                                    {{ $errors->first('Consommation', '<span class="error">:message</span>' ) }}
                                </div>
                                <div class="form-group">
                                    <label>Estimation</label>
                                    {{ Form::checkbox('Estimation', Input::old('Estimation') ) }}
                                    Cocher si la facture est basée sur une estimation, et pas un relevé réel
                                </div>
                                <div class="form-group">
                                    <label>Fournisseur</label>
                                    {{ Form::select('FournisseurID', $fournisseurs, Input::old('FournisseurID'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Abonnement</label>
                                    {{ Form::number('Abonnement', Input::old('Abonnement'), array('class' => 'form-control', 'placeholder' => "Part de l'abonnement en MAD (indicatif)") ) }}
                                </div>
                                
                            </fieldset>
                            <fieldset>
                                <legend>Facture d'Electricité détaillée</legend>

                                <div class="form-group">
                                    <label>HP</label>
                                    {{ Form::number('Consohpleines', Input::old('Consohpleines'), array('class' => 'form-control', 'placeholder' => "Consommation heures pleines") ) }}
                                </div>
                                <div class="form-group">
                                    <label>HC</label>
                                    {{ Form::number('Consohcreuses', Input::old('Consohcreuses'), array('class' => 'form-control', 'placeholder' => "Consommation heures creuses") ) }}
                                </div>
                                <div class="form-group">
                                    <label>HPH</label>
                                    {{ Form::number('Consophiver', Input::old('Consophiver'), array('class' => 'form-control', 'placeholder' => "Consommation hiver") ) }}
                                </div>
                                <div class="form-group">
                                    <label>HCH</label>
                                    {{ Form::number('Consochiver', Input::old('Consochiver'), array('class' => 'form-control', 'placeholder' => "Consommation hiver") ) }}
                                </div>
                                <div class="form-group">
                                    <label>HPE</label>
                                    {{ Form::number('Consopete', Input::old('Consopete'), array('class' => 'form-control', 'placeholder' => "Consommation été") ) }}
                                </div>
                                <div class="form-group">
                                    <label>HCE</label>
                                    {{ Form::number('Consocete', Input::old('Consocete'), array('class' => 'form-control', 'placeholder' => "Consommation été") ) }}
                                </div>
                                <div class="form-group">
                                    <label>HN</label>
                                    {{ Form::number('HN', Input::old('HN'), array('class' => 'form-control', 'placeholder' => "EJP : Heures Normales") ) }}
                                </div>
                                <div class="form-group">
                                    <label>HPM</label>
                                    {{ Form::number('HPM', Input::old('HPM'), array('class' => 'form-control', 'placeholder' => "EJP : Heures Pointes Mobiles") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Nom/numero de facture</label>
                                    {{ Form::text('Nom', Input::old('Nom'), array('class' => 'form-control', 'placeholder' => "Facultatif - Sert pour le classement") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Commentaires</label>
                                    {{ Form::textarea('Commentaire', Input::old('Commentaire'), array('class' => 'form-control', 'placeholder' => "Facultatif - Sert pour le classement") ) }}
                                </div>

                            </fieldset>
                            <fieldset>
                                <legend>Tarif Jaune/Vert</legend>
                                
                                <div class="form-group">
                                    <label>Consommation Pointe (Tarif vert)</label>
                                    {{ Form::number('Consopointe', Input::old('Consopointe'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="form-group">
                                    <label>Puissance atteinte pointe</label>
                                    {{ Form::number('Patteintepointe', Input::old('Patteintepointe'), array('class' => 'form-control', 'placeholder' => "") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Puissance atteinte heures pleines</label>
                                    {{ Form::number('Patteintehp', Input::old('Patteintehp'), array('class' => 'form-control', 'placeholder' => "") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Puissance atteinte heures creuses</label>
                                    {{ Form::number('Patteintehc', Input::old('Patteintehc'), array('class' => 'form-control', 'placeholder' => "") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Energie active heures pleines</label>
                                    {{ Form::number('Eactivehp', Input::old('Eactivehp'), array('class' => 'form-control', 'placeholder' => "") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Energie active heures creuses</label>
                                    {{ Form::number('Eactivehc', Input::old('Eactivehc'), array('class' => 'form-control', 'placeholder' => "") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Energie réactive</label>
                                    {{ Form::number('Ereactive', Input::old('Ereactive'), array('class' => 'form-control', 'placeholder' => "") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Tangeante</label>
                                    {{ Form::number('Tangeante', Input::old('Tangeante'), array('class' => 'form-control', 'placeholder' => "") ) }}
                                </div>

                            </fieldset>
                            <fieldset>
                                <legend>Facture de Bois détaillée</legend>
                                
                                <div class="form-group">
                                    <label>Hygro</label>
                                    {{ Form::number('Hygro', Input::old('Hygro'), array('class' => 'form-control', 'placeholder' => "") ) }}
                                </div>
                                <div class="form-group">
                                    <label>Coefficient</label>
                                    {{ Form::number('Coefficient', Input::old('Coefficient'), array('class' => 'form-control', 'placeholder' => "") ) }}
                                </div>
                                
                                </fieldset>

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