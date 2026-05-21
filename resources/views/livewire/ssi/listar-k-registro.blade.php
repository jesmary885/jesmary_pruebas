<div>

    <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title font-bold">BUSQUEDA DE ID'S</h3>
    </div>
    </div>

                        <div class="card-body">

                                <input wire:model="search" placeholder="Ingresa el id a buscar..." id="validationCustomUsername" class="form-control" aria-describedby="inputGroupPrepend" >
                               
                        </div>

                

                        @if ($k_detect && $search)
                                <div class="card-body mt-0">

                                    <div class="flex-nowrap justify-center callout callout-info">
                                        <div>
                                            <p class="text-cyan-400 text-md text-center font-bold mb-1 " id="jumper_copy">{{$k_detect->k}}</p>
                                            
                                        </div>
                                    </div>

                                    <div class="md:col-span-2">
                                <div class="flex justify-between">
                                    <div class=" mt-2 mr-2 ml-2 flex-1 mb-2">
                                        <textarea wire:model.defer="comentario" class="form-control" id="formGroupExampleInput" name="comentario" cols="80" rows="2" placeholder="Comparte tu comentario aquí"></textarea>
                                    </div>

                                    <div class="mt-3 mb-2 mr-2">
                                    <button
                                        class="btn bg-info" 
                                        wire:click="comentar('{{$k_detect->id}}')"
                                        title="{{__('messages.Guardar')}}">
                                        {{__('messages.Guardar')}}
                                    </button>

                                    </div>
                                </div>
                                <div class="card ml-2">
                                    @if ($comments->count())
                                        @foreach ($comments as $comment)
                                            <div class="flex justify-between card-body">
                                                <div class="">
                                                    <p class="text-gray-200 text-lg font-semibold">{{$comment->user->name}}</p>
                                                    <p class="text-gray-200 text-sm ">{{$comment->created_at->format('d/m/Y h:i')}}</p>
                                                </div>
                                                <div class="flex-1 ml-4 text-justify overflow-x-auto">
                                                    <p class="text-white font-semibold text-justify">{{$comment->comment}}</p>
                                                </div>
                                                
                                            </div>

                                            <hr class="m-2">
                                        @endforeach

                                        <div class="m-2">
                                            {{$comments->links()}}
                                        </div> 
                                    @else
                                        <div class="card-body">
                                            <strong>{{__('messages.sin_comentarios')}}</strong>
                                        </div>
                                    @endif 
                                </div>
                            </div>

                                </div>
                        @endif

                        @if (!$k_detect && $search)

                            <div class="info-box bg-info " :class="{'hidden': (no_detect == '0')}">
                            
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                <div class="info-box-content m-2">
                                    <span class="info-box-text">No se encuentra en nuestros registros</span>

                                    
                                
                                </div>

                              
                                
                            </div>

                              <div class="flex justify-center  ">

                                        @livewire('ssi.k-create')

                                </div>

                        @endif
</div>
