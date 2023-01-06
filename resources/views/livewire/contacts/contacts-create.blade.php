<div>
    <button type="submit" class="btn btn-primary btn-sm float-right mr-2" wire:click="open">
        @if ($accion == 'create')
        <i class="fas fa-plus-square"></i> {{__('messages.Agregar_contacto')}}
        @else
        <i class="fas fa-edit"></i>
        @endif
    </button>

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> {{__('messages.Agregar_contacto')}}</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar_contactos')}}</h2> 
                        <hr>
                        <hr class="m-2 p-2">

                            <div class="form-group">
                                <label for="formGroupExampleInput">{{__('messages.nombre')}}</label>
                                <input type="text" wire:model="name" class="form-control" id="formGroupExampleInput">
                                <x-input-error for="name" />
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">{{__('messages.username')}}</label>
                                <input type="text" wire:model="username" class="form-control" id="formGroupExampleInput2">
                                <x-input-error for="username" />
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
</div>
