<div>
    <button type="submit" class="btn btn-primary btn-sm float-right" wire:click="open">
        <i class="fas fa-edit"></i>
    </button>

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;"
            wire:click.self="$set('isopen', false)">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-200"> <i class="fas fa-check-double"></i>  Editar tasa del día</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 mb-3 p-0 text-gray-500 font-semibold"><i class="fas fa-info-circle"></i> Complete el campo y presiona Guardar</h2> 
                        <hr class="m-2">

                        <div class="w-full">
                                <label class="w-full text-justify">Tasa de cambio</label>

                                <input type="text" wire:model="tasa_dia" class="form-control rounded" id="formGroupExampleInput">
                                <x-input-error for="tasa_dia" />
                        </div>
                                
                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:click="save" wire:loading.attr="disabled">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
