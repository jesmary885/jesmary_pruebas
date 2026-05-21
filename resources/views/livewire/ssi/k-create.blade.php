<div>
    <button type="submit" class="btn bg-info ml-2 mt-1" wire:click="open">
        REGISTRARLO AQUI
    </button>


    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300">Registro</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2>
                       
                        <hr class="m-2 p-2">

                        <div class="form-group">
                            <label for="formGroupExampleInput">ID</label>
                            <input type="text" wire:model="psid" class="form-control" id="formGroupExampleInput" placeholder="B58LP">
                            <x-input-error for="psid" />
                        </div>
                        <div class="form-group">
                            <div class="form-group w-full">
                                    <label class="w-full text-justify">Tipo de K</label>
                                    <select wire:model="k_type" id="k_type" class="block w-full text-gray-400 py-2 px-2 pr-8 leading-tight rounded focus:outline-none focus:border-gray-500" name="tipo de k">
                                        <option value="" selected>Seleccione una opción</option>
                                        <option value="K23">K23</option>
                                        <option value="K1000">K1000</option>
                                        <option value="K1050">K1050</option>
                                        <option value="K1091">K1091</option>
                                        <option value="K1092">K1092</option>
                                        <option value="K1093">K1093</option>
                                        <option value="K1098">K1098</option>
                                        <option value="K2000">K2000</option>
                                        <option value="K2028">K2028</option>
                                        <option value="K2049">K2049</option>
                                        <option value="K2062">K2062</option>
                                        <option value="K2066">K2066</option>
                                        <option value="K3203">K3203</option>
                                        <option value="K3889">K3889</option>
                                        <option value="K4453">K4453</option>
                                        
                                    </select>
                                    <x-input-error for="k_type" />
                                    
                            </div>
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