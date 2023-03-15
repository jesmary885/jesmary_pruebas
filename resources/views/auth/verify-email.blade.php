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
    
    <style>
        .Div_flotante{
        position: absolute;
        bottom: 0px;
        width: 100%;
        height: 40px;
        text-align: center;
        z-index:5;

        }
    </style>

</head>

<body class="pequeno">

    <video src="/imagenes/LOGIN.mp4" class="mt-14 hidden md:block" autoplay="true" muted="true" loop="true"></video>

    <section id="sect1" class="sect">


        <div class="md:hidden lg:hidden w-full h-full pequeno main-banner">
            <div class="grid-container">
                <div class="content">
                    <!--Titulo-->
                    <h1 class=" title s-center">
                        <span class="line-1"> VERIFICACIÓN DE CORREO</span>
                        <br>
                        <span class="line-2">ELECTRÓNICO</span>
                    </h1>

                    <div class="mt-6">
                        <div class="mx-auto rounded-3xl">
                            <div class="mb-4 text-sm text-gray-200">
                            Te hemos enviado un correo electrónico al email que has registrado, ábrelo y haz clic en el botón "Verify Email Address", serás direccionado inmediatamente al sistema para reportar tu pago de ingreso.
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

        <div class="hidden md:block">
        <div class="grid-container flex">
            <div class="content w-full">
                <!--Titulo-->
                <h1 class=" title mx-8">
                    <span class="line-1"> VERIFICACIÓN DE CORREO</span>
                    <br>
                    <span class="line-2">ELECTRÓNICO</span>
                </h1>

                <!--Descripcián-->
                <!-- <p class="description s-center">Dile adiós a los jumpers mal creados que te banean y te desmotivan. Comienza ya con Queryset.para obetener los mejores Jumpers del mercado.</p> -->

                <div class="mt-6 w-3/4">
                    <div class=" mx-8 rounded-3xl">
                        <div class="mb-4 text-lg text-gray-200 text-justify">
                        Te hemos enviado un correo electrónico al email que has registrado, ábrelo y haz clic en el botón "Verify Email Address", serás redireccionado inmediatamente al sistema para reportar tu pago de ingreso.
                        </div>

                        <div class="mb-4  text-xs text-gray-200 text-justify">
                        Si aún no has recibido el email, haz clic en el botón "Reenviar correo electrónico de verificación"
                        </div>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-lg text-justify text-green-600">
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
                <div class="graphic-circles absolute hidden lg:block">
                    <img class="graphic-logo absolute" src="/imagenes/logo.png">
                    <img class="graphic-circle-1 absolute" src="/imagenes/internal-techs.png">
                    <img class="graphic-circle-2 absolute" src="/imagenes/external-new.png">
                    <img class="graphic-energy absolute" src="/imagenes/power-sphere.png">
                </div>
            </div>
	    </div>

        </div>

        <footer class="Div_flotante">
        <div class="flex justify-center text-gray-300 text-xs">
            <span>
                Copyright © 2021-2023 <span class="text-blue-500 hover:text-blue-600"> QuerySet
            </span>
        </div>

        </footer>

    </section>

    
</body>
</html>
