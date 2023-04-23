<div x-data="{jumper_2: @entangle('jumper_2'),points_user: @entangle('points_user'), is_high: @entangle('is_high'),is_basic: @entangle('is_basic'), calc_link: @entangle('calc_link'), pid: @entangle('pid_new'), psid: @entangle('psid_register'), jumper_detect: @entangle('jumper_detect'), no_detect: @entangle('no_detect'), k_detect: @entangle('k_detect'), no_jumpear: @entangle('no_jumpear'),points_user_positive: @entangle('points_user_positive'),points_user_negative: @entangle('points_user_negative'),descalific_active: @entangle('descalific_active'), router_cint_detect: @entangle('router_cint_detect')}">
    <div class="card">
        <div class="card-header form-row">

            <div class="col-sm-5 col-lg-7 col-xl-8">

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

            <div class="mr-1">
                @livewire('jumpers.ssidkr.ssidkr-create')
            </div>

            <div class="mr-1">
                @livewire('jumpers.ssidkr.ssidkr-create-high')
            </div>

             @if($jumper_complete != 0 || $jumper != "")
             <div class="input-group-prepend show">
                    <button type="button" class="btn btn-default dropdown-toggle btn-secondary" data-toggle="dropdown" aria-expanded="true">
                        Generadores
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <div class=" hover:bg-gray-700 w-full h-full ">
                            <button
                                class="text-white text-xs font-bold ml-2 hover:text-slate-500" 
                                wire:click="qt">
                                Quick Thoughts
                            </button>

                        </div>
                        <div class="dropdown-divider"></div>
                        <div class=" hover:bg-gray-700 w-full h-full ">
                            <button
                                class="text-white text-xs font-bold ml-2 hover:text-slate-500" 
                                wire:click="sp">
                                Saltador Pre-Encuesta
                            </button>
                        </div>
                    </div>
                </div>

             
             @endif

        </div>

        @if($descalific_active == 1)

        <div class="px-4">
                <div class="alert bg-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color:darkred;">×</font></font></button>
                    <h5><i class="icon fas fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Descalificación procesada!</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    </font></font>
                </div>
            </div>

        @endif


        <div class="flex justify-between">

            @if($psid_register == 0)
            <div class="px-4" :class="{'hidden': (psid != 0)}">
                <div class="alert bg-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color:darkred;">×</font></font></button>
                        <h5><i class="icon fas fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Alerta!</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        Aún no has registrado tu PSID</font><font style="vertical-align: inherit;"> ,haz clic <a class="hover:text-white" href="{{route('registro.psid')}}"> aquí</a> para registrarlo
                        
                    </font></font>
                </div>
            </div>
            @endif
            @if($pid_new == 0)
            <div class="px-4" :class="{'hidden': (pid != 0)}">
                <div class="alert bg-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color:darkred;">×</font></font></button>
                    <h5><i class="icon fas fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Alerta!</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    Aún no has registrado tu PID</font><font style="vertical-align: inherit;"> ,haz clic <a class="hover:font-bold" href="{{route('registro.pid')}}"> aquí</a> para registrarlo
                    </font></font>
                </div>
            </div>
            @endif

        </div>

       
        @if ($jumper_complete != 0 && $jumper != "" && $calc_link == 1 && $no_jumpear == 0)
            <div class="card-body mt-0">

                <div class="flex-nowrap justify-center callout callout-info">
                    <div>
                        <p class="text-cyan-400 text-md text-center font-bold mb-1 " id="jumper_copy">{{$jumper_complete}}</p>
                        
                    </div>
        @endif
                    <div>
                        <div>
                            <div>
                                @if ($jumper_complete != 0 && $jumper != "" && $calc_link == 1 && $no_jumpear == 0)
                                    <div class="flex justify-center">
                                    <button onclick="copiarAlPortapapeles('jumper_copy')" class="btn btn-sm bg-success rounded-lg text-bold" title="{{__('messages.copiar_portapapeles')}}" id="button_copy">Copiar</button> 

                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                @if ($jumper_complete != 0 || $jumper != "")

                </div>

                <div class="mt-2 mb-2">
                    @if($jumper_complete_qt != '')

                    <div class="flex-nowrap justify-center callout callout-info">
                 
                    <h5 class="text-sm"><i class="text-white mr-1 fas fa-cloud"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tu enlace de QuickThoughts:</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    <div>
                        <p class="text-gray-100 text-sm text-center font-bold mb-1 mt-2" id="jumper_copy_qt">{{$jumper_complete_qt}}</p>

                        <div class="flex justify-center">
                            <button onclick="copiarAlPortapapeles_qt('jumper_copy_qt')" class="btn btn-sm bg-success rounded-lg text-bold" title="{{__('messages.copiar_portapapeles')}}" id="button_copy_qt">Copiar</button> 

                        </div>
                        
                    </div>
                    </div>


            
                    @endif
                </div>

                <div class="mt-2 mb-2">
                    @if($jumper_complete_sp != '')

                    <div class="flex-nowrap justify-center callout callout-info">
                  
                    <h5 class="text-sm"><i class="text-white mr-1 icon fas fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tu enlace Saltador Pre-encuesta:</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    <p class="text-gray-100 text-sm text-center font-bold mb-1 mt-2" id="jumper_copy_sp">{{$jumper_complete_sp}}</p>

                        <div class="flex justify-center">
                            <button onclick="copiarAlPortapapeles_sp('jumper_copy_sp')" class="btn btn-sm bg-success rounded-lg text-bold" title="{{__('messages.copiar_portapapeles')}}" id="button_copy_sp">Copiar</button> 

                        </div>
                    </font></font>
                    </div>
                    @endif
                </div>


                <div class="table-responsive">
                        <table class="table table-striped table-responsive">
                                <thead class="thead-dark">
                                    <tr>
                                        @if($jumper->jumper_type_id == 1 || $jumper->jumper_type_id == 2)
                                        <th class="text-center">{{__('messages.Tipo')}}</th>
                                        @endif
                                        <th class="text-center">PSID</th>
                                        @if($jumper->jumper_type_id == 1 || $jumper->jumper_type_id == 2)
                                        <th class="text-center">{{$jumper->jumperType->name}}</th>
                                        @endif
                                        <th class="text-center">{{__('messages.Subido')}}</th>
                                        <th class="text-center" :class="{'hidden': (is_high == 'no')}">PID</th>
                                        <th class="text-center">Historial</th>
                                        <th colspan="2" class="text-center">{{__('messages.Puntuación')}}</th>
                                        <th colspan="1" class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @if($jumper->jumper_type_id == 1 || $jumper->jumper_type_id == 2)
                                        <td class="text-center">{{$jumper->jumperType->name}}</td>
                                        @endif
                                        <td class="text-center">{{$jumper->psid}}</td>
                                        <td class="text-center" :class="{'hidden': (is_high == 'no')}"> {{$calculo_high}}</td>
                                        <td class="text-center" :class="{'hidden': (is_basic == 'no')}">{{$jumper->basic}}</td>
                                        <td class="text-center">{{\Carbon\Carbon::parse($jumper->created_at)->format('d-m-Y h:i')}}</td>
                                        <td class="text-center" :class="{'hidden': (is_high == 'no')}"> 
                                            <div class="flex justify-center">
                                        
                                                <div >
                                                    <input type="number" wire:model.defer="pid_new" class="rounded-sm bg-light py-1 px-1"  placeholder="{{__('messages.ingrese_pdi')}}">
                                                    <x-input-error for="pid_new" />
                                                </div>
                                                <div>
                                                    <button
                                                        class="btn-outline-secondary py-1 ml-2" 
                                                        wire:click="calculo_high('{{$jumper->id}}')">
                                                        <i class="font-semibold fas fa-sync"></i>
                                                
                                                    </button>
                                                </div>
                                            </div>
                                        </td>

                                        <td width="10px">
                                            @livewire('jumpers.history', ['jumper' => $jumper])
                                        </td>
                                            
                                        <td width="10px">
                                            <button
                                                class="py-2 px-3 text-md font-medium text-center text-white bg-info rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                                                x-bind:disabled="points_user_positive == 'si'"
                                                wire:click="positivo('{{$jumper->id}}')"
                                                wire:loading.attr="disabled"
                                                title="Positivo">
                                                <i class="font-semibold far fa-thumbs-up">{{$jumper->positive_points}}</i>
                                            </button>
                                        </td>
                                        <td width="10px">
                                        <button
                                                class="py-2 px-3 text-md font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" 
                                                x-bind:disabled="points_user_negative == 'si'"
                                                wire:click="negativo('{{$jumper->id}}')"
                                                wire:loading.attr="disabled"
                                                title="Negativo">
                                                <i class="font-semibold far fa-thumbs-down">{{$jumper->negative_points}}</i>
                                        </button>
                                        </td>

                        
                                        <td width="10px">
                                            <button
                                                class="py-2 px-3 text-md font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" 
                                                wire:click="descalificador()"
                                                title="Descalificador">
                                               Descalificar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                        </table>

                </div>
             
                

                <div class="grid md:grid-cols-3 gap-4 mt-4 card">
                    <aside class="md:col-span-1 p-2">
                        @if($jumper_detect != 0)
                            <div class="info-box mb-3 bg-info" :class="{'hidden': (jumper_detect == '0')}">
                          
                                    <div class="info-box-content">
                                        <span class="info-box-text font-bold">Dominio:</span>
                                        <span class="info-box-text sm:text-sm md:text-md">{{$jumper_detect}}</span>
                                        @if($k_detect != '0')
                                        <span class="info-box-text font-bold">Detectada una posible:</span>
                                    <span class="info-box-text sm:text-sm md:text-md">{{$k_detect}}</span>
                                        @endif
                                    </div>
                            </div>
                        @endif

                    @if ($k_detect == 'K=10611' || $k_detect == 'K=2049' || $k_detect == 'K=11619' || $k_detect == 'K=10659'|| $k_detect == 'K=1093' || $k_detect == 'K=1092' || $k_detect == 'K=1098'|| $k_detect == 'K=2062' || $k_detect == 'K=3203' || $k_detect == 'K=23' || $k_detect == 'K=3906' || $k_detect == 'K=11052' || $k_detect == 'K=15293' || $k_detect == 'K=17564' || $k_detect == 'K=10634' || $k_detect == 'K=1091' || $k_detect == 'K=2028' || $k_detect == 'K=5460' || $k_detect == 'K=6057' )
                    <div>
                        @if ($k_detect == 'K=10611')
                        <a href={{$this->k10611()}}>
                        @endif
                        @if ($k_detect == 'K=1092')
                        <a href={{$this->k1092()}}>
                        @endif
                        @if ($k_detect == 'K=1098')
                        <a href={{$this->k1098()}}>
                        @endif
                        @if ($k_detect == 'K=2062')
                        <a href={{$this->k2062()}}>
                        @endif
                        @if ($k_detect == 'K=23')
                        <a href={{$this->k23()}}>
                        @endif
                        @if ($k_detect == 'K=3203')
                        <a href={{$this->k3203()}}>
                        @endif
                        @if ($k_detect == 'K=7341')
                        <a href={{$this->k7341()}}>
                        @endif
                        @if ($k_detect == 'K=3906')
                        <a href={{$this->k3906()}}>
                        @endif
                        @if ($k_detect == 'K=11052')
                        <a href={{$this->k11052()}}>
                        @endif
                        @if ($k_detect == 'K=15293')
                        <a href={{$this->k15293()}}>
                        @endif
                        @if ($k_detect == 'K=17564')
                        <a href={{$this->k17564()}}>
                        @endif
                        @if ($k_detect == 'K=10634')
                        <a href={{$this->k10634()}}>
                        @endif
               
                        @if ($k_detect == 'K=1091')
                        <a href={{$this->k1091()}}>
                        @endif
                        @if ($k_detect == 'K=2028')
                        <a href={{$this->k2028()}}>
                        @endif
                        @if ($k_detect == 'K=5460')
                        <a href={{$this->k5460()}}>
                        @endif
                        @if ($k_detect == 'K=6057')
                        <a href={{$this->k6057()}}>
                        @endif
                        @if ($k_detect == 'K=1093')
                        <a href={{$this->k1093()}}>
                        @endif

                        @if ($k_detect == 'K=10659')
                        <a href={{$this->k10659()}}>
                        @endif
                        @if ($k_detect == 'K=11619')
                        <a href={{$this->k11619()}}>
                        @endif
                        @if ($k_detect == 'K=2049')
                        <a href={{$this->k2049()}}>
                        @endif
                            <div class="small-box bg-success">
                                <div class="inner">

                                

                                    <h3 class="text-md font-semibold">{{$this->redireccionl()[1]}} </h3>
                                    <p>{{$this->redireccionl()[2]}}</p>

                                </div>
                                <div class="icon">
                                    <i class="	far fa-heart"></i>
                                </div>
                                <p class="font-bold text-sm small-box-footer">{{$this->redireccionl()[3]}} </p>
                            </div>
                        </a>
                    </div>
                    @endif

                    @if ($k_detect == 'K=1000')
                    <div>
                       
                        <a href={{$this->k1000()}}>
                       
                            <div class="small-box bg-success">
                                <div class="inner">

                                    <h3 class="text-md font-semibold">{{$this->redireccionk1000()[1]}} </h3>
                                    <p>{{$this->redireccionk1000()[2]}}</p>

                                </div>
                                <div class="icon">
                                    <i class="	far fa-heart"></i>
                                </div>
                                <p class="font-bold text-sm small-box-footer">{{$this->redireccionk1000()[3]}}</p>
                            </div>
                        </a>
                    </div>
                    @endif

                    @if ($k_detect == 'K=7341')
                    <div>
                       
                        <a href={{$this->k7341()}}>
                       
                            <div class="small-box bg-success">
                                <div class="inner">

                                    <h3 class="text-md font-semibold">{{$this->redireccionk7341()[1]}} </h3>
                                    <p>{{$this->redireccionk7341()[2]}}</p>

                                </div>
                                <div class="icon">
                                    <i class="	far fa-heart"></i>
                                </div>
                                <p class="font-bold text-sm small-box-footer">{{$this->redireccionk7341()[3]}}</p>
                            </div>
                        </a>
                    </div>
                    @endif

                    @if ($router_cint_detect == 1)
                    <div>
                        <a href={{$this->router()}}>
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 class="text-md font-semibold">Dirígete a </h3>
                                    <p>Sección KTMR</p>
                                </div>
                                <div class="icon">
                                    <i class="	far fa-heart"></i>
                                </div>
                                <p class="font-bold text-sm small-box-footer"> Haciendo clic aquí </p>
                            </div>
                        </a>

                    </div>

                    @endif
                    
                        

                    </aside>

                    <div class="md:col-span-2">
                        <div class="flex justify-between">
                            <div class=" mt-2 mr-2 ml-2 flex-1 mb-2">
                                <textarea wire:model.defer="comentario" class="form-control" id="formGroupExampleInput" name="comentario" cols="80" rows="2" placeholder="{{__('messages.comparte_experiencia')}}"></textarea>
                            </div>

                            <div class="mt-3 mb-2 mr-2">
                            <button
                                class="btn bg-info" 
                                wire:click="comentar('{{$jumper->id}}')"
                                title="{{__('messages.Guardar')}}">
                                {{__('messages.Guardar')}}
                            </button>

                            </div>
                        </div>
                        <div class="card ml-2">
                            @if ($comments->count())
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
            </div>
        @else
            <div class="card-body">

                <div class="m-2 mb-2">
                    @if($no_detect != 0)
                    <div class="flex justify-center mb-4">
                        <button
                            class="py-2 px-3 text-md font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" 
                            wire:click="descalificador()"
                            title="Descalificador">
                            DESCALIFICAR
                        </button>

                    </div>
                    <div class="info-box mb-3 bg-info" :class="{'hidden': (no_detect == '0')}">
                       
                        <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">No se encuentra en nuestros registros</span>
                            <span class="info-box-number">Si deseas registrarla, pega en nuestro buscador el link de la encuesta</span>
                        </div>
                        
                    </div>

                    
                    @endif
                </div>
                
                @if($jumper_detect  != 0)
                <div class="info-box mb-3 bg-info" :class="{'hidden': (jumper_detect == '0')}">
                   
                    <span class="info-box-icon"></span>
                        <div class="info-box-content">
                        
                            <span class="info-box-number">Dominio: {{$jumper_detect}}</span>
                        </div>
                  
                </div>
                @endif
                @if($k_detect != 0)
                <div class="info-box mb-3 bg-success" :class="{'hidden': (k_detect == '0')}">
                   
                    <span class="info-box-icon"></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Detectada una posible</span>
                            <span class="info-box-number">{{$k_detect}}</span>
                        </div>
                  
                </div>
                @endif
                @if($comment_new_psid_register != '')
                <div class="info-box mb-3 bg-success">
                   
                    <span class="info-box-icon"><i class="far fa-heart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">{{$comment_new_psid_register}}</span>
                        </div>
                  
                </div>
                @endif
            </div>
        @endif

        <div wire:loading>
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

        <script>
            function copiarAlPortapapeles_qt(id_elemento) {
             
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
                toastr.success('Copy qt..')
            }
        </script>

        <script>
            function copiarAlPortapapeles_sp(id_elemento) {
             
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
                toastr.success('Copy... Saltador Pre-encuesta')
            }
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




