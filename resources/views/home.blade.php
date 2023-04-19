@extends('adminlte::page')

@section('content')

 
<div class="row flex mt-2 h-100">
  <div class="col-12 col-sm-6 col-md-3">

    @if($rol != '4')
    <a  href="{{route('marketplace.index')}}" >
    <div class="info-box flex">
        <span class="info-box-icon bg-info elevation-1 flex">
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
        <span class="info-box-icon bg-info elevation-1 flex">
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
        <span class="info-box-icon bg-danger elevation-1 flex">
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
        <span class="info-box-icon bg-danger elevation-1 flex">
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

    <div class="ml-4 mr-4 mb-2 @container w-full">
      <div class="callout callout-info">

          <div class="text-gray-400 flex">
            @if($pago_registrado < 1)
              <p class="mr-1">{{__('messages.su_cuenta_inactiva')}}</p>
            
              @livewire('pagos.reporte-pago') 
                <p class="ml-1"> {{__('messages.para_disfrutar_servicios')}}</p>
            @endif
            
          </div>

          <div class="text-gray-400 flex">
            <p class="mr-1">Haz click</p>
            @livewire('info-planes') 
            <p class="ml-1"> {{__('messages.ver_datos_precios')}}</p>
            
          </div>

          <div class="text-gray-400 flex">
            <p class="mr-1">Haz click</p>
            @livewire('info-metodos-pago') 
            <p class="ml-1"> {{__('messages.ver_datos_cuentas')}}</p>
            
          </div>

        </div>
    </div>

  @endif

  @if($rol == '4')
  <div class="ml-4 mr-4 mb-2 @container w-full">   

    @if (session('info'))
      <div class="alert alert-info bg-info">
          <strong>{{session('info')}}</strong>
      </div>
    @endif

  </div>
  @endif

   @if($mensaje != '' && $rol != '4' && auth()->user()->type != 'gratis')
   
  <div class="ml-4 mr-4 mb-2 @container w-full">

      <div class="callout callout-info">

      @if($pago_registrado < 1)

        <div class="text-gray-400 flex">
          <p class="inline">
          {{$mensaje}}
          </p>
        @livewire('pagos.reporte-pago')
          
        </div>

      @endif

        <div class="text-gray-400 flex">
          <p class="mr-1">Haz click</p>
          @livewire('info-planes') 
          <p class="ml-1"> {{__('messages.ver_datos_precios')}}</p>
          
        </div>

        <div class="text-gray-400 flex">
          <p class="mr-1">Haz click</p>
          @livewire('info-metodos-pago') 
          <p class="ml-1"> {{__('messages.ver_datos_cuentas')}}</p>
          
        </div>
       
      </div>

    </div>
   
  @endif

  <section class="ml-4 mr-4 @container w-full">
      <div class="card card-solid ">

        <div class="card-body">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
           
            <div >
              <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch flex-column">
                <div class="card bg-light d-flex flex-fill">
                  <div class="card-header text-muted border-bottom-0">
                  {{__('messages.HOLA')}}, {{$user->username}}
                  </div>
                </div>
                <div class="card-body  pt-0">
                  <div class="row">
                    <div class="col-10">
                    
                      {{-- <h2 class="font-semibold mb-4"><b>{{__('messages.datos_registrados')}}:</b></h2> --}}
   
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-address-book text-cyan-500 font-bold"></i></span> Telegram ID: {{$user->telegram}} </li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-laptop-code text-cyan-500 font-bold"></i></span> {{__('messages.direccion_ip')}}: {{$ip_user}} </li>
                        @if(($user->last_payment_date))
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-clock text-cyan-500 font-bold"></i></span> {{__('messages.fecha_corte')}}: {{\Carbon\Carbon::parse($user->last_payment_date)->format('d-m-Y')}} </li>
                        @endif
                        <li class="medium mt-2"><span class="fa-li"><i class="	fas fa-lg fa-money-bill-wave text-cyan-500 font-bold"></i></span> Saldo en página: {{$user->balance}} $ </li>
                      </ul>
                      <hr class="m-2 ">

                      <h2 class="mb-2 text-gray-200 font-bold "><b>Información del día:</b></h2>

                      <ul class="ml-4 mb-0 fa-ul text-muted">

                      <li class="medium mt-2"><span class="fa-li"><i class="	fas fa-lg fa-money-bill-wave text-cyan-500 font-bold"></i></span> Tasa de cambio: 1$ = {{$tasa_dia_dolar}} Bs. - 1LTC = {{$tasa_dia_ltc}} $  </li>
                      </ul>

                    </div>
                    <div class="col-2 text-center">
                      <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="rounded-full h-20 w-20 object-cover">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div>
              <div class="flexslider">
                <ul class="slides">
                  <li>
                    <video src="/imagenes/K.mp4" autoplay="true" class="h-full" muted="true" loop="true"></video>
                  </li>
                  <li>
                    <video src="/imagenes/marketplace.mp4" class="h-full" autoplay="true" muted="true" loop="true"></video>
                  </li>

                  <li>
                    <video src="/imagenes/comunidad.mp4" class="h-full" autoplay="true" muted="true" loop="true"></video>
                  </li>

                  <li>
                    <video src="/imagenes/contactos.mp4" class="h-full" autoplay="true" muted="true" loop="true"></video>
                  </li>
                </ul>

                <div class="custom-navigation">
  
                  <div class="custom-controls-container"></div>
         
                </div>

              </div>

            </div>

          </div>
        </div>

      </div>


</section>
  
  

  

</div>







@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">

    <link rel="stylesheet" href="{{ asset('vendor/FlexSlider/flexslider.css') }}">
@stop

@push('script')
{{-- jquery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        {{-- FlexSlider --}}
        <script src="{{ asset('vendor/FlexSlider/jquery.flexslider-min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlsContainer: $(".custom-controls-container"),
                    customDirectionNav: $(".custom-navigation a")
                });
            });

        </script>

@endpush
