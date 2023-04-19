@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
    <h1 class="text-lg font-weight-bold text-cyan-400"> <i class="fas fa-spinner mr-1 text-cyan-400"></i> SALTADOR WIX</h1>

   
</div>

@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    
    @livewire('jumpers.wix') 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop