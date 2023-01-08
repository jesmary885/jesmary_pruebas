<div x-data="{jumper_2: @entangle('jumper_2'),points_user: @entangle('points_user'), is_high: @entangle('is_high'),is_basic: @entangle('is_basic'), calc_link: @entangle('calc_link'), pid: @entangle('pid_new'), psid: @entangle('psid_register'), jumper_detect: @entangle('jumper_detect'), no_detect: @entangle('no_detect'), k_detect: @entangle('k_detect')}">
    <div class="card">
        <div class="card-header form-row">

            <div class="col-sm-8 col-lg-9 col-xl-10">

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

            <div class="mt-1 mr-1">
                @livewire('jumpers.ssidkr.ssidkr-create')
            </div>

            <div class="mt-1">
                @livewire('jumpers.ssidkr.ssidkr-create-high')
            </div>

        </div>
        
 

        <div wire:loading.delay>
            <div class="loader"></div>
        </div>

        <div class="flex justify-between">
            @if($pid_new == 0)
            <div class="px-4" :class="{'hidden': (pid != 0)}">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color:darkred;">×</font></font></button>
                    <h5><i class="icon fas fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Alerta!</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                    Aún no has registrado tu PID</font><font style="vertical-align: inherit;"> ,haz clic <a class="hover:font-bold" href="{{route('registro.pid')}}"> aquí</a> para registrarlo
                    </font></font>
                </div>
            </div>
            @endif

            @if($psid_register == 0)
            <div class="px-4" :class="{'hidden': (psid != 0)}">
                <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color:darkred;">×</font></font></button>
                        <h5><i class="icon fas fa-info"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">¡Alerta!</font></font></h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                        Aún no has registrado tu PSID</font><font style="vertical-align: inherit;"> ,haz clic <a class="hover:text-white" href="{{route('registro.psid')}}"> aquí</a> para registrarlo
                        
                    </font></font>
                </div>
            </div>
            @endif

           
        </div>

       
        @if ($jumper_complete != 0 && $jumper != "" && $calc_link == 1)
            <div class="card-body mt-0">

                <div class="flex flex-row justify-center">
                    <div>
                        <p class="text-blue-400 text-lg ml-4 mb-2 " id="jumper_copy">{{$jumper_complete}}</p>
                    </div>
        @endif
            <div :class="{'hidden': (jumper_2 == '')}">
                <div :class="{'hidden': (calc_link == 0)}">
                    <button class="btn btn-sm btn-success ml-2 mb-3 text-bold" title="{{__('messages.copiar_portapapeles')}}" id="button_copy">@if($jumper_2 != '') Copiar @endif</button>    
                </div>
            </div>
        @if ($jumper_complete != 0 || $jumper != "")

                </div>
            <table class="table table-striped table-responsive-md table-responsive-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">{{__('messages.Tipo')}}</th>
                            <th class="text-center">PSID</th>
                            <th class="text-center">{{$jumper->jumperType->name}}</th>
                            <th class="text-center">{{__('messages.Subido')}}</th>
                            <th class="text-center" :class="{'hidden': (is_high == 'no')}">PID</th>
                            <th class="text-center">Historial</th>
                            <th colspan="2" class="text-center">{{__('messages.Puntuación')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{$jumper->jumperType->name}}</td>
                            <td class="text-center">{{$jumper->psid}}</td>
                            @if($jumper->jumper_type_id == 15) <td class="text-center"> - </td>@endif
                            <td class="text-center" :class="{'hidden': (is_high == 'no')}"> {{$calculo_high}}</td>
                            <td class="text-center" :class="{'hidden': (is_basic == 'no')}">{{$jumper->basic}}</td>
                            <td class="text-center">{{$jumper->created_at->format('d/m/Y')}}</td>
                            <td class="text-center" :class="{'hidden': (is_high == 'no')}"> 
                                <div class=" row flex justify-between">
                            
                                    <div class="flex-grow-1">
                                        <input type="text" wire:model="pid_new" class="form-control" id="formGroupExampleInput" placeholder="{{__('messages.ingrese_pdi')}}">
                                    </div>
                                    <div>
                                        <button
                                            class="btn btn-md btn-outline-secondary" 
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
                                    class="py-2 px-3 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                                    x-bind:disabled="points_user == 'si'"
                                    wire:click="positivo('{{$jumper->id}}')"
                                    title="Positivo">
                                    <i class="font-semibold far fa-thumbs-up">{{$jumper->positive_points}}</i>
                                </button>
                            </td>
                            <td width="10px">
                            <button
                                    class="py-2 px-3 text-md font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" 
                                    x-bind:disabled="points_user == 'si'"
                                    wire:click="negativo('{{$jumper->id}}')"
                                    title="Negativo">
                                    <i class="font-semibold far fa-thumbs-down">{{$jumper->negative_points}}</i>
                            </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="grid md:grid-cols-3 gap-4 mt-4 card container">
                    <aside class="md:col-span-1 p-2">
                    
                        <div class="info-box mb-3 bg-info" :class="{'hidden': (jumper_detect == '0')}">
                        @if($jumper_detect != 0)
                        <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                            <div class="info-box-content">
                            <span class="info-box-text">Tipo {{$jumper->jumperType->name}}</span>
                            <span class="info-box-number">Dominio: {{$jumper_detect}}</span>
                            </div>
                            @endif
                        </div>
                    
                    @if($k_detect != '0')
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
                                wire:click="comentar('{{$jumper->id}}')"
                                title="{{__('messages.Guardar')}}">
                                {{__('messages.Guardar')}}
                            </button>

                            </div>
                        </div>
                        <div class="card container ml-2">
                            @if ($comments->count())
                                @foreach ($comments as $comment)
                                    <div class="flex justify-between card-body">
                                        <div class="">
                                            <p class="text-gray-200 text-lg font-semibold">{{$comment->user->name}}</p>
                                            <p class="text-gray-200 text-sm ">{{$comment->created_at->format('d/m/Y h:i')}}</p>
                                        </div>
                                        <div class="flex-1 ml-4 text-justify">
                                            <p class="text-white font-semibold">{{$comment->comment}}</p>
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
                   
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                        <div class="info-box-content">
                            @if($jumper)
                            <span class="info-box-text">Tipo {{$jumper->jumperType->name}}</span>
                            @else
                            <span class="info-box-text">Tipo No identificado</span>
                            @endif
                            <span class="info-box-number">Dominio: {{$jumper_detect}}</span>
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
            </div>
        @endif

       
        

    </div>

    <style>
   
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('loading/1480.gif') 50% 50% no-repeat rgb(249,249,249);
            opacity: .6;
        }
    </style>

    <script>
            var boton = document.getElementById("button_copy");
            boton.addEventListener("click", copiarAlPortapapeles, false);
            function copiarAlPortapapeles() {
                var codigoACopiar = document.getElementById('jumper_copy');
                var seleccion = document.createRange();
                seleccion.selectNodeContents(codigoACopiar);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(seleccion);
                var res = document.execCommand('copy');
                window.getSelection().removeRange(seleccion);
            }
    </script>
</div>




