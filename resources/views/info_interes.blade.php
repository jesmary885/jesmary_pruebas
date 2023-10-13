@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
</div>

@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    
  
    @livewire('info-metodos-pago',['isopen' => $isopen]) 

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop








