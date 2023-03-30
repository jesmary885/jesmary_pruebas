<div>
<button title="Reportar pago" type="submit" class="text-blue-500 font-bold underline ml-1"  wire:click="open"> {{__('messages.aqui')}} </button> 


@if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header flex justify-between">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> Métodos de pago de QuerySet</h5>
                        <button type="button" class="btn" data-dismiss="modal" wire:click="close"><i class="fas fa-window-close text-white"></i></button>
                    </div>
                    <div class="modal-body">
 
                        <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fas fa-money-check"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number">TRANSFERENCIA BANESCO</span>
                        <span class="info-box-text">0134-0197-7419-7202-9293</span>
                        <span class="info-box-text">Luz Marina Mata</span>
                        <span class="info-box-text">Ahorro</span>
                        <span class="info-box-text">C.I. 4.909.173</span>
                        </div>

                        </div>

                        <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fas fa-money-check"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number">PAGO MÓVIL</span>
                        <span class="info-box-text">BANESCO (0134)</span>
                        <span class="info-box-text">04148264029</span>
                        <span class="info-box-text">C.I 4.909.173</span>

                        </div>

                        </div>

                        <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fas fa-money-check"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number">USDT BINANCE & ZINLI</span>
                        <span class="info-box-text">queryset2023@gmail.com</span>
                        </div>

                        </div>

                        <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fas fa-money-check"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number">LTC</span>
                        <span class="info-box-text">LhN6JGt9EvQSh9m3TQKDVgEAg9q8GE5sR1</span>
             

                        </div>

                        </div>

                        <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fas fa-money-check"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number">BINANCE</span>
                        <span class="info-box-text">Pay ID= 445952798</span>
                        </div>

                        </div>

                        <div class="info-box mb-3 bg-info">
                        <span class="info-box-icon"><i class="fas fa-money-check"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-number">PAYEER PAY</span>
                        <span class="info-box-text">P1064078846</span>
             

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
