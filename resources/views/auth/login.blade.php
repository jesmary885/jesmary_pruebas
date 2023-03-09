<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <title>QuerySet</title>

     <!-- Fonts -->
     <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

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

<body class=" overflow-hidden  ">
    <section class="main-banner h-full w-full">

        <!--grind-container -->

        <div class="md:hidden lg:hidden">
        <div class="grid-container">
            <div class="content">
                <!--Titulo-->
                <h1 class=" title s-center">
                    <span class="line-1"> Domina los Jumpers</span>
                    <br>
                    <span class="line-2">Con Queryset</span>
                </h1>

                <div class="mt-6">
                    <div class=" mx-auto rounded-3xl">
                        <div class="mb-7">
                            <p class="text-gray-400">¿Aún no posees una cuenta? <a href="#" class="text-sm text-blue-700 hover:text-blue-700">Registrate aquí</a></p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="space-y-6">
                                            
                                <div class="">
                                    <input require class="w-full text-gray-600 text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" type="email" name="email" id="email" placeholder="Email">
                                    <x-input-error for="email" />
                                </div>

                                <div class="relative" x-data="{ show: true }">
                                    
                                <input require id="password" name="password" placeholder="Password" :type="show ? 'password' : 'text'" class="text-sm text-gray-500 px-4 py-3 rounded-lg w-full bg-gray-200 focus:bg-gray-100 border border-gray-200 focus:outline-none focus:border-purple-400">
                                <x-input-error for="password" />
                                <div class="flex items-center absolute inset-y-0 right-0 mr-3  text-sm leading-5">

                                            <svg @click="show = !show" :class="{'hidden': !show, 'block':show }"
                                                class="h-4 text-blue-700" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                viewbox="0 0 576 512">
                                                <path fill="currentColor"
                                                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                                </path>
                                            </svg>

                                            <svg @click="show = !show" :class="{'block': !show, 'hidden':show }"
                                                class="h-4 text-blue-700" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                viewbox="0 0 640 512">
                                                <path fill="currentColor"
                                                    d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                                </path>
                                            </svg>

                                        </div>
                                </div>


                                <div class="flex items-center justify-between">

                                    <div class="text-sm ml-auto">
                                        <a href="#" class="text-p-blue-700 hover:text-p-blue-600">
                                            Forgot your password?
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="w-full flex justify-center bg-green-200  hover:bblue-700 text-gray-600 p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
	    </div>

        </div>

        <div class="hidden md:block w-full">
        <div class="flex">
            <div class="content w-full md:ml-12 md:mt-12  2xl:ml-16 2xl:mt-28  ">
                <!--Titulo-->
                <h1 class=" title s-center">
                    <span class="line-1"> Domina los Jumpers</span>
                    <br>
                    <span class="line-2">Con Queryset</span>
                </h1>

                <!--Descripcián-->
                <!-- <p class="description s-center">Dile adiós a los jumpers mal creados que te banean y te desmotivan. Comienza ya con Queryset.para obetener los mejores Jumpers del mercado.</p> -->

                <div class="mt-6 w-3/4">
                    <div class=" mx-auto rounded-3xl">
                        <div class="mb-7">
                             <p class="text-gray-400">¿Aún no posees una cuenta? <a href="#" class="text-sm text-blue-700 hover:text-blue-700">Registrate aquí</a></p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="space-y-6">
                                            
                                <div class="">
                                    <input require class="w-full text-gray-600 text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-purple-400" type="email" name="email" id="email" placeholder="Email">
                                    <x-input-error for="email" />
                                </div>

                                <div class="relative" x-data="{ show: true }">
                                    <input require id="password" name="password" placeholder="Password" :type="show ? 'password' : 'text'" class="text-sm text-gray-500 px-4 py-3 rounded-lg w-full bg-gray-200 focus:bg-gray-100 border border-gray-200 focus:outline-none focus:border-purple-400">
                                    <x-input-error for="password" />    
                                    <div class="flex items-center absolute inset-y-0 right-0 mr-3  text-sm leading-5">

                                            <svg @click="show = !show" :class="{'hidden': !show, 'block':show }"
                                                class="h-4 text-blue-700" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                viewbox="0 0 576 512">
                                                <path fill="currentColor"
                                                    d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                                </path>
                                            </svg>

                                            <svg @click="show = !show" :class="{'block': !show, 'hidden':show }"
                                                class="h-4 text-blue-700" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                viewbox="0 0 640 512">
                                                <path fill="currentColor"
                                                    d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                                </path>
                                            </svg>

                                        </div>
                                </div>


                                <div class="flex items-center justify-between">

                                    <div class="text-sm ml-auto">
                                        <a href="#" class="text-p-blue-700 hover:text-p-blue-600">
                                            Olvidate tu contraseña?
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="w-full flex justify-center bg-green-200  hover:blue-700 text-gray-600 p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500">
                                        Ingresar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="graphic w-full">
                <img class="graphic-man" src="/imagenes/man.png">
                <!-- <img class="graphic-go absolute" src="/imagenes/buscador.png"> -->
                <div class="graphic-circles absolute">
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









