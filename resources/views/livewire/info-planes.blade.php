<div>
<button title="Reportar pago" type="submit" class="text-blue-500 font-bold underline ml-1"  wire:click="open"> {{__('messages.aqui')}} </button> 


@if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header flex justify-between">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> {{__('messages.planes_precios')}}</h5>
                        <button type="button" class="btn" data-dismiss="modal" wire:click="close"><i class="fas fa-window-close text-white"></i></button>
                    </div>
                    <div class="modal-body">
 
                        <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fas fa-money-check"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number">PLAN BÁSICO</span>
                        <span class="info-box-text">MODALIDAD 30 DÍAS</span>
                        <span class="info-box-text">PRECIO: 6$</span>
                        </div>

                        </div>

                        <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fas fa-money-check"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number">PLAN PREMIUM</span>
                        <span class="info-box-text">MODALIDAD 15 DÍAS</span>
                        <span class="info-box-text">PRECIO: 16$</span>
                        </div>

                        </div>

                        <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fas fa-money-check"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number">PLAN PREMIUM</span>
                        <span class="info-box-text">MODALIDAD 30 DÍAS</span>
                        <span class="info-box-text">PRECIO: 30$</span>
                        </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">{{__('messages.Cerrar')}}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif



</div>
