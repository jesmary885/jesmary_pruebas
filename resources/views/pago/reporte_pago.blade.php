@extends('adminlte::page')

@section('content_header')
    
@stop

@section('content')
 @livewire('pagos.reporta-pago-adelantado',['isopen' => $isopen]) 
@stop

@section('css')

@stop

@section('js')

@stop