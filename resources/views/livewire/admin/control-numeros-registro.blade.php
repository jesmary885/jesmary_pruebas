<div >

    @if($tipo == 'agregar')

    <button type="button" wire:click="open" type="button" class="btn btn-primary btn-sm float-right mr-2">

      REGISTRAR NÚMERO
    </button>

    @else

    <button type="button" wire:click="open" class="btn btn-primary btn-sm  mr-2">
        EDITAR
    </button>

    @endif

    @if ($isopen)

        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content container mx-4">
                    <div class="modal-header w-full">
                        <div class=" flex justify-between w-full">

                            <p class="font-bold text-white w-full mt-2 " >REGISTRO DE CUENTAS</p>

                            <div class=" flex-1 w-full">
                                <button type="button" wire:click="close" wire:loading.attr="disabled"  class="py-2.5 px-3 me-2 mb-2 text-sm font-bold text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    X
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="container">

                        @if($tipo == 'agregar')

                        <div class=" w-full mt-2">

                            <div class="w-1/2 mr-2 mt-4">

                        
                                <input type="number" wire:model="numero" id="formGroupExampleInput"  class="form-control" placeholder="Ingrese el número" required />
                                <x-input-error for="numero" />
                            </div>

                            <div class="w-1/2 mr-2 mt-4">

                           
                                <input type="text" wire:model="codigo" id="formGroupExampleInput" class="form-control" placeholder="Ingrese el código" required />
                                <x-input-error for="codigo" />
                            </div>

                    
                        </div>

                        @else

                            <div class="flex w-full mt-2">

                                <div class="w-1/2 mr-2 mt-4">

                            
                                    <input type="number" wire:model="numero" id="formGroupExampleInput"  class="form-control" placeholder="Ingrese el número" required />
                                    <x-input-error for="numero" />
                                </div>

                                <div class="w-1/2 mr-2 mt-4">

                            
                                    <input type="text" wire:model="codigo" id="formGroupExampleInput" class="form-control" placeholder="Ingrese el código" required />
                                    <x-input-error for="codigo" />
                                </div>

                        
                            </div>


                              <div class="flex w-full mt-2">
                                    <div class="form-group w-full mr-2">
                                    <label for="formGroupExampleInput2 mb-2">Trabajador</label>
                                        <select wire:model="trabajador_id" class="form-control w-full">
                                            <option value="" selected>{{__('messages.seleccione_opcion')}}</option>
                                                @foreach ($trabajadores as $trabajador)
                                                    <option value="{{$trabajador->id}}">{{$trabajador->name}}</option>
                                                @endforeach
                                        </select>
                                        <x-input-error for="trabajador_id" />
                                 
                                    </div>

                         

                            
                                    <div class="form-group w-full">
                                        <label class="w-full text-justify">Estado</label>
                                        <select wire:model="status"  id="status" class="block w-full text-gray-400 py-2 px-2 pr-8 leading-tight rounded focus:outline-none focus:border-gray-500" name="estado">
                                            <option value="" selected>Estado</option>
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                   
                                        </select>
                                        <x-input-error for="status" />
                                    
                                    </div>
                             

                        
                            </div>


                        @endif


                    </div>
                

                    <div class="modal-footer mt-2">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:click="procesar">Guardar</button>

                    </div>
                </div>
            </div>
        </div>

    @endif



  
</div>
