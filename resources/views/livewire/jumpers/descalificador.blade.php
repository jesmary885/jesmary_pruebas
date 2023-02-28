<div>
    <button title="DESCALIFICAR" type="submit" class="btn btn-danger btn-md"  wire:click="open"> DESCALIFICAR</button> 

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> DESCALIFICADOR</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold text-justify"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2> 
                
                        <hr class="m-2 p-2">

                            <div class="flex justify-between">
                                
                                <div class="form-group w-full">
                                    <label class="w-full text-justify">Localidad</label>
                                    <select wire:model="type" title="type" class="block w-full text-gray-400 py-2 px-2 pr-8 leading-tight rounded focus:outline-none focus:border-gray-500" name="type">
                                        <option value="" selected>Seleccione una opción</option>    
                                        <option value="usa">USA</option>
                                        <option value="uk">UK</option>
                                    </select>
                                    <x-input-error for="type" />
                                    
                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:click="save">PROCESAR</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
  
</div>
