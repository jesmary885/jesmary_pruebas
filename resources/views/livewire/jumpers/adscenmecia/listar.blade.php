<div>
    <div class="card">

        <div class="card-body">

            
            <div class="grid md:grid-cols-4 gap-2">


                    <div class="col-span-3">
                        <div class="form-group w-full">
                                  
                                    <select wire:model.defer="type" title="type" id="type" class="block w-full text-gray-400 py-2 px-2 pr-8 leading-tight rounded focus:outline-none focus:border-gray-500" name="estado">
                                        <option value="" selected>Seleccione un enrutador</option>
                                        <option value="Inbrain">Inbrain</option>
                                        <option value="Bitlabs">Bitlabs</option>
                                        <option value="CInt">CInt</option>
                                        <option value="cpx">cpx</option>
                                        <option value="Opinion Network">Opinion Network</option>
                                        <option value="Toluna">Toluna</option>
                                        <option value="Grabpoints">Grabpoints</option>
                                        <option value="Uniflow">Uniflow</option>
                                        <option value="ipso">Ipso</option>
                                        <option value="purespectrum">Purespectrum</option>

                                    </select>
                                    <x-input-error for="type" />
                                    
                        </div>

                
                    </div>
   
            </div>

        </div>

        <div class="card-footer">
            <div>
                <button type="submit" class="btn bg-info " wire:click="procesar">
                    PROCESAR
                </button>
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




        @if($jumper_complete)
            <div class="card">

                <div class="card-body mt-0">
                        <div class="card m-4">
            
                            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                                <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                                        <tr>

                                            <th class="text-center"></th>

                                            <th class="text-center">Monto</th>
                                            <th class="text-center">Tiempo</th>
            
                                            <th class="text-center">Link</th>
                                            

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jumper_complete['surveys'] as $registro)
                                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">

                                                     <th class=" text-center  text-white">
                                                    
                                                        <div class="flex justify-center">
                                                            <button onclick="copiarAlPortapapeles('jumper_copy_{{ $loop->index }}')" class="btn btn-sm btn-success text-bold" title="{{__('messages.copiar_portapapeles')}}" id="button_copy">Copiar Link</button> 
                                                        </div>

                                                    </th>

                                                    <td class="text-center">{{$registro['monto']}}</td>
                                                    <td class="text-center">{{$registro['minutos']}} min.</td>

                                                   

                                                    <td class="text-center" ><p  class="text-blue-400 font-bold " id="jumper_copy_{{ $loop->index }}"> {{$registro['encuesta']}}</p></td>
                                                    

                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
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
