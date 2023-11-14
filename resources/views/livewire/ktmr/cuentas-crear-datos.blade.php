<div>
    <button title="Registrar datos" type="submit" class="btn btn-success btn-sm" wire:click="open">
        <i class="fas fa-edit"></i>
    </button> 

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> Cargar datos de la cuenta</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold text-justify"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2> 

                        
                        <div class="flex justify-between mt-3">
                            <div class="w-full mr-2">
                                <label class="w-full text-justify" >Correo</label>
                                <input type="email" wire:model="correo" class="form-control rounded" id="formGroupExampleInput">
                            </div>

                            <div class="w-full">
                                <label class="w-full text-justify">Contraseña</label>
                                <input type="text" wire:model="password" class="form-control rounded" id="formGroupExampleInput">
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">{{__('messages.Cerrar')}}</button>
                        <button type="button" class="btn btn-primary" wire:click="guardar">{{__('messages.Guardar')}}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>