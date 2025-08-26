<div >

    @if($tipo == 'agregar')

    <button type="button" wire:click="open" type="button" class="btn btn-primary btn-sm float-right mr-2">

      CREAR CUENTA
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

                        <div class=" w-full mt-2">

                            <div class="w-1/2 mr-2 mt-4">

                        
                                <input type="number" wire:model="pid" id="formGroupExampleInput"  class="form-control" placeholder="Ingrese el pid" required />
                                <x-input-error for="pid" />
                            </div>

                            <div class="w-1/2 mr-2 mt-4">

                           
                                <input type="text" wire:model="hash" id="formGroupExampleInput" class="form-control" placeholder="Ingrese el hash" required />
                                <x-input-error for="hash" />
                            </div>

                    
                        </div>


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