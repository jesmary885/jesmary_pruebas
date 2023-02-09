<div x-data="{method_id: @entangle('metodo_id')}">

    <button type="submit" class="btn btn-primary btn-sm float-right" wire:click="open">
        Comprar
    </button>
    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> {{__('messages.registro_ventas')}}</h5>
                    </div>
                    <div class="modal-body">


                        <div class="flex justify-end">
                            <div>
                                <div class="mr-2 flex justify-between">
                                    <p class="text-gray-300 text-md font-semibold mt-1 mr-2">Cantidad: </p>
                                    <button type="button" class="mr-1 btn btn-secondary"
                                        disabled
                                        x-bind:disabled="$wire.qty <= 1"
                                        wire:loading.attr="disabled"
                                        wire:target="decrement"
                                        wire:click="decrement">
                                        -
                                    </button>
                                        <input wire:model="qty" autofocus type="number" min="1" max="{{$quantity}}" class="inputNumber mr-1 text-center text-sm appearance-none block text-gray-700 border border-gray-200 rounded p-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="{{$qty}}">
                                        <button type="button" class="btn btn-secondary" 
                                            x-bind:disabled="$wire.qty >= $wire.quantity"
                                            wire:loading.attr="disabled"
                                            wire:target="increment"
                                            wire:click="increment">
                                            +
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between mt-1">
                            <div class="form-group w-full mr-2 mt-4">
                                <label for="formGroupExampleInput2 mb-2">Método de pago ha utilizar</label>
                                    <select wire:model="metodo_id" class="form-control w-full">
                                        <option value="" selected>Seleccione una opción</option>
                                            @foreach ($metodos as $metodo)
                                                <option value="{{$metodo->id}}">{{$metodo->name}}</option>
                                            @endforeach
                                    </select>
                                    <x-input-error for="metodo_id" />
                            </div>
                        </div>

                        <div class="w-full" :class="{'hidden': (method_id == '1')}">
                                <div class="flex">
                                    <i class="fas fa-file-pdf mt-2 mr-2 text-gray-300"></i>
                                    <h2 class="text-md inline mt-2 text-gray-300 mb-2">Adjunte la constancia de pago</h2>
                                </div> 
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="file" wire:model="file" id="file" class="block w-full text-base font-normal text-gray-300 bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-300 focus:border-blue-600 focus:outline-none">
                                        
                                            <p class="text-gray-400 mt-2"></p>
                                            <x-input-error for="file" />
                                        </div>
                                    </div>
                                    
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
