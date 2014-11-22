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
@extends('templates.login')

{{-- Page title --}}
@section('title') Authentification @stop

{{-- Page specific CSS files --}}
{{-- {{ HTML::style('--Path to css--') }} --}}
@section('css')
    
@stop

{{-- Page specific JS files --}}
{{-- {{ HTML::script('--Path to js--') }} --}}
@section('scripts')

@stop

{{-- Page content --}}
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    {{ Form::open(array('url' => Request::url() , 'id' => 'login',  'role' => 'form' )) }}
                        <fieldset>
                            <div class="form-group">
                                {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'E-mail', 'autofocus' => '' ) ) }}
                                {{ $errors->first('email') }}
                            </div>
                            <div class="form-group">
                                {{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'Password') ) }}
                                {{ $errors->first('password') }}
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            {{ Form::submit('Login', array('class'=>'btn btn-lg btn-success btn-block')) }}
                        </fieldset>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@stop