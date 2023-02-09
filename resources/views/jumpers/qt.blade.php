@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
    <h1 class="text-lg text-red-500 font-weight-bold"><i class=" text-red-500 mr-1 fas fa-cloud"></i>QuickThoughts</h1>

   
</div>

@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

   
    @livewire('jumpers.qt.qt-index',['search' => $search]) 
  
@stop

@section('css')
      <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop