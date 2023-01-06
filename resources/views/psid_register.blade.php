@extends('adminlte::page')

@section('content_header')
    
@stop

@section('content')
 @livewire('psid.register',['isopen' => $isopen]) 
@stop

@section('css')

@stop

@section('js')

@stop
