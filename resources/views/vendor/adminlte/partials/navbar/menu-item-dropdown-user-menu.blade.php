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
                <span class="text-green-600">
                    PSID o perfil : {{session('psid')}}
                </span>
            @else
            PSID o perfil: No registrado 
            @endif
        </a>
        <ul class="dropdown-menu">
            @if(auth()->user()->roles->first()->id != 4)
                @if(session('psid'))
                    <a class="block dropdown-item " href="{{route('registro.psid')}}"> Cambiar PSID </a> 
                    <a class="block dropdown-item " href="{{route('limpiar.psid')}}"> Limpiar</a> 
                  
                @else
                    <a class="block dropdown-item " href="{{route('registro.psid')}}"> Registrar PSID </a> 
                @endif
            @else
                <a class="block dropdown-item " href="#"> Su cuenta esta inactiva </a> 
            @endif
        </ul>
    </li>

    <li class="nav-item dropdown d-none d-md-block">
        <a href="#" class="nav-link dropdown-toggle text-gray-800 font-semibold" data-toggle="dropdown">
            @if(session('pid'))
                <span class="text-blue-600">
                    PID : {{session('pid')}}
                </span>
            @else
            PID: No registrado 
            @endif
        </a>
        <ul class="dropdown-menu">
        @if(auth()->user()->roles->first()->id != 4)
            @if(session('pid'))
                <a class="block dropdown-item " href="{{route('registro.pid')}}"> Cambiar PID </a> 
                <a class="block dropdown-item " href="{{route('limpiar.pid')}}"> Limpiar</a> 
            @else
                <a class="block dropdown-item " href="{{route('registro.pid')}}"> Registrar PID </a> 
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
        <a href="{{ route('reporte_pago') }}" class="btn btn-default btn-flat btn-block">
                    <i class="far fa-credit-card text-green mr-2"></i>
                    Reportar pago
            </a>

            <a href="{{ route('profile.show') }}" class="btn btn-default btn-flat btn-block">
                    <i class="fa fa-fw fa-user text-lightblue"></i>
                    {{ __('adminlte::menu.profile') }}
            </a>

            

            <a class="btn btn-default btn-flat float-right  btn-block"
               href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off text-red"></i>
                {{ __('adminlte::adminlte.log_out') }}
            </a>

            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                @if(config('adminlte.logout_method'))
                    {{ method_field(config('adminlte.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>

        </li>

    </ul>

</li>