<div>
    <button type="submit" class="btn btn-primary btn-sm float-right mr-2" wire:click="open">
        <i class="fas fa-edit"></i>
    </button>
    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> Registro de compra</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group w-full mr-2 h-full">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio" value="1" wire:model="status">
                                <label for="customRadio1" class="custom-control-label text-lg font-semibold text-gray-300">Recibido</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input class="custom-control-input custom-control-input-danger" type="radio" id="customRadio2" value="2" name="customRadio" wire:model="status">
                                <label for="customRadio2" class="custom-control-label text-lg font-semibold text-gray-300">No recibido</label>
                            </div>
                        </div>

                        @if($status == '1')
                        <hr class=" text-gray-50 p-2">
                                <div>
                                        <div class="form-group w-full h-full mt-2 ml-2">
                                            <p class="text-md font-semibold mb-2">Tus puntos hacia el producto</p>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio10" name="customRadio2" value="1" wire:model.defer="ptos_producto">
                                                <label for="customRadio10" class="custom-control-label"><p class="text-gray-700 text-md"> <i class="fas fa-star text-md text-yellow-400"></i></p></label>
                                            </div>

                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio11" value="2" name="customRadio2" wire:model.defer="ptos_producto">
                                                <label for="customRadio11" class="custom-control-label flex"><p class="text-gray-700 text-md"> <i class="fas fa-star text-md text-yellow-400"></i> <i class="fas fa-star text-md text-yellow-400"></i></p></label>
                                            </div>

                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio12" value="3" name="customRadio2" wire:model.defer="ptos_producto">
                                                <label for="customRadio12" class="custom-control-label flex"><p class="text-gray-700 text-md"> <i class="fas fa-star text-md text-yellow-400"></i> <i class="fas fa-star text-md text-yellow-400"></i> <i class="fas fa-star text-md text-yellow-400"></i></p></label>
                                            </div>

                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio13" value="4" name="customRadio2" wire:model.defer="ptos_producto">
                                                <label for="customRadio13" class="custom-control-label flex"><p class="text-gray-700 text-md"> <i class="fas fa-star text-md text-yellow-400"></i> <i class="fas fa-star text-md text-yellow-400"></i> <i class="fas fa-star text-md text-yellow-400"></i> <i class="fas fa-star text-md text-yellow-400"></i></p></label>
                                            </div>

                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="customRadio14" value="5" name="customRadio2" wire:model.defer="ptos_producto">
                                                <label for="customRadio14" class="custom-control-label flex"><p class="text-gray-700 text-md"> <i class="fas fa-star text-md text-yellow-400"></i> <i class="fas fa-star text-md text-yellow-400"></i> <i class="fas fa-star text-md text-yellow-400"></i> <i class="fas fa-star text-md text-yellow-400"></i> <i class="fas fa-star text-md text-yellow-400"></i></p></label>
                                            </div>
                                        </div>
                                </div>
                            @endif

                        <hr class=" text-gray-50 p-2">

                        <div class="flex justify-center">
                            <p class="text-gray-300 font-semibold text-lg">¿Cómo fue tu experiencia con el vendedor?</p>
                        </div>

                        <div class="form-group w-full mt-3 h-full flex justify-center">
                            <div>
                                <button type="button" class="btn btn-block btn-success btn-lg"  wire:click="positivo">Positiva</button>
                            </div>

                            <div>
                                <button type="button" class="btn btn-block btn-danger btn-lg ml-2" wire:click="negativo">Negativa</button>
                            </div>
                        </div>

                            @if($condicion_venta == 'positivo')

                            <p class="mt-2 text-md font-semibold mb-2">Comentarios automáticos sobre el vendedor</p>

                            <div class="form-group w-full mr-2 h-full ml-2">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="1" wire:model="educado">
                                    <label for="customCheckbox1" class="custom-control-label font-semibold">Educado y amable</label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox2" value="1" wire:model="seguro">
                                    <label for="customCheckbox2" class="custom-control-label font-semibold">Seguro y confiable</label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="customCheckbox3" value="1" wire:model="rapido">
                                    <label for="customCheckbox3" class="custom-control-label font-semibold">Transacción rápida</label>
                                </div>
                            </div>
                            @endif

                            @if($condicion_venta == 'negativo')

                            <p class="mt-2 text-md font-semibold mb-2">Comentarios automáticos sobre el vendedor</p>

                            <div class="form-group w-full mr-2 h-full ml-2">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" value="1" wire:model="maleducado">
                                    <label for="customCheckbox4" class="custom-control-label font-semibold">Maleducado y malhablado</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox5" value="1" wire:model="no_confiable">
                                    <label for="customCheckbox5" class="custom-control-label font-semibold">No confiable</label>
                                </div>
                        </div>
                            @endif


                            <div class=" mt-2">
                                <textarea wire:model.defer="comentario_enviar" class="form-control" id="formGroupExampleInput" name="comentario_enviar" cols="80" rows="2" placeholder="Comentarios que desee que vea el comprador en el chat"></textarea>
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