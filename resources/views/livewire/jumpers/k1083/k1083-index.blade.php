<div x-data="{jumper_2: @entangle('jumper_2'),points_user: @entangle('points_user'), is_high: @entangle('is_high'),is_basic: @entangle('is_basic'), calc_link: @entangle('calc_link'), pid: @entangle('pid_new'), psid: @entangle('psid_register'), jumper_detect: @entangle('jumper_detect'), no_detect: @entangle('no_detect'), k_detect: @entangle('k_detect'), no_jumpear: @entangle('no_jumpear'),points_user_positive: @entangle('points_user_positive'),points_user_negative: @entangle('points_user_negative')}">
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

        <div class="flex justify-between">

            @if($psid_register == 0)
            <div class="px-4" :class="{'hidden': (psid != 0)}">
                <div class="alert alert-info alert-dismissible bg-info">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color:darkred;">×</font></font></button>
                        <h5><i class="icon fas fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Alerta!</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        Aún no has registrado tu PSID</font><font style="vertical-align: inherit;"> ,haz clic <a class="hover:text-white" href="{{route('registro.psid')}}"> aquí</a> para registrarlo
                        
                    </font></font>
                </div>
            </div>
            @endif
            @if($pid_new == 0)
            <div class="px-4" :class="{'hidden': (pid != 0)}">
                <div class="alert alert-info alert-dismissible bg-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color:darkred;">×</font></font></button>
                    <h5><i class="icon fas fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Alerta!</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    Aún no has registrado tu PID</font><font style="vertical-align: inherit;"> ,haz clic <a class="hover:font-bold" href="{{route('registro.pid')}}"> aquí</a> para registrarlo
                    </font></font>
                </div>
            </div>
            @endif

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
                            <span class="info-box-text">Ya ha generado los diez(10) jumpers permitidos durante el día</span>
                            
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

        
        @if ($jumper_detect == 8)
            <div class="px-4">
                <div class=" info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-info"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Su ip ha cambiado </span>
                            <span class="info-box-number">Por favor, cierra e inicia sesión nuevamente, para detectar tu nueva ip.</span>
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

                @endif

            @if($busqueda_link || $jumper_complete && $jumper_detect == 0)

                <div class="table-responsive">
                    <table class="table table-striped table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">{{__('messages.Tipo')}}</th>
                                    <th class="text-center">PSID</th>
                      
                                    <th class="text-center">{{__('messages.Subido')}}</th>
                                    <th class="text-center">Historial</th>
                                    <th colspan="2" class="text-center">{{__('messages.Puntuación')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{$busqueda_link->jumperType->name}}</td>
                                    <td class="text-center">{{$busqueda_link->psid}}</td>
                                    <td class="text-center">{{$busqueda_link->created_at->format('d/m/Y')}}</td>
                   
                                    <td width="10px">
                                        @livewire('jumpers.history', ['jumper' => $busqueda_link])
                                    </td>
                                        
                                    <td width="10px">
                                        <button
                                            class="py-2 px-3 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                                            x-bind:disabled="points_user_positive == 'si'"
                                            wire:click="positivo('{{$busqueda_link->id}}')"
                                            title="Positivo"
                                            wire:loading.attr="disabled">
                                            <i class="font-semibold far fa-thumbs-up">{{$busqueda_link->positive_points}}</i>
                                        </button>
                                    </td>
                                    <td width="10px">
                                        <button
                                            class="py-2 ml-2 px-3 text-md font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" 
                                            x-bind:disabled="points_user_negative == 'si'"
                                            wire:click="negativo('{{$busqueda_link->id}}')"
                                            title="Negativo"
                                            wire:loading.attr="disabled">
                                            <i class="font-semibold far fa-thumbs-down">{{$busqueda_link->negative_points}}</i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                    </table>

                </div>

                <div class="grid md:grid-cols-3 gap-4 mt-4 card container">

                <aside class="md:col-span-1 p-2">
                    @if($jumper_detect_k  != '')
                        <div class="info-box mb-3 bg-info">
                        
                            <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                <div class="info-box-content">
                                    @if($busqueda_link)
                                    <span class="info-box-text font-bold">Tipo {{$busqueda_link->jumperType->name}}</span>
                                    @else
                                    <span class="info-box-text">Tipo No identificado</span>
                                    @endif
                                    <span class="info-box-number">Dominio: {{$busqueda_link->jumper}}</span>
                                </div>
                        
                        </div>
                    @endif
                    @if($k_detect != 0)
                        <div class="info-box mb-3 bg-success" :class="{'hidden': (k_detect == '0')}">
                            
                            <span class="info-box-icon"><i class="far fa-heart"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Detectada una posible</span>
                                    <span class="info-box-number">{{$k_detect}}</span>
                                </div>
                            
                        </div>
                    @endif

                </aside>
                <div class="md:col-span-2">
                    <div class="flex justify-between">
                        <div class=" mt-2 mr-2 ml-2 flex-1 ">
                                <textarea wire:model.defer="comentario" class="form-control" id="formGroupExampleInput" name="comentario" cols="80" rows="2" placeholder="{{__('messages.comparte_experiencia')}}"></textarea>
                        </div>

                        <div class="mt-3 mb-2">
                            <button
                                class="btn btn-primary" 
                                wire:click="comentar('{{$busqueda_link->id}}')"
                                title="{{__('messages.Guardar')}}">
                                {{__('messages.Guardar')}}
                            </button>

                        </div>
                    </div>
                        <div class="card container ml-2">
                            @if ($comments)
                                @foreach ($comments as $comment)
                                    <div class="flex justify-between card-body">
                                        <div class="">
                                            <p class="text-gray-200 text-lg font-semibold">{{$comment->user->name}}</p>
                                            <p class="text-gray-200 text-sm ">{{$comment->created_at->format('d/m/Y h:i')}}</p>
                                        </div>
                                        <div class="flex-1 ml-4 text-justify overflow-x-auto">
                                            <p class="text-white font-semibold text-justify">{{$comment->comment}}</p>
                                        </div>
                                        
                                    </div>

                                    <hr class="m-2">
                                @endforeach

                                <div class="m-2">
                                    {{$comments->links()}}
                                </div>
                            @else
                                <div class="card-body">
                                    <strong>{{__('messages.sin_comentarios')}}</strong>
                                </div>
                            @endif
                        </div>

                </div>
     
            </div>
        @endif

        

        <div class="m-2 mb-2">
            @if($no_detect != 0)
                <div class="info-box mb-3 bg-info" :class="{'hidden': (no_detect == '0')}">
                        
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">No se encuentra en nuestros registros</span>
                        <span class="info-box-number">Si deseas registrarla, pega en nuestro buscador "SSI DKR" el link de la encuesta</span>
                    </div>
                            
                </div>
            @endif
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

        <script>

            Livewire.on('wait', function(){

                Swal.fire(
                'Espere un momento, se esta procesando su jumper',
                'Esta siendo redireccionado...',
                )

            })

        </script>
    @stop
</div>

