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

                        <div class="timeline">

                            <div class="time-label">
                                <span class="bg-red">Métodos de pago</span>
                            </div>
                            
                            
                            <div>
                                <i class="	fas fa-money-check bg-cyan"></i>
                                <div class="timeline-item">
                            
                                    <h3 class="timeline-header">TRANSFERENCIA</h3>
                                    <div class="timeline-body">
                                        <p class="info-box-text">Banco: Banesco</p>
                                        <p class="info-box-text">Nro de cuenta: 0134-0197-7419-7202-9293</p>
                                        <p class="info-box-text">Beneficiario: Luz Marina Mata</p>
                                        <p class="info-box-text">Tipo de cuenta: Ahorro</p>
                                        <p class="info-box-text">Nro de cédula: 4.909.173</p>
                                    </div>
                                  
                                </div>
                            </div>
                            
                            <div>
                                <i class="	fas fa-receipt bg-cyan"></i>
                                <div class="timeline-item">
                            
                                    <h3 class="timeline-header">PAGO MÓVIL</h3>
                                    <div class="timeline-body">
                                        <p class="info-box-text">Banco: Banesco (0134)</p>
                                        <p class="info-box-text">Tlf: 04148264029</p>
                                        <p class="info-box-text">Nro de cédula: 4.909.173</p>
                                    </div>
                                 
                                </div>
                            </div>
                            
                            <div>
                                <i class="		fas fa-donate bg-cyan"></i>
                                <div class="timeline-item">
                            
                                    <h3 class="timeline-header">USDT BINANCE & ZINLI</h3>
                                    <div class="timeline-body">
                                        <p class="info-box-text">Correo: queryset2023@gmail.com</p>
                                       
                                    </div>
                              
                                </div>
                            </div>

                            <div>
                                <i class="	far fa-credit-card bg-cyan"></i>
                                <div class="timeline-item">
                            
                                    <h3 class="timeline-header">LTC</h3>
                                    <div class="timeline-body">
                                        <p class="info-box-text">Cuenta: LhN6JGt9EvQSh9m3TQKDVgEAg9q8GE5sR1</p>
                           
                                    </div>
                              
                                </div>
                            </div>

                            <div>
                                <i class="	fas fa-file-invoice-dollar bg-cyan"></i>
                                <div class="timeline-item">
                            
                                    <h3 class="timeline-header">BINANCE</h3>
                                    <div class="timeline-body">
                                        <p class="info-box-text">Pay ID= 445952798</p>
                 
                                    </div>
                                    <div class="timeline-footer">
        
                                    </div>
                                </div>
                            </div>

                            <div>
                                <i class="fas fa-money-check-alt bg-cyan"></i>
                                <div class="timeline-item">
                            
                                    <h3 class="timeline-header">PAYEER PAY</h3>
                                    <div class="timeline-body">
                                        <p class="info-box-text">Pay ID= P1064078846</p>
                 
                                    </div>
                                    <div class="timeline-footer">
        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="time-label">
                                <span class="bg-red">PLANES</span>
                            </div>
                            
                            
                            <div>
                                <i class="	fas fa-chess-bishop bg-cyan"></i>
                                <div class="timeline-item">
                            
                                    <h3 class="timeline-header">PLAN BÁSICO</h3>
                                    <div class="timeline-body">
                                        <p class="info-box-text">Precio: 10$</p>
                                        <p class="info-box-text">Tiempo: 30 DÍAS</p>
                 
                                    </div>
                                    <div class="timeline-footer">
        
                                    </div>
                                </div>
                            </div>


                            <div>
                                <i class="	fas fa-chess-queen bg-cyan"></i>
                                <div class="timeline-item">
                            
                                    <h3 class="timeline-header">PLAN PREMIUM 30</h3>
                                    <div class="timeline-body">
                                        <p class="info-box-text">Precio: 25$</p>
                                        <p class="info-box-text">Tiempo: 30 DÍAS</p>
                                        <p class="info-box-text">Importante: Consultar disponibilidad con los admnistradores</p>
                 
                                    </div>
                                    <div class="timeline-footer">
        
                                    </div>
                                </div>
                            </div>

                            <div>
                                <i class="	fas fa-chess-queen bg-cyan"></i>
                                <div class="timeline-item">
                            
                                    <h3 class="timeline-header">PLAN PREMIUM 10</h3>
                                    <div class="timeline-body">
                                        <p class="info-box-text">Precio: 10$</p>
                                        <p class="info-box-text">Tiempo: 10 DÍAS</p>
                                        <p class="info-box-text">Importante: Consultar disponibilidad con los admnistradores</p>
                 
                                    </div>
                                    <div class="timeline-footer">
        
                                    </div>
                                </div>
                            </div>

                            <div>
                                <i class="	fas fa-chess-queen bg-cyan"></i>
                                <div class="timeline-item">
                            
                                    <h3 class="timeline-header">PLAN PREMIUM 2</h3>
                                    <div class="timeline-body">
                                        <p class="info-box-text">Precio: 3$</p>
                                        <p class="info-box-text">Tiempo: 02 DÍAS</p>
                                        <p class="info-box-text">Importante: Consultar disponibilidad con los admnistradores</p>
                 
                                    </div>
                                    <div class="timeline-footer">
        
                                    </div>
                                </div>
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
