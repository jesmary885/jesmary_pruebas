<div x-data="{jumper_complete: @entangle('jumper_complete'), pid: @entangle('pid_new'), psid: @entangle('psid_register')}">
    <div class="card">
        <div class="card-header form-row">

            <div class="col-sm-12 col-lg-13 col-xl-14">

                <div class="input-group">
                    <input wire:model="search" placeholder="" id="validationCustomUsername" class="form-control" aria-describedby="inputGroupPrepend" >
                    @if($search)
                            <div class="input-group-prepend">
                                <button class="btn btn-md btn-outline-secondary input-group-text" id="inputGroupPrepend" wire:click="clear" title="Borrar">
                                        <i class="fas fa-backspace"></i>
                                </button>
                            </div>
                    @endif
                </div>
                @if ($pid_detectado == 'no')
                <div class="flex justify-center mb-2 mt-2">
                    <div>
                        <input type="number" wire:model.defer="pid_manual" class="rounded-sm bg-light py-1 px-1"  placeholder="{{__('messages.ingrese_pdi')}}">
                        <x-input-error for="pid_manual" />
                    </div>
                    <div>
                        <button
                            class="btn-outline-secondary px-2 py-1 ml-2" 
                            wire:click="jumpear()">
                            <i class="font-semibold fas fa-sync"></i>
                                                    
                        </button>
                    </div>
                </div>
            @endif
            </div>
            

        </div>

        <div class="mt-4" wire:loading>
            <div class="container2">
                <div class="cargando">
                    <div class="pelotas"></div>
                    <div class="pelotas"></div>
                    <div class="pelotas"></div>
                    <span class="texto-cargando font-bold text-gray-300 ">Loading...</span>
                </div>
            </div>
        </div>

    </div>

    <div class="card-body mt-0">

        

                @if ($jumper_complete )

                <div class="flex-nowrap justify-center callout callout-info">
                
                      
                    <p  class="text-blue-400 text-clip text-sm text-center font-bold mb-2" id="jumper_copy">{{$jumper_complete}}</p>

                    <div class="flex justify-center">
                        <button onclick="copiarAlPortapapeles('jumper_copy')" class="btn btn-sm btn-success text-bold" title="{{__('messages.copiar_portapapeles')}}" id="button_copy">Copiar</button> 
                    </div>
                            
                    
                </div>

                @endif

    @if ($jumper_detect == 2)
        <div>
        <div class=" info-box bg-warning">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Algo en su link no esta bien. </span>
                        <span class="info-box-number">Copielo correctamente...</span>
                    </div>
            </div>

        </div>
            

    @endif

    @if ($jumper_detect == 3)
        <div>
        <div class=" info-box bg-warning">
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ha ocurrido un error. </span>
                        <span class="info-box-number">Intentelo de nuevo...</span>
                    </div>
            </div>

        </div>
            

    @endif

  

    <style>
     .container2{   
     display: grid;
         place-content: center;
         height: 100px;
     }
     .cargando{
         width: 120px;
         height: 30px;
         display: flex;
         flex-wrap: wrap;
         align-items: flex-end;
         justify-content: space-between;
     margin: 0 auto; 
     }
     .texto-cargando{ 
     padding-top:10px
     }
     .cargando span{
         font-size: 20px;
         text-transform: uppercase;
     }
     .pelotas {
         width: 30px;
         height: 30px;
         background-color: #00b8de;
         animation: salto .5s alternate
         infinite;
     border-radius: 50%  
     }
     .pelotas:nth-child(2) {
         animation-delay: .18s;
     }
     .pelotas:nth-child(3) {
         animation-delay: .37s;
     }
     @keyframes salto {
         from {
             transform: scaleX(1.25);
         }
         to{
             transform: 
             translateY(-50px) scaleX(1);
         }
     }
    </style>

@section('js')
        <script>
            function copiarAlPortapapeles(id_elemento) {
                /*var aux = document.createElement("input");
                aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);
                document.body.appendChild(aux);
                aux.select();
                document.execCommand("copy");
                document.body.removeChild(aux);*/
                
                var codigoACopiar = document.getElementById(id_elemento);
                var seleccion = document.createRange();
                seleccion.selectNodeContents(codigoACopiar);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(seleccion);
                var res = document.execCommand('copy');
                window.getSelection().removeRange(seleccion);

                toastr.options={
                    "closeButton": true,
                    "debug": true,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.success('Copy..')
            }
        </script>

        <script>

            Livewire.on('wait', function(){

                toastr.options={
                    "closeButton": true,
                    "debug": true,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr.success('Momento')

            })

        </script>

    @stop

</div>
