@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
<h1 class="text-lg font-weight-bold text-cyan-400"> <i class="fas fa-spinner mr-1 text-cyan-400"></i> Samplicio</h1>

    <div class="justify-end">
       {{-- @livewire('jumpers.cint.cint-create') --}}
    </div>
</div>

@stop

@section('content')

<div class=" grid grid-cols-3 gap-2 content-start mt-2 mb-4">
  <div class="bg-info text-gray-500 font-bold text-sm p-1 rounded-sm ">App.glimpsehere.com</div>
  <div class="bg-info text-gray-500 font-bold text-sm p-1 rounded-sm ">Enter.ipsosinteractive.com</div>
  <div class="bg-info text-gray-500 font-bold text-sm p-1 rounded-sm ">Surveys.com</div>
  <div class="bg-info text-gray-500  font-bold text-sm p-1 rounded-sm ">Surveyconnect.com</div>
  <div class="bg-info text-gray-500  font-bold text-sm p-1 rounded-sm ">App.enlight.ly</div>
  <div class="bg-info text-gray-500  font-bold text-sm p-1 rounded-sm ">Aurvey4.panelviewpoint.com</div>
  <div class="bg-info text-gray-500  font-bold text-sm p-1 rounded-sm ">Eu3.intellisurvey.com</div>
  <div class="bg-info text-gray-500  font-bold text-sm p-1 rounded-sm ">Ib1.intellisurvey.com</div>
  <div class="bg-info text-gray-500  font-bold text-sm p-1 rounded-sm ">Answerup.io</div>
</div>

   
    @livewire('jumpers.samplicio.samplicio-index-poderoso') 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop