<div>
    <button type="submit" class="btn btn-primary btn-sm float-right" wire:click="open">
        <i class="fas fa-plus-circle"></i> Survey.emi-rs
    </button>

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300">Registro de Survey.emi-rs</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2>
                        <hr class="m-2 p-2">

                        <div class="form-group">
                            <label for="formGroupExampleInput">Panel</label>
                            <input type="text" wire:model="panel" class="form-control" id="formGroupExampleInput" >
                            <x-input-error for="panel" />
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Jumper</label>
                            <input type="text" wire:model="jumper" class="form-control" id="formGroupExampleInput2" >
                            <x-input-error for="jumper" />
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Comentario</label>
                            <textarea wire:model.defer="comentario" class="form-control" id="formGroupExampleInput" name="comentario" cols="80" rows="2"></textarea>
                            <x-input-error for="token" />
                        </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:click="save">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>