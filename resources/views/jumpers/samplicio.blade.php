@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
<h1 class="text-lg font-weight-bold text-cyan-400 mb-2"> <i class="fas fa-spinner mr-1 text-cyan-400"></i> Samplicio</h1>



@stop

@section('content')
<!-- 
<div class=" grid grid-cols-3 gap-2 content-start mt-2 mb-4">
  <div class="bg-info text-gray-500 font-bold text-sm p-1 rounded-sm ">Centiment</div>

</div> -->

   
    @livewire('jumpers.samplicio.samplicio-index') 
@stop

