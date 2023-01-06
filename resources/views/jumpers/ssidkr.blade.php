@extends('adminlte::page')
@section('content_header')

<div class="flex justify-between">
    
    <h1 class="text-lg ml-2 text-light font-weight-bold">SSI DKR</h1>

   
</div>

@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif

   
    @livewire('jumpers.ssidkr.ssidkr-index',['jumper'=>$jumper, 'link_complete' => $link_complete]) 
  
@stop

@section('css')
      <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop