@extends('adminlte::page')

@section('content_header')
    
@stop

@section('content')
 @livewire('pid.register',['isopen' => $isopen]) 
@stop

@section('css')

@stop

@section('js')

@stop