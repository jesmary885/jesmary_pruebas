<div>
    <button title="Editar JUMPER" type="submit" class="btn btn-success btn-sm" wire:click="open">
        <i class="	fas fa-edit"></i>
    </button> 

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> Editar jumper</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold text-justify"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2> 
                
                        <hr class="m-2 p-2">

                        <div class="flex justify-between">
                                <div class="form-group w-full mr-2">
                                    <label class="w-full text-justify">Tipo</label>
                                    <select wire:model="type_id" title="Tipo de jumper" class="block w-full text-gray-400 py-2 px-2 pr-8 leading-tight rounded focus:outline-none focus:border-gray-500">
                                        <option value="" selected>Tipo</option>
                                            @foreach ($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="type_id" />
                                </div>
                        </div>
                        
                        <div class="flex justify-between">
                            <div class="w-full mr-2">
                                <label class="w-full text-justify" >Psid</label>
                                <input type="text" wire:model="psid" class="form-control rounded" id="formGroupExampleInput">
                            </div>

                            <div class="w-full">
                                <label class="w-full text-justify">pid</label>
                                <input type="text" wire:model="pid" class="form-control rounded" id="formGroupExampleInput">
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div class="w-full mr-2">
                                <label class="w-full text-justify" >High</label>
                                <input type="text" wire:model="high" class="form-control rounded" id="formGroupExampleInput">
                            </div>

                            <div class="w-full">
                                <label class="w-full text-justify">Basic</label>
                                <input type="text" wire:model="basic" class="form-control rounded" id="formGroupExampleInput">
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div class="w-full mr-2">
                                <label class="w-full text-justify" >Dominio</label>
                                <input type="text" wire:model="dominio" class="form-control rounded" id="formGroupExampleInput">
                            </div>

                            <div class="w-full">
                                <label class="w-full text-justify">K-detect</label>
                                <input type="text" wire:model="k_detect" class="form-control rounded" id="formGroupExampleInput">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">{{__('messages.Cerrar')}}</button>
                        <button type="button" class="btn btn-primary" wire:click="update">{{__('messages.Guardar')}}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
