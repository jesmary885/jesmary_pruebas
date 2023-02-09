<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <title>QuerySet</title>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <link rel="stylesheet" href="{{ asset('vendor/login_banner/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/login_banner/banner.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/login_banner/graphic.css') }}">
    
</head>

<body>
    <section class="main-banner h-full w-full">

        <!--grind-container -->

        <div class="md:hidden lg:hidden">
        <div class="grid-container">
            <div class="content">
                <!--Titulo-->
                <h1 class=" title s-center">
                    <span class="line-1"> VERIFICACIÓN DE CORREO</span>
                    <br>
                    <span class="line-2">ELECTRONICO</span>
                </h1>

                <div class="mt-6">
                    <div class="mx-auto rounded-3xl">
                        <div class="mb-4 text-sm text-gray-200">
                        Antes de continuar, verifica tu dirección de correo electrónico haciendo clic en el enlace que te acabamos de enviar, si no recibiste el correo electrónico, con gusto te enviaremos otro.
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                            Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó en la configuración de su perfil.
                            </div>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <button type="submit" class="w-full flex justify-center bg-green-200  hover:blue-700 text-gray-600 p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500">
                                    Reenviar correo electrónico de verificación
                                    </button>
                                </div>
                            </form>
                        </div>
		            </div>
	            </div>
            </div>
	    </div>

        </div>

        <div class="hidden md:block w-full">
        <div class="grid-container flex">
            <div class="content w-full">
                <!--Titulo-->
                <h1 class=" title s-center">
                    <span class="line-1"> VERIFICACIÓN DE CORREO</span>
                    <br>
                    <span class="line-2">ELECTRÓNICO</span>
                </h1>

                <!--Descripcián-->
                <!-- <p class="description s-center">Dile adiós a los jumpers mal creados que te banean y te desmotivan. Comienza ya con Queryset.para obetener los mejores Jumpers del mercado.</p> -->

                <div class="mt-6 w-3/4">
                    <div class="mx-auto rounded-3xl">
                        <div class="mb-4 text-sm text-gray-200">
                        Antes de continuar, verifica su dirección de correo electrónico haciendo clic en el enlace que le acabamos de enviar, si no recibiste el correo electrónico, con gusto te enviaremos otro.
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                            Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionó en la configuración de su perfil.
                            </div>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <button class="w-full flex justify-center bg-green-200  hover:blue-700 text-gray-600 p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500" type="submit">
                                        Reenviar correo electrónico de verificación
                                    <button>
                                </div>
                            </form>
                        </div>
		            </div>
	            </div>
            </div>

            <div class="graphic w-full">
                <img class="graphic-man" src="/imagenes/tech-man.png">
                <img class="graphic-go absolute" src="/imagenes/buscador.png">
                <div class="graphic-circles absolute">
                    <img class="graphic-logo absolute" src="/imagenes/logo.png">
                    <img class="graphic-circle-1 absolute" src="/imagenes/internal-new.png">
                    <img class="graphic-circle-2 absolute" src="/imagenes/external-new.png">
                    <img class="graphic-energy absolute" src="/imagenes/power-sphere.png">
                </div>
            </div>
	    </div>

        </div>

        <div class=" mt-24 text-center text-gray-300 text-xs">
            <span>
                Copyright © 2021-2023 <span class="text-blue-500 hover:text-blue-600"> QuerySet
            </span>
        </div>

    </section>

    
</body>
</html>
