<div>
    <button title="Editar usuario" type="submit" class="btn btn-success btn-sm" wire:click="open">
        <i class="fas fa-user-edit"></i>
    </button> 

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> {{__('messages.registro_ventas')}}</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold text-justify"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2> 
                
                        <hr class="m-2 p-2">
                        <div class="flex justify-end">
                            <div class="custom-control custom-switch"> 
                                <input value="1" wire:model="estado" type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">Cuenta activa</label>
                            </div>
                        </div>
                            <div class="flex justify-between">
                                <div class="w-full mr-2">
                                    <label class="w-full text-justify" >Username</label>
                                    <input type="text" wire:model="username" class="form-control rounded" id="formGroupExampleInput">
                                </div>

                                <div class="w-full">
                                    <label class="w-full text-justify">Email</label>
                                    <input type="email" wire:model="email" class="form-control rounded" id="formGroupExampleInput">
                                </div>
                            </div>
                            
                            <div class="flex justify-between mt-2">
                                <div class="form-group w-full mr-2">
                                    <label class="w-full text-justify">Balance</label>
                                    <input type="number" readonly wire:model="balance" class="form-control rounded" id="formGroupExampleInput">
                                </div>
                           
                                <div class="form-group w-full">
                                    <label class="w-full text-justify">Fecha de corte</label>
                                    <div>
                                        <div wire:ignore x-data="datepicker()">
                                            <div class="flex flex-col">
                                                <div class="flex items-center gap-2">
                                                    <input 
                                                        type="text" 
                                                        class="px-4 outline-none cursor-pointer rounded" 
                                                        x-ref="myDatepicker" 
                                                        wire:model="last_date" 
                                                        placeholder="Seleccione la fecha">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                <div class="form-group w-full mr-2">
                                    <label class="w-full text-justify">Rol </label>
                                    <select wire:model="roles_id" title="Rol de usuario" class="block w-full text-gray-400 py-2 px-2 pr-8 leading-tight rounded focus:outline-none focus:border-gray-500">
                                        <option value="" selected>Rol del usuario</option>
                                            @foreach ($roles as $rol)
                                        <option value="{{$rol->id}}">{{$rol->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="roles_id" />
                                </div>
                                <div class="form-group w-full">
                                    <label class="w-full text-justify">Plan</label>
                                    <select wire:model="plan" title="Plan" id="estado" class="block w-full text-gray-400 py-2 px-2 pr-8 leading-tight rounded focus:outline-none focus:border-gray-500" name="estado">
                                        <option value="" selected>Plan</option>
                                        <option value="7">7 días</option>
                                        <option value="15">15 días</option>
                                        <option value="30">30 días</option>
                                    </select>
                                    <x-input-error for="plan" />
                                    
                                </div>

                            </div>

                            <div class="form-group mt-2">
                                <label for="formGroupExampleInput2">Si realizas una modificación, escribe aquí el motivo</label>
                                <textarea wire:model="comentario" id="formGroupExampleInput" class="form-control resize-none rounded" cols="80" rows="5"> </textarea>
                                <x-input-error for="comentario" />
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
    @push('js')
        <script>
            document.addEventListener('alpine:init',()=>{
                Alpine.data('datepicker',()=>({
                    last_date:null,
                    fecha_fin:null,
                    init(){
                        flatpickr(this.$refs.myDatepicker, {dateFormat:'Y-m-d H:i', altInput:true, altFormat: 'F j, Y',})
                    },
                    reset(){
                        this.last_date= null;
                    }
                }))
            })
        </script>
    @endpush
</div>



