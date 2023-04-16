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
            </div>
            

        </div>

        @if ($jumper_detect == 2)
            <div class="px-4">
                <div class=" info-box bg-warning">
                    <span class="info-box-icon"><i class="far fa-sad-tear"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Lo siento.</span>
                            <span class="info-box-number">Ha ocurrido un error al generar el jumper...</span>
                        </div>
                </div>

            </div>
        @endif

        @if ($jumper_detect == 5)
            <div class="px-4">
                <div class=" info-box bg-info">
                    <span class="info-box-icon"><i class="	fas fa-info"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Ha ocurrido un error al generar el jumper.</span>
                            <span class="info-box-number">Intentelo de nuevo...</span>
                        </div>
                </div>

            </div>
        @endif

        @if ($jumper_detect == 3)
            <div class="px-4">
                <div class=" info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Algo en su link no esta bien. </span>
                            <span class="info-box-number">Copielo correctamente...</span>
                        </div>
                </div>
            </div>
        @endif

        @if ($jumper_detect == 6)
            <div class="px-4">
                <div class=" info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-info"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Esta intentando generar más de 6 jumpers en menos de 30 min. </span>
                            <span class="info-box-number">Intentelo luego.</span>
                        </div>
                </div>
            </div>
        @endif

        @if ($jumper_detect == 7)
            <div class="px-4">
                <div class=" info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-info"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Esta intentando generar el mismo link más de dos veces. </span>
                            <span class="info-box-number">Intentelo de nuevo con otro link.</span>
                        </div>
                </div>
            </div>
        @endif

        @if ($jumper_complete == "")

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

        @endif

    </div>

    <div class="card-body mt-0">

        

                @if ($jumper_complete)

                <div class="flex-nowrap justify-center callout callout-info">
                
                      
                    <p  class="text-blue-400 text-clip text-md text-center font-bold mb-2" id="jumper_copy">{{$jumper_complete['jumper']}}</p>

                    <div class="flex justify-center">
                        <button onclick="copiarAlPortapapeles('jumper_copy')" class="btn btn-sm btn-success text-bold" title="{{__('messages.copiar_portapapeles')}}" id="button_copy">Copiar</button> 
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




    @stop

</div>