<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

        @if(config('adminlte.google_fonts.allowed', true))
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        @endif
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
        <link rel="manifest" crossorigin="use-credentials" href="{{ asset('favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    @endif

    {{-- dropzone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">

    {{-- Glider --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.css" integrity="sha512-YM6sLXVMZqkCspZoZeIPGXrhD9wxlxEF7MzniuvegURqrTGV2xTfqq1v9FJnczH+5OGFl5V78RgHZGaK34ylVg==" crossorigin="anonymous" />

    {{-- FlexSlider --}}
    <link rel="stylesheet" href="{{ asset('vendor/FlexSlider/flexslider.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    {{-- datetimepicker --}}
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">   
    <script src="https://unpkg.com/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>

    {{-- flatpickr--}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- dropzone --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>

    {{-- Glider --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.js" integrity="sha512-tHimK/KZS+o34ZpPNOvb/bTHZb6ocWFXCtdGqAlWYUcz+BGHbNbHMKvEHUyFxgJhQcEO87yg5YqaJvyQgAEEtA==" crossorigin="anonymous"></script>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- FlexSlider --}}
    <script src="{{ asset('vendor/FlexSlider/jquery.flexslider-min.js') }}"></script>

    



</head>

<body class="@yield('classes_body')" @yield('body_data')>

    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif

    @stack('script')

     

    <script>
        livewire.on('error', function(ms){
            toastr.options={
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1500",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr.error(ms)
        })
    </script>

    <script>
        livewire.on('confirm', (ms,item1,item2,ms2) => {
            Swal.fire({
            title: ms,
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si'
            }).then((result) => {
            if (result.isConfirmed) {
                        livewire.emitTo(item1,item2)
                        Swal.fire(
                        '',
                        ms2,
                        'success'
                        )
                }
            })
        })
    </script>

    <script>
        livewire.on('descalific', () => {
            Swal.fire({
            title: 'Indique la localidad',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'USA',
            denyButtonText: 'UK',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                livewire.emitTo('jumpers.ssidkr.ssidkr-index','descalificar',[$type='usa'])
                Swal.fire('Espere mientras se procesa la solicitud', '', 'info')
            } else if (result.isDenied) {
                livewire.emitTo('jumpers.ssidkr.ssidkr-index','descalificar',[$type='uk'])
                Swal.fire('Espere mientras se procesa la solicitud', '', 'info')
            }
            })
        })
    </script>

    <script>
        livewire.on('canjear', (ms,item1,item2,ms2) => {
            Swal.fire({
            title: ms,
            text: "No podrá revertir esto",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, seguro'
            }).then((result) => {
            if (result.isConfirmed) {
                        livewire.emitTo(item1,item2)
                        Swal.fire(
                        'Listo',
                        ms2,
                        'success'
                        )
                }
            })
        })
    </script>


    <script>
        livewire.on('numerologia', (op,n1,n2) => {
            Swal.fire({
                title: op,
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off',
                    color:'#000000'
                },
                showCancelButton: true,
                confirmButtonText: 'Enviar',
                

                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('hola')
                    livewire.emitTo(n1,n2,[$result=result.value])
                }
            })
        })
    </script>

    {{-- Custom Scripts --}}
    @yield('adminlte_js')
</body>

</html>