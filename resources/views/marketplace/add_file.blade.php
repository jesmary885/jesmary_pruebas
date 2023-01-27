@extends('adminlte::page')
@section('content_header')

@stop

@section('content')
    
    @livewire('marketplace.carga-imagenes',['marketplace'=>$marketplace])

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop