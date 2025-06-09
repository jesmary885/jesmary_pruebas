<div>
    <div class="card">

        <div class="card-header">

            <div class="flex justify-between mt-4 " >

                <div class="input-group">
                    <input wire:model.defer="search" placeholder="Introduzca el jumper" id="validationCustomUsername" class="form-control" aria-describedby="inputGroupPrepend" >
                        @if($search)
                                <div class="input-group-prepend">
                                    <button class="btn btn-md btn-outline-secondary input-group-text" id="inputGroupPrepend" wire:click="clear" title="Borrar">
                                            <i class="fas fa-backspace"></i>
                                    </button>
                                </div>
                        @endif
                </div>

                <div >
                        <button type="submit" class="btn bg-info  ml-2 " wire:click="procesar">
                            PROCESAR
                        </button>
                </div>
            </div>

        </div>



        @if ($jumper_complete == [])
        <div class="flex justify-center">
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
        
        @endif

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



            <div class="card-body mt-0">

                @if ($jumper_complete)

                    <div class="flex-nowrap justify-center callout callout-info w-full">
                    
                        
                        <p  class="text-blue-400 text-clip text-sm text-center font-bold mb-2" id="jumper_copy">{{$jumper_complete}}</p>

                        <div class="flex justify-center">
                            <button onclick="copiarAlPortapapeles('jumper_copy')" class="btn btn-sm btn-success text-bold" title="{{__('messages.copiar_portapapeles')}}" id="button_copy">Copiar</button> 
                        </div>
                                
                        
                    </div>

                    @if($opcion == 3 || $opcion == 4)


                        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                            <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                                    <tr>
                                        @if($opcion == 3)
                                            <th class="text-center">Tiempo</th>
                                        @endif
                                        <th class="text-center">Monto</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Puntuación</th>
                                        


                                        </tr>
                                    </thead>
                                    <tbody>
                   
                                            <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">

                                                @if($opcion == 3)

                                                 <td class="text-center">{{$time}}</td>

                                                 @endif

                                                <td class="text-center">{{$monto}}</td>
                                                <td class="text-center">{{$registro['payout']}}</td>
                                                <td class="text-center">{{ $this->type($informacion_complete[$jumper_complete]) }}</td>

                                                  @if($this->tipo_total == 'si')
                                                <i class="font-semibold far fa-thumbs-up text-blue-600 mr-2">{{$this->positive($this->type($jumper_complete))}}</i>

                                                <i class="font-semibold far fa-thumbs-down text-red-600">{{$this->negative($this->type($jumper_complete))}}</i>
                                                @else

                                                    <p>-</p>

                                                @endif
                                            
                                             
                                            


                                            </tr>
                    
                                    </tbody>
                            </table>

                            <div class="input-group mt-5">
                                <input wire:model="jumper_search" placeholder="Ingrese el jumper de la encuesta" id="validationCustomUsername" class="form-control" aria-describedby="inputGroupPrepend" >
                                <div class="mt-6" >
                                    <button type="submit" class="btn bg-info " wire:click="consultar">
                                        CONSULTAR
                                    </button>
                                </div>
                                @if($jumper_search)
                                <div class="input-group-prepend">
                                    <button class="btn btn-md btn-outline-secondary input-group-text" id="inputGroupPrepend" wire:click="clear" title="Borrar">
                                            <i class="fas fa-backspace"></i>
                                    </button>
                                </div>
                                @endif
                            </div>


                            @if ($respuesta)

                                <div class="mt-4 w-full">
                                    <p  class="text-blue-400 text-clip text-sm text-center font-bold mb-2">{{$respuesta['jumper']}}</p>   
                                </div>
                
                            @endif
                        </div>

                    @endif

                @endif


    </div>

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
