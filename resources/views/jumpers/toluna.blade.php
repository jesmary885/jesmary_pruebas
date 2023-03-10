@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
<h1 class="text-lg font-weight-bold text-blue-300"> <i class="fas fa-asterisk mr-1 text-blue-300"></i> TOLUNA</h1>

    <div class="justify-end">
       {{-- @livewire('jumpers.cint.cint-create') --}}
    </div>
</div>

@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

    <div class="flex justify-center">
    <h2 class="mt-4 text-gray-200 font-bold">*** PRÓXIMAMENTE ***</h2>

    </div>

    
    
    @livewire('jumpers.toluna.toluna-index') 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop