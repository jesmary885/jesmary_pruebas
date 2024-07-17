@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
    <h1 class="text-lg font-weight-bold text-cyan-400"> <i class="fas fa-spinner mr-1 text-cyan-400"></i> K1000 Yoursurveynow</h1>

   
</div>


@stop

@section('content')
    @livewire('admin.yoursurveynow') 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop