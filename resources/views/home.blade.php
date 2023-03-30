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

  @if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
  @endif

  <blockquote class="text-gray-400 flex">
    <p class="mr-1">{{__('messages.su_cuenta_inactiva')}}</p>
     @livewire('pagos.reporte-pago') 
     <p class="ml-1"> {{__('messages.para_disfrutar_servicios')}}</p>
     
  </blockquote>

  <blockquote class="text-gray-400 flex">
    <p class="mr-1">Haz click</p>
     @livewire('info-metodos-pago') 
     <p class="ml-1"> {{__('messages.ver_datos_cuentas')}}</p>
     
  </blockquote>

  </div>
  @endif

  @if($mensaje != '' && $rol != '4' && auth()->user()->type != 'gratis')
  <div>

  <blockquote class="text-gray-400 flex">
    <p class="inline">
    {{$mensaje}}
    </p>
   @livewire('pagos.reporte-pago')
     
  </blockquote>

  </div>
  @endif

  <div class="glider-contain mt-2">
            <ul class="glider">
              <video src="/imagenes/K.mp4" autoplay="true" class="mr-2 rounded-md" muted="true" loop="true"></video>
          
              <video src="/imagenes/marketplace.mp4" class="mr-2 rounded-md"  autoplay="true" muted="true" loop="true"></video>

              <video src="/imagenes/comunidad.mp4" class="mr-2 rounded-md" autoplay="true" muted="true" loop="true"></video>

              <video src="/imagenes/contactos.mp4" class="mr-2 rounded-md" autoplay="true" muted="true" loop="true"></video>
            </ul>
        
            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
  </div> 

</div>

    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

<script>
            window.addEventListener('load', function(){
                new Glider(document.querySelector('.glider'), {
                slidesToShow: 2, //cant de registros que se muestran
                slidesToScroll: 1, //los saltos que se dan al darle click a los botones
                draggable: true,
                dots: '.dots',
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                },

                responsive:[
                    {
                        breakpoint: 640,
                        settings:{
                            slidesToShow: 1, 
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings:{
                            slidesToShow: 2, 
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings:{
                            slidesToShow: 2, 
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 1280,
                        settings:{
                            slidesToShow: 2, 
                            slidesToScroll: 2,
                        }
                    },
                ]
                });
                
            })

      
        </script>



@stop
