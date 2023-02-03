<div>
    <div class="container py-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <div >
               

                    <div class="flexslider">
                        <ul class="slides">

                            @if ($marketplace_select->images->count())
                                @foreach ($marketplace_select->images as $image)
                                    <li data-thumb=" {{ Storage::url($image->url) }}">
                                        <img class=" w-full object-cover object-center" src=" {{ Storage::url($image->url) }}" />
                                    </li>
                                @endforeach
                                    
                            @else
                                <li data-thumb="/storage/marketplace/no-imagen.jpg">
                                    <img class=" w-full object-cover object-center" src="/storage/marketplace/no-imagen.jpg" />
                                </li>
                                
                            @endif
                            
                            
                        </ul>
                    </div>

                    <div class="mt-10 text-gray-200">
                    <h2 class="font-bold text-lg">Descripción</h2>
                    <p class="font-semibold text-gray-200 text-md text-justify mt-2">
                    {{$marketplace_select->description}}
                    </p>
                    
                </div>

            </div>

            <div>
                <div class=" bg-transparent rounded shadow-inner p-3 mb-2">
                    <div class="mb-2">
                        <h1 class="text-lg font-bold text-gray-100">{{$marketplace_select->name}}</h1>
                    </div>

                    @if($marketplace_select->type == 'venta')

                    <div class=" ml-2 flex">
                        
                        <div class="flex mt-1">
                            <i class="{{$this->reputation($marketplace_select)[1]}}"></i> <i class="{{$this->reputation($marketplace_select)[2]}}"></i> <i class="{{$this->reputation($marketplace_select)[3]}}"></i> <i class="{{$this->reputation($marketplace_select)[4]}}"></i> <i class="{{$this->reputation($marketplace_select)[5]}}"></i>

                            <div class="text-sm text-gray-300 mt-3 ml-2">
                                @if ($porcentaje_marketplace)
                               ( {{round($porcentaje_marketplace,2)}} % de puntuación positiva por parte de los compradores )
                               @else
                                Esta publicación aún no tiene puntos registrados
                                @endif
                            </div>
                        </div>

                    </div>

                    @endif


                    <div class="flex w-full">
                        @if($marketplace_select->type == 'venta')
                        <p class="mt-3 ml-2 mb-6 font-bold text-xl text-blue-500">{{__('messages.precio')}} : $ {{$marketplace_select->price}} </p>
                        @else
                        <p class="mt-3 ml-2 mb-6 font-bold text-xl text-blue-500">{{__('messages.tasa')}} : $ {{$marketplace_select->tasa}} </p>
                        @endif
                    </div>
                    
                    

                <hr class="m-2 text-gray-200">

                <div class=" mt-6 ">
                    @if($marketplace_select->type == 'venta')
                        <p class=" font-bold text-lg text-gray-100">Información sobre el vendedor</p>
                    @else
                        <p class=" font-bold text-lg text-gray-100">Información sobre el comprador</p>
                    @endif

                    <p class="mt-2 text-md font-bold mb-2 ml-2 text-gray-400">{{__('messages.username')}} : {{$marketplace_select->user->username}}</p>

                    <div class=" ml-2 flex">
                        <div class="flex">
                            <div class="text-sm text-gray-300 mt-3 ml-2">
                            @if($marketplace_select->type == 'venta')
                                @livewire('marketplace.comments-marketplace', ['user' => $marketplace_select->user_id,'tipo'=>'Vendedor'])
                            @else
                                @livewire('marketplace.comments-marketplace', ['user' => $marketplace_select->user_id,'tipo'=>'Comprador'])
                            @endif  
                            </div>
                        </div>

                    </div>
                </div>

                <hr class="m-2 text-gray-200">

                <div class="mt-6">
                    <p class="font-bold text-lg text-gray-100 mb-2">Métodos de pago aceptados para esta publicación</p>

                    <div>
                        <ul>
                            @foreach ($metodos as $metodo)
                                    <p class="text-md font-bold mb-2 ml-2 text-gray-400"><i class="text-green-500 far fa-check-circle"></i> {{$metodo->name}}</p>
                            @endforeach
                        </ul>
                    </div>

                </div>


                    <div class=" mt-6 flex">

                        <div class="mr-2 ">
                        @if($marketplace_select->type == 'venta')
                            <button class="btn btn-primary btn-sm" wire:click="contact()">
                                Contactar con el vendedor
                            </button>
                        @else
                            <button class="btn btn-primary btn-sm" wire:click="contact()">
                                Contactar con el comprador
                            </button>

                        @endif

                        </div>
                        <div>
                            @if($marketplace_select->type == 'venta')
                                @livewire('marketplace.marketplace-shopping-finish', ['marketplace' => $marketplace_select])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('script')

            {{-- jquery --}}
             <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

            {{-- FlexSlider --}}
            <script src="{{ asset('vendor/FlexSlider/jquery.flexslider-min.js') }}"></script>
            <script>
                $(document).ready(function() {
                    $('.flexslider').flexslider({
                        animation: "slide",
                        controlNav: "thumbnails"
                    });
                });

            </script>
        @endpush

    </div>
</div>
