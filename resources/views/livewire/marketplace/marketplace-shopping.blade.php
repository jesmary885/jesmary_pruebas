<div>
    <div class="container py-8">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="mr-2 w-full h-576">
         

                <div class="justify-center">
                <img class=" w-full object-cover shadow-md object-center rounded-md h-96" src="/storage/logo/Category_vpn.webp" alt="">
                </div>

                <div class="mt-4">
                    <p class="text-lg font-bold text-gray-400">Descripción</p>

                    <div class="mt-2 text-justify ml-2">
                        <h1>{{$marketplace_select->description}}</h1>
                    </div>


                </div>

            </div>

            <div>
                <div class=" bg-transparent rounded shadow-inner p-3 mb-2">
                    <div class="mb-2">
                        <h1 class="text-lg font-bold text-gray-400">{{$marketplace_select->name}}</h1>
                    </div>

                    <div class=" ml-2 flex">
                        
                        <div class="flex mt-1">
                            <i class="{{$this->reputation($marketplace_select)[1]}}"></i> <i class="{{$this->reputation($marketplace_select)[2]}}"></i> <i class="{{$this->reputation($marketplace_select)[3]}}"></i> <i class="{{$this->reputation($marketplace_select)[4]}}"></i> <i class="{{$this->reputation($marketplace_select)[5]}}"></i>

                            <div class="text-sm text-gray-300 mt-3 ml-2">
                                @if ($porcentaje_marketplace)
                               ( {{round($porcentaje_marketplace,2)}} % de puntuación positiva por parte de los compradores )
                               @else
                                Este producto aún no tiene ventas registradas
                                @endif
                            </div>
                        </div>

                    </div>


                    <div class="flex w-full">
                        <p class="mt-3 ml-2 mb-6 font-bold text-xl text-blue-500">{{__('messages.precio')}} : $ {{$marketplace_select->price}} </p>
                    </div>
                    
                    

                <hr class="m-2 text-gray-200">

                <div class=" mt-6 ">
                    <p class=" font-bold text-lg text-gray-400">Información sobre el vendedor</p>

                    <p class="mt-2 text-md font-bold mb-2 ml-2 text-gray-100">{{__('messages.username')}} : {{$marketplace_select->user->username}}</p>

                    <div class=" ml-2 flex">
                        
                        <div class="flex">
                            <i class="{{$this->reputation_vendedor($marketplace_select->user_id)[1]}}"></i> <i class="{{$this->reputation_vendedor($marketplace_select->user_id)[2]}}"></i> <i class="{{$this->reputation_vendedor($marketplace_select->user_id)[3]}}"></i> <i class="{{$this->reputation_vendedor($marketplace_select->user_id)[4]}}"></i> <i class="{{$this->reputation_vendedor($marketplace_select->user_id)[5]}}"></i>

                            <div class="text-sm text-gray-300 mt-3 ml-2">
                                @if($porcentaje_vendedor)
                               ( {{round($porcentaje_vendedor,2)}} % de puntuación positiva por parte de los compradores )
                               @else
                               Este usuario aún no tiene ventas registradas
                                @endif
                            </div>
                        </div>

                    </div>
                </div>


                    <div class=" mt-6 flex">

                        <div class="mr-2 ">

                            <button
                                class="btn btn-primary btn-sm" 
                                wire:click="contact()"
                                >
                                Contactar con el vendedor
                            </button>

                        </div>
                        <div>
                        @livewire('marketplace.marketplace-shopping-finish', ['marketplace' => $marketplace_select])


                        </div>


                    </div>
                </div>
            </div>
            




        </div>
    </div>
</div>
