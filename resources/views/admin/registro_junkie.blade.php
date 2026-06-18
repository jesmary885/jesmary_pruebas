@extends('adminlte::page')
@section('content_header')

@stop

@section('content')
    @livewire('admin.registro-junkie') 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop