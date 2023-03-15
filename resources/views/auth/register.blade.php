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
                    <span class="line-1"> Domina los Jumpers</span>
                    <br>
                    <span class="line-2">con Queryset</span>
                </h1>

                <div class="mt-6">
                    <div class="mx-auto rounded-3xl">
                        
                        <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div>
                            <input id="name" class="w-full text-gray-600 text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"  placeholder="Username">
                            <x-input-error for="name" />
                        </div>

                        <div class="mt-4">

                            <input id="email" class="w-full text-gray-600 text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" type="email" name="email" :value="old('email')" required  placeholder="Email">
                            <x-input-error for="email" />
                        </div>

                        <div class="mt-4">
                            <input id="password" name="password" placeholder="Password" type="password" name="password" required autocomplete="new-password" class="text-sm text-gray-500 px-4 py-3 rounded-lg w-full bg-gray-200 focus:bg-gray-100 border border-gray-200 focus:outline-none focus:border-purple-400">
                            <x-input-error for="password" />
                        </div>

                        <div class="mt-4">
                            <input id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" type="password" required class="text-sm text-gray-500 px-4 py-3 rounded-lg w-full bg-gray-200 focus:bg-gray-100 border border-gray-200 focus:outline-none focus:border-purple-400">
                            <x-input-error for="password_confirmation" />
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-jet-label for="terms">
                                    <div class="flex items-center">
                                        <x-jet-checkbox name="terms" id="terms"/>

                                        <div class="ml-2">
                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                            ]) !!}
                                        </div>
                                    </div>
                                </x-jet-label>
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-6  ">

                            <button class="w-full flex justify-center bg-green-200  hover:blue-700 text-gray-600 p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500">
                                {{ __('Register') }}
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
                    <span class="line-1"> Domina los Jumpers</span>
                    <br>
                    <span class="line-2">Con Queryset</span>
                </h1>

                <!--Descripcián-->
                <!-- <p class="description s-center">Dile adiós a los jumpers mal creados que te banean y te desmotivan. Comienza ya con Queryset.para obetener los mejores Jumpers del mercado.</p> -->

                <div class="mt-6 w-3/4">
                    <div class="mx-auto rounded-3xl">
                        
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div>
                            <input id="name" class="w-full text-gray-600 text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"  placeholder="Username">
                            <x-input-error for="name" />
                        </div>


                        <div class="mt-4">

                            <input id="email" class="w-full text-gray-600 text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" type="email" name="email" :value="old('email')" required  placeholder="Email">
                            <x-input-error for="email" />
                        </div>

                        <div class="mt-4">
                            <input id="password" name="password" placeholder="Contraseña" type="password" name="password" required autocomplete="new-password" class="text-sm text-gray-500 px-4 py-3 rounded-lg w-full bg-gray-200 focus:bg-gray-100 border border-gray-200 focus:outline-none focus:border-purple-400">
                            <x-input-error for="password" />
                        </div>

                        <div class="mt-4">
                            <input id="password_confirmation"  placeholder="Confirmar contraseña" type="password" name="password_confirmation" required autocomplete="new-password" class="text-sm text-gray-500 px-4 py-3 rounded-lg w-full bg-gray-200 focus:bg-gray-100 border border-gray-200 focus:outline-none focus:border-purple-400">
                            <x-input-error for="password_confirmation" />
                        </div>

                        <div class="flex items-center justify-end mt-6  ">

                            <button class="w-full flex justify-center bg-green-200  hover:blue-700 text-gray-600 p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500">
                                {{ __('Registrar') }}
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














