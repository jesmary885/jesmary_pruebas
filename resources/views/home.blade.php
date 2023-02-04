@extends('adminlte::page')

@section('content')

 
<div class="row flex mt-2 h-100">
  <div class="col-12 col-sm-6 col-md-3">

  @if($rol != '4')
  <a  href="{{route('marketplace.index')}}" >
    <div class="info-box flex">
        <span class="info-box-icon bg-success elevation-1 flex">
          <i class="fas fa-shopping-cart"></i>
        </span>
        <div class="info-box-content flex">
          <span class="info-box-text">{{__('messages.Mercado')}}</span>
          <span class="info-box-number"></span>
        </div>
    </div>
    </a>
    @else 

    <a  href="#" >
    <div class="info-box flex">
        <span class="info-box-icon bg-success elevation-1 flex">
          <i class="fas fa-shopping-cart"></i>
        </span>
        <div class="info-box-content flex">
          <span class="info-box-text">{{__('messages.Mercado')}}</span>
          <span class="info-box-number"></span>
        </div>
    </div>
    </a>

    @endif


  </div>

  <div class="col-12 col-sm-6 col-md-3">
  @if($rol != '4')
    <a href="{{route('marketplace_compras.index')}}">
      <div class="info-box flex">
        <span class="info-box-icon bg-warning elevation-1 flex">
          <i class="fa fa-shopping-basket text-white">
          </i>
        </span>
        <div class="info-box-content flex">
          <span class="info-box-text">{{__('messages.mis_compras')}}</span>
          <span class="info-box-number"> </span>
        </div>
      </div>
    </a>
    @else 
    <a href="#">
      <div class="info-box flex">
        <span class="info-box-icon bg-warning elevation-1 flex">
          <i class="fas fa-users">
          </i>
        </span>
        <div class="info-box-content flex">
          <span class="info-box-text">{{__('messages.mis_compras')}}</span>
          <span class="info-box-number"> </span>
        </div>
      </div>
    </a>
    @endif
  </div>

  <div class="col-12 col-sm-6 col-md-3">
  @if($rol != '4')
    <a href="{{route('contacts.index')}}">
      <div class="info-box flex">
        <span class="info-box-icon bg-info elevation-1 flex">
          <i class="far fa-address-book">
          </i>
        </span>
        <div class="info-box-content flex">
          <span class="info-box-text">{{__('messages.Mis_contactos')}}</span>
          <span class="info-box-number"></span>
        </div>
      </div>
    </a>
    @else 
    <a href="#">
      <div class="info-box flex">
        <span class="info-box-icon bg-info elevation-1 flex">
          <i class="far fa-address-book">
          </i>
        </span>
        <div class="info-box-content flex">
          <span class="info-box-text">{{__('messages.Mis_contactos')}}</span>
          <span class="info-box-number"></span>
        </div>
      </div>
    </a>
    @endif
  </div>

  <div class="col-12 col-sm-6 col-md-3">
  @if($rol != '4')
  <a href="{{route('chat.index')}}">
    <div class="info-box flex">
      <span class="info-box-icon bg-danger elevation-1 flex">
        <i class="far fa-comment">
        </i>
      </span>
      <div class="info-box-content flex">
        <span class="info-box-text">{{__('messages.Chat')}}</span>
        <span class="info-box-number"> </span>
      </div>
    </div>
    </a>
    @else 
    <a href="#">
    <div class="info-box flex">
      <span class="info-box-icon bg-danger elevation-1 flex">
        <i class="far fa-comment">
        </i>
      </span>
      <div class="info-box-content flex">
        <span class="info-box-text">{{__('messages.Chat')}}</span>
        <span class="info-box-number"> </span>
      </div>
    </div>
    </a>
    @endif
  </div>
  
  @if($rol == '4')
  <div>

  <blockquote class="text-gray-400 flex">
    <p class="mr-1">Su cuenta esta inactiva, reporta tu pago</p>
     @livewire('pagos.reporte-pago') 
     <p class="ml-1"> para disfrutar de los servicios</p>
     
  </blockquote>

  </div>
  @endif

</div>

    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
