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
        width: 95%;
        height: 40px;
        text-align: center;
        z-index:3;

        }
    </style>
</head>

<body class="pequeno" >

    <video src="/imagenes/LOGIN.mp4" class="mt-14 hidden md:block" autoplay="true" muted="true" loop="true"></video>    
    <section id="sect1" class="sect">

        <!--grind-container -->

        <div class="md:hidden lg:hidden w-full h-full pequeno main-banner">
        <div class="grid-container">
            <div class="content">
                <!--Titulo-->
                <h1 class=" title s-center">
                    <span class="line-1"> Hola, </span>
                    
                    <br>
                    <span class="line-2">{{$user_search}}</span>
                </h1>

                <div class="mt-6">

                    
                    <div class="mx-auto rounded-3xl">

                    @if (session('info'))
                                <div class="alert alert-success m-2 text-red-600">
                                    <strong>{{session('info')}}</strong>
                                </div>
                            @endif
                        
                        <form method="POST" action="{{ route('register_dates.create') }}">
                        @csrf

                        <input type="hidden" name="email" id="email" value="{{$user_search_email}}" class="form-control" style="visibility:hidden">

                        <div class="mb-4 mt-4">
                            <p class="text-gray-400 text-md"> Ingresa los siguientes datos para completar tu registro</p>
                        </div>

                        <div class="form-group w-full mt-4">
                            <select wire:model="nacionalidad" required title="Nacionalidad" id="nacionalidad" class="bg-gray-200 block text-sm w-full text-gray-600 py-3 px-4 pr-8  rounded-lg focus:outline-none focus:border-gray-500" name="nacionalidad">
                                <option value="" selected>Nacionalidad</option>
                                <option value="1">Venezolana</option>
                                <option value="2">Extranjera</option>
                            </select>
                            <x-input-error for="nacionalidad" />
                                    
                        </div>

                        <div class="mt-4">
                            <input id="telegram" class="w-full text-gray-600 text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" type="text" name="telegram" required autofocus autocomplete="name" placeholder="Tu Telegram-ID (Registrado en QuerySet)">
                            <x-input-error for="telegram" />
                        </div>

                        <div class="mt-4">

                            <input id="dni" class="w-full text-gray-600 text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" type="number" name="dni" placeholder="Número de documento de identidad">
                            <x-input-error for="dni" />
                        </div>

                        

                        



                        <div class="flex items-center justify-end mt-6  ">

                            <button class="w-full flex justify-center bg-green-200  hover:blue-700 text-gray-600 p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500">
                                {{ __('Ingresar') }}
                            </button>
                        </div>
                    </form>

		            </div>
	            </div>
            </div>
	    </div>

        </div>

        <div class="hidden md:block w-full ">
        <div class="flex">

            <div class="content w-full md:ml-0 md:mt-0 lg:ml-6 lg:mt-6  2xl:ml-16 2xl:mt-20 ">
                <!--Titulo-->
                <h1 class=" title s-center">
                    <span class="line-1"> Hola, </span>
                    <br>
                    <span class="line-2">{{$user_search}}</span>
                </h1>

                <!--Descripcián-->
                <!-- <p class="description s-center">Dile adiós a los jumpers mal creados que te banean y te desmotivan. Comienza ya con Queryset.para obetener los mejores Jumpers del mercado.</p> -->

                <div class="mt-6 w-3/4">
                    <div class="mx-auto rounded-3xl">

                    <form method="POST" action="{{ route('register_dates.create') }}">
                        @csrf

                        <input type="hidden" name="email" id="email" value="{{$user_search_email}}" class="form-control" style="visibility:hidden">


               
                    <div class="mb-4 mt-6">
                        <p class="text-gray-400 text-md"> Ingresa los siguientes datos para completar tu registro: </p>
                    </div>

                    @if (session('info'))
                                <div class="alert alert-success m-2 text-red-600">
                                    <strong>{{session('info')}}</strong>
                                </div>
                            @endif
                        

                        <div class="form-group w-full mt-4">
                            <select wire:model="nacionalidad" required title="Nacionalidad" id="nacionalidad" class="bg-gray-200 block text-sm w-full text-gray-600 py-3 px-4 pr-8  rounded-lg focus:outline-none focus:border-gray-500" name="nacionalidad">
                                <option value="" selected>Nacionalidad</option>
                                <option value="1">Venezolana</option>
                                <option value="2">Extranjera</option>
                            </select>
                            <x-input-error for="nacionalidad" />
                                    
                        </div>
                    

                        <div class="mt-4">
                            <input id="telegram" class="w-full text-gray-600 text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" type="text" name="telegram" :value="old('telegram')" required autofocus autocomplete="name"  placeholder="Tu Telegram-ID (Registrado en QuerySet)">
                            <x-input-error for="telegram" />
                        </div>

                    

                        <div class="mt-4">

                            <input id="dni" class="w-full text-gray-600 text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" type="number" name="dni" placeholder="Número de documento de identidad">
                            <x-input-error for="dni" />
                        </div>

                

                        <div class="flex items-center justify-end mt-6  ">

                            <button class="w-full flex justify-center bg-green-200  hover:blue-700 text-gray-600 p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500">
                                {{ __('Ingresar') }}
                            </button>
                        </div>
                    </form>

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














