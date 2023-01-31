<div>
    <button type="submit" class="btn btn-primary btn-sm float-right mr-2" wire:click="open">
        @if ($accion == 'create')
        <i class="fas fa-plus-square mr-2"></i>Nueva publicación
        @else
        <i class="fas fa-edit"></i>
        @endif
    </button>
    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> {{__('messages.registro_ventas')}}</h5>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold"><i class="fas fa-info-circle"></i> {{__('messages.Complete_todos_los_campos_y_presiona_Guardar')}}</h2> 
                
                        <hr class="m-2 p-2">
                        <div class="flex justify-end">
                            <div class="custom-control custom-switch"> 
                                <input value="1" wire:model.lazy="estado" type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">Publicar</label>
                            </div>
                        </div>
                            <div class="justify-between ">
                                <div class="form-group">
                                        <label for="formGroupExampleInput">{{__('messages.nombre')}}</label>
                                        <input type="text" wire:model="name" class="form-control rounded" id="formGroupExampleInput">
                                        <x-input-error for="name" />
                        
                                    </div>
                                    
                            </div>

                            
                            <div class="form-group">
                                <label for="formGroupExampleInput2">{{__('messages.descripcion')}}</label>
                                <textarea wire:model="description" id="formGroupExampleInput" class="form-control resize-none rounded" cols="80" rows="5" required> </textarea>
                                <x-input-error for="description" />
                            </div>
                            <div class="flex justify-between">
                                <div class="form-group w-full mr-2">
                                    @if($vista == 'venta')
                                    <label for="formGroupExampleInput2">{{__('messages.precio')}}</label>
                                    <input type="number" wire:model="price" min="0" class="form-control rounded" id="formGroupExampleInput">
                                    <x-input-error for="price" />
                                    @else
                                    <label for="formGroupExampleInput2">{{__('messages.tasa')}}</label>
                                    <input type="number" wire:model="tasa" min="0" class="form-control rounded" id="formGroupExampleInput">
                                    <x-input-error for="tasa" />
                                    @endif
                                </div>
                                <div class="form-group w-full">
                                    <label for="formGroupExampleInput2">{{__('messages.cantidad')}}</label>
                                    <input type="number" min="0" wire:model="cant" min="0" class="form-control rounded" id="formGroupExampleInput">
                                    <x-input-error for="cant" />
                                </div>

                            </div>

                            <div class="flex justify-between">

                                <div class="form-group w-full mr-2">
                                    <label for="formGroupExampleInput2">{{__('messages.categoria')}}</label>
                                    <select wire:model="category_id" class="form-control w-full">
                                        <option value="" selected>{{__('messages.seleccion_opcion')}}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                    </select>
                                    <x-input-error for="category_id" />
                                    
                                </div>
                                
                                <div class="form-group w-full mr-2 h-full">
                                    <label for="formGroupExampleInput2">Métodos de pago</label>
                                    @foreach ($payment_methods as $payment_method)
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" name="payment_methods[]" wire:model.defer="createForm.payment_methods" type="checkbox" id="customCheckbox{{$payment_method->id}}" value="{{$payment_method->id}}">
                                        <label for="customCheckbox{{$payment_method->id}}" class="custom-control-label">{{$payment_method->name}}</label>
                                    </div>
                                    @endforeach
                            
                                </div>
                            
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
