<div>
    <button type="submit" class="btn btn-primary btn-sm float-right" wire:click="open">
        <i class="fas fa-plus-circle"></i> SAMPLICIO
    </button>

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300">Registro de Cint</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2>
                        <hr class="m-2 p-2">

                        <div class="form-group">
                            <label for="formGroupExampleInput">ID</label>
                            <input type="text" wire:model="id_id" class="form-control" id="formGroupExampleInput" placeholder="2755364">
                            <x-input-error for="id_id" />
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Token</label>
                            <input type="text" wire:model="token" class="form-control" id="formGroupExampleInput2" placeholder="https://s.cint.com/Survey/Complete?ProjectToken=f9711a4d-7401-459a-a52f-4db7f5c86ce4">
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
