@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
    <h1 class="text-lg ml-2"><i class="far fa-address-book"></i> Mis contactos</h1>

</div> 

@stop

@section('content')
    @livewire('contacts.contacts-index') 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop