<div>
    <button title="Editar usuario" type="submit" class="btn btn-success btn-sm" wire:click="open">
    @if ($registro->status == 'pendiente')
    REPORTAR PAGO
    @else
    <i class="	fas fa-edit"></i>
    @endif
    </button> 

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> Reporte de pago</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold text-justify"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2> 
                
                        <hr class="m-2 p-2">

                        <div class="form-group">
                            <div class="custom-control custom-radio flex justify-start">
                                <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio" value="1" wire:model="status">
                                <label for="customRadio1" class="custom-control-label text-md font-semibold text-gray-300">Pago recibido</label>
                            </div>

                            <div class="custom-control custom-radio flex justify-start">
                                <input class="custom-control-input custom-control-input-danger" type="radio" id="customRadio2" value="2" name="customRadio" wire:model="status">
                                <label for="customRadio2" class="custom-control-label text-md font-semibold text-gray-300">Pago no recibido</label>
                            </div>
                        </div>

                        @if($status == '1')

                            <div class="form-group">
                                <label class="text-sm ml-2 mb-2 text-gray-300 font-semibold w-full text-justify">Confirma el tipo de pago recibido</label>

                                <div class="custom-control custom-radio flex justify-start mt-2">
                                    <input class="custom-control-input" type="radio" id="customRadio3" name="customRadio3" value="1" wire:model="type_confirmed">
                                    <label for="customRadio3" class="custom-control-label text-md font-semibold text-gray-300">Mensualidad básica</label>
                                </div>

                                <div class="custom-control custom-radio flex justify-start">
                                    <input class="custom-control-input" type="radio" id="customRadio4" value="2" name="customRadio4" wire:model="type_confirmed">
                                    <label for="customRadio4" class="custom-control-label text-md font-semibold text-gray-300">Mensualidad premium (30 días)</label>
                                </div>

                                <div class="custom-control custom-radio flex justify-start">
                                    <input class="custom-control-input" type="radio" id="customRadio5" value="3" name="customRadio4" wire:model="type_confirmed">
                                    <label for="customRadio5" class="custom-control-label text-md font-semibold text-gray-300">Mensualidad premium (10 días)</label>
                                </div>

                                <div class="custom-control custom-radio flex justify-start">
                                    <input class="custom-control-input" type="radio" id="customRadio6" value="4" name="customRadio4" wire:model="type_confirmed">
                                    <label for="customRadio6" class="custom-control-label text-md font-semibold text-gray-300">Mensualidad premium (02 días)</label>
                                </div>

                                <div class="custom-control custom-radio flex justify-start">
                                    <input class="custom-control-input" type="radio" id="customRadio7" value="5" name="customRadio5" wire:model="type_confirmed">
                                    <label for="customRadio7" class="custom-control-label text-md font-semibold text-gray-300">Saldo en página</label>
                                </div>

                                <div class="custom-control custom-radio flex justify-start">
                                    <input class="custom-control-input" type="radio" id="customRadio8" value="6" name="customRadio6" wire:model="type_confirmed">
                                    <label for="customRadio8" class="custom-control-label text-md font-semibold text-gray-300">Monto adicional de plan premium (10$)</label>
                                </div>
                            </div>

                        @endif

                        <div class="form-group w-full mr-2">
                            <label class="w-full text-justify">Admin 2 que verifica</label>
                            <select wire:model="admin_verifi_id" title="Admin que verifica" class="block w-full text-gray-400 py-2 px-2 pr-8 leading-tight rounded focus:outline-none focus:border-gray-500">
                                <option value="" selected>Seleccione una opción</option>
                                    @foreach ($users_admin as $admin)
                                <option value="{{$admin->id}}">{{$admin->name}}</option>
                                @endforeach
                            </select>
                            <x-input-error for="admin_verifi_id" />
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