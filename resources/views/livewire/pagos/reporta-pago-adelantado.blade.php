<div x-data="{plan: @entangle('plan')}">
    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> {{__('messages.registro_pago')}}</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold text-justify"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2> 
                
                        <hr class="m-2 p-2">

                        <p class="info-box-text mb-2">PRECIO DE MEMBRESIA: </p>
                        <p class="info-box-text"> - 10$ </p>
                        <p class="info-box-text"> - {{10* $tasa_dia_dolar}} Bs. </p>
                        <p class="info-box-text"> - {{round((10 / $tasa_dia_ltc),2)}} LTC.</p>

                        <hr class="m-2 p-2">

                            <div class="flex justify-between mt-0">
                                
                                <div class="form-group w-full">
                                    <label class="w-full text-justify">Motivo</label>
                                    <select wire:model="plan" title="Plan" id="estado" class="block w-full text-gray-400 py-2 px-2 pr-8 leading-tight rounded focus:outline-none focus:border-gray-500" name="estado">
                                        <option value="" selected>{{__('messages.seleccione_opcion')}}</option>  
                                        <option value="membresia">{{__('messages.pago_mensualidad')}}</option>  
                                        <option value="balance">{{__('messages.add_saldo_pagina')}}</option>
                                    </select>
                                    <x-input-error for="plan" />
                                    
                                </div>
                            </div>



                            @if($plan == "balance")
                                <div class="form-group w-full mr-2">
                                    <label class="w-full text-justify">{{__('messages.monto')}}</label>
                                    <div class="flex ">
                                        <input type="number" min="5" wire:model="monto" class="form-control rounded w-1/3" >
                                        <p class="text-gray-300 font-bold text-ms ml-2 mt-1">$</p>
                                    </div>
                                    
                                    <x-input-error for="monto" />
                                </div>
                            @endif

                         
                            <div class="form-group w-full mr-2">
                                    <label for="formGroupExampleInput2 mb-2">{{__('messages.metodo_pago_utilizar')}}</label>
                                        <select wire:model="metodo_id" class="form-control w-full">
                                            <option value="" selected>{{__('messages.seleccione_opcion')}}</option>
                                                @foreach ($this->verific() as $metodo)
                                                    <option value="{{$metodo->id}}">{{$metodo->name}}</option>
                                                @endforeach
                                        </select>
                                    <x-input-error for="metodo_id" />
                            </div>

                        @if($metodo_id != '1')  
                            <div class="form-group w-full mr-2">
                                    <label class="w-full text-justify">{{__('messages.referencia_nro')}}</label>
                                    <div class="flex ">
                                        <input type="number" wire:model="referencia" class="form-control rounded" >
                                    </div>
                                    
                                    <x-input-error for="referencia" />
                            </div>
                        @endif

                            <div class="form-group w-full">
                                    <label class="w-full text-justify">{{__('messages.fecha_pago')}}</label>
                                    <div>
                                        <div wire:ignore x-data="datepicker()">
                                            <div class="flex flex-col">
                                                <div class="flex items-center gap-2">
                                                    <input 
                                                        type="text" 
                                                        class="px-4 outline-none cursor-pointer rounded" 
                                                        x-ref="myDatepicker" 
                                                        wire:model="fecha_pago" 
                                                        placeholder="Seleccione la fecha">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            @if($metodo_id != '1')
                                <div class="w-full">
                                    <div class="flex">
                                        <i class="	fas fa-file-image mt-2 mr-2 text-gray-300"></i>
                                        <h2 class="text-md inline mt-2 text-gray-300 mb-2">{{__('messages.constancia_pago')}}</h2>
                                    </div> 
                                    <div class="row">
                                        <div class="col">
                                            <div class="w-50 h-50">         
                                                @if ($file)
                                                <img src="{{ $file->temporaryUrl() }}" width="100%" height="100%">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <input type="file" wire:model="file" id="file" class="block w-full text-base font-normal text-gray-300 bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-300 focus:border-blue-600 focus:outline-none" accept="image/*">
                                                @error('file')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                                <p>Tipos de archivos permitidos: JPG, JPEG, PNG. Tamaño máximo 3MB.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="formGroupExampleInput2">{{__('messages.Comentarios')}}</label>
                                <textarea wire:model="comentario" id="formGroupExampleInput" class="form-control resize-none rounded" cols="80" rows="5"> </textarea>
                                <x-input-error for="comentario" />
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">{{__('messages.Cerrar')}}</button>
                        <button type="button" class="btn btn-primary" wire:click="save">{{__('messages.Guardar')}}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('js')

    <script>
        Livewire.on('volver', function(){
            window.history.back();      
        })
    </script>

    <script>
            document.addEventListener('alpine:init',()=>{
                Alpine.data('datepicker',()=>({
                    fecha_pago:null,
                    init(){
                        flatpickr(this.$refs.myDatepicker, {dateFormat:'Y-m-d H:i', altInput:true, altFormat: 'F j, Y',})
                    },
                    reset(){
                        this.fecha_pago= null;
                    }
                }))
            })
    </script>

    @endpush
</div>