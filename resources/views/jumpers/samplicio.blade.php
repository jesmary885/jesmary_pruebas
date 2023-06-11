@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
<h1 class="text-lg font-weight-bold text-cyan-400 mb-2"> <i class="fas fa-spinner mr-1 text-cyan-400"></i> Samplicio Centiment</h1>



@stop

@section('content')

    @livewire('jumpers.samplicio.samplicio-index') 
    
@stop

