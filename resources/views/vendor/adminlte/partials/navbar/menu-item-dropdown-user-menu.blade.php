@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@if (config('adminlte.usermenu_profile_url', false))
    @php( $profile_url = Auth::user()->adminlte_profile_url() )
@endif

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

<li class="nav-item dropdown">

    {{-- User menu toggler --}}
    <div class="d-none d-lg-block">
        <a href="#" class="nav-link dropdown-toggle text-gray-800 font-semibold " data-toggle="dropdown">
            @if(session('locale'))
                @if(session('locale') == "es")
                    <span>
                        {{__('messages.Idioma')}} : Español
                    </span>
                @else
                <span>
                    {{__('messages.Idioma')}} : English
                </span>
                @endif
            @else
                <span>
                {{__('messages.Idioma')}} : Español
                </span>
            @endif
        </a>

        <ul class="dropdown-menu">
            @livewire('idioma.cambiar-idioma')
        </ul>

    </div>
    
    <li class="nav-item dropdown d-none d-md-block">
        <a href="#" class="nav-link dropdown-toggle text-gray-800 font-semibold" data-toggle="dropdown">
            @if(session('psid'))
                <span class=" text-cyan-500 font-bold">
                    PSID o perfil : {{session('psid')}}
                </span>
            @else
            PSID o perfil: No registrado 
            @endif
        </a>
        <ul class="dropdown-menu">
            @if(auth()->user()->roles->first()->id != 4)
                @if(session('psid'))
                    <a class="block dropdown-item text-decoration-none" href="{{route('registro.psid')}}"> <span class=" text-gray-300 font-bold">Cambiar PSID </span></a> 
                    <a class="block dropdown-item text-decoration-none" href="{{route('limpiar.psid')}}"> <span class=" text-gray-300 font-bold"> Limpiar </span></a> 
                  
                @else
                    <a class="block dropdown-item " href="{{route('registro.psid')}}"><span class=" text-gray-300 font-bold"> Registrar PSID </span> </a> 
                @endif
            @else
                <a class="block dropdown-item " href="#"> Su cuenta esta inactiva </a> 
            @endif
        </ul>
    </li>

    <li class="nav-item dropdown d-none d-md-block">
        <a href="#" class="nav-link dropdown-toggle text-gray-800 font-semibold" data-toggle="dropdown">
            @if(session('pid'))
                <span class="text-cyan-500 font-bold">
                    PID : {{session('pid')}}
                </span>
            @else
            PID: No registrado 
            @endif
        </a>
        <ul class="dropdown-menu">
        @if(auth()->user()->roles->first()->id != 4)
            @if(session('pid'))
                <a class="block dropdown-item " href="{{route('registro.pid')}}"> <span class=" text-gray-300 font-bold">Cambiar PID </span></a> 
                <a class="block dropdown-item " href="{{route('limpiar.pid')}}"> <span class=" text-gray-300 font-bold">Limpiar</span></a> 
            @else
                <a class="block dropdown-item " href="{{route('registro.pid')}}"> <span class=" text-gray-300 font-bold">Registrar PID</span> </a> 
            @endif
        @else
                <a class="block dropdown-item " href="#"> Su cuenta esta inactiva </a> 
        @endif
        </ul>
    </li>

</li>

<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge"> @livewire('chat.msjs-to-read')</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

    <div class="dropdown-divider"></div>

        <div class="dropdown-divider"></div>
        @if(auth()->user()->roles->first()->id != 4)
            <a href="{{route('chat.index')}}" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
        @else
            <a class="block dropdown-item " href="#"> Su cuenta esta inactiva </a> 
        @endif
    </div>
</li>

@if(auth()->user()->roles->first()->id == 1)
<li class="nav-item dropdown">
     <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-danger navbar-badge"> @livewire('admin.pagos-pendientes')</span>
    </a> 
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

    <div class="dropdown-divider"></div>

        <div class="dropdown-divider"></div>
       
            <a href="{{route('admin.pagos')}}" class="dropdown-item dropdown-footer">Ver todos</a>
   
    </div>
</li>
@endif

<li class="nav-item dropdown user-menu">

    {{-- User menu toggler --}}
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        @if(config('adminlte.usermenu_image'))
            <img src="{{ Auth::user()->adminlte_image() }}"
                 class="user-image img-circle elevation-2"
                 alt="{{ Auth::user()->name }}">
        @endif
        <span @if(config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
            {{ Auth::user()->name }}
        </span>
    </a>

    {{-- User menu dropdown --}}
    <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">

        <li class="user-footer">

            <a href="{{ route('informacion') }}" class="btn btn-default btn-flat btn-block">
                <i class="	fas fa-info text-cyan-500 mr-2"></i>
                {{__('messages.informacion_interes')}}
            </a>
    
        <a href="{{ route('reporte_pago') }}" class="btn btn-default btn-flat btn-block">
                <i class="far fa-credit-card text-cyan-500 mr-2"></i>
                Reportar pago
        </a>

        <a href="{{ route('ver_links_generados') }}" class="btn btn-default btn-flat btn-block">
            <i class="	fas fa-redo-alt text-cyan-500 mr-2"></i>
                Jumpers generados
        </a>


            <a href="{{ route('profile.show') }}" class="btn btn-default btn-flat btn-block">
                    <i class="fa fa-fw fa-user text-red"></i>
                    {{ __('adminlte::menu.profile') }}
            </a>


            <a href="{{ route('logout.perform') }}" class="btn btn-default btn-flat float-right  btn-block">
                    <i class="fa fa-fw fa-power-off text-red"></i>
                    {{ __('adminlte::adminlte.log_out') }}
            </a>
        </li>

    </ul>

</li>