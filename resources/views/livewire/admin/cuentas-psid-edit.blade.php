<div>
    <button title="Editar" type="submit" class="btn btn-success btn-sm" wire:click="open">
        <i class="	fas fa-edit"></i>
    </button> 

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> Registro de trabajadores y usuarios gratis</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold text-justify"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2> 
                
                        <hr class="m-2 p-2">
                            <div class="flex justify-between mt-2">

                                <div class="form-group w-full mr-2">
                                    <label class="w-full text-justify">Rol</label>
                                    <select wire:model="rol" title="rol" id="estado" class="block w-full text-gray-400 py-2 px-2 pr-8 leading-tight rounded focus:outline-none focus:border-gray-500" name="estado">
                                        <option value="" selected>Rol</option>
                                        <option value="Cupo gratis">Cupo gratis</option>
                                        <option value="Trabajador">Trabajador SSI</option>
                                        <option value="Trabajador">Trabajador GPT</option>
                    
                                    </select>
                                    <x-input-error for="rol" />
                                </div>


                                <div class="form-group w-full ">
                                    <label class="w-full text-justify">Admin responsable</label>
                                        <select wire:model="admin" title="Administrador responsable" class="block w-full text-gray-400 py-2 px-2 pr-8 leading-tight rounded focus:outline-none focus:border-gray-500">
                                            <option value="" selected>Seleccione una opción</option>
                                                @foreach ($users_admin as $admin)
                                            <option value="{{$admin->id}}">{{$admin->name}}</option>
                                            @endforeach
                                            <option value="45">Hugo</option>
                                            <option value="10">El Lobo</option>
                                            <option value="7">Miguel</option>
                                        </select>
                                        <x-input-error for="admin" />
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
