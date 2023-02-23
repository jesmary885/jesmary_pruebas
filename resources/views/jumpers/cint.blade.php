@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
<h1 class="text-lg font-weight-bold text-blue-300"> <i class="fas fa-asterisk mr-1 text-blue-300"></i> CINT</h1>

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
    
    @livewire('jumpers.cint.cint-index') 

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop