<div>
    <button type="submit" class="btn btn-primary btn-sm float-right" wire:click="open">
        <i class="fas fa-plus-circle"></i> BASIC
    </button>

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300">Registro de Basic</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2>
                        <!-- <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold"><i class="fas fa-info-circle"></i> Si aún cuentas con el link de la encuesta pegala en el campo URL (Este no es un campo obligatorio)</h2>   -->
                        <hr class="m-2 p-2">

                        <div class="form-group">
                            <label for="formGroupExampleInput">PSID</label>
                            <input type="text" wire:model="psid" class="form-control" id="formGroupExampleInput" placeholder="B58LP">
                            <x-input-error for="psid" />
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">BASIC</label>
                            <input type="text" wire:model="basic" class="form-control" id="formGroupExampleInput2" placeholder="12347">
                            <x-input-error for="basic" />
                        </div>
                        <!-- <div class="form-group">
                            <label for="formGroupExampleInput2">URL</label>
                            <input type="text" wire:model="url" class="form-control" id="formGroupExampleInput2" placeholder="https://decipherinc.com/survey/selfserve/2157/220847?list=101&pid=256212666&psid=ku9BrkvUN8pkuCiK2G4a8Sq0h">
                        </div> -->
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
