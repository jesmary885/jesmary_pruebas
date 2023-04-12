@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
<h1 class="text-lg font-weight-bold text-blue-300"> <i class="fas fa-crown mr-1 text-blue-300"></i> K7341 PREMIUM</h1>


</div>

@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    
    @livewire('jumpers.k7341-p.k7341-index') 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop