@extends('layouts.admin.application', ['noFrame' => true, 'bodyClasses' => 'hold-transition login-page'])

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('title')
    Mail Confirmed
@stop

@section('header')
    Mail Confirmed
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registration Confirmed</div>
                    <div class="panel-body">
                        Your Email is successfully verified. Click here to <a href="{{url('/admin')}}">login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop