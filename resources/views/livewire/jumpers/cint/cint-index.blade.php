<div x-data="{jumper_2: @entangle('jumper_2'),points_user: @entangle('points_user'), calc_link: @entangle('calc_link'), no_detect: @entangle('no_detect')}">
    <div class="card">
        <div class="card-header row flex justify-between">
            <div class="flex-grow-1">
                <input wire:model="search" type="search" placeholder="" class="form-control">
            </div>

           

            <div class="ml-2 mr-2 mt-1">
                @livewire('jumpers.cint.cint-create')
            </div>

        </div>

        <div wire:loading.delay>
            <div class="loader"></div>
        </div>

        @if ($jumper_complete != 0 && $jumper != "" && $calc_link == 1)
            <div class="card-body mt-0">
                <div class="flex flex-row justify-center">
                    <div>
                        <p class="text-blue-400 text-lg ml-4 mb-2" id="jumper_copy">{{$jumper_complete}}</p>
                    </div>
        @endif
            <div :class="{'hidden': (jumper_2 == '')}">
                <div :class="{'hidden': (calc_link == 0)}">
                    <button class="btn btn-sm btn-outline-secondary ml-2 mb-3" title="{{__('messages.copiar_portapapeles')}}" id="button_copy">@if($jumper_2 != '') Copiar @endif</button>    
                </div>
            </div>
        @if ($jumper_complete != 0 && $jumper != "")
                </div>
            <table class="table table-striped table-responsive-md table-responsive-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">{{__('messages.Tipo')}}</th>
                            <th class="text-center">{{__('messages.Subido')}}</th>
                            <th class="text-center">Historial</th>
                            <th colspan="2" class="text-center">{{__('messages.Puntuación')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{$jumper->jumperType->name}}</td>
                            <td class="text-center">{{$jumper->created_at->format('d/m/Y')}}</td>
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
                    <aside class="md:col-span-1">
                        <div class=" mt-8 ">
                            <textarea wire:model.defer="comentario" class="form-control" id="formGroupExampleInput" name="comentario" cols="80" rows="2" placeholder="{{__('messages.comparte_experiencia')}}"></textarea>
                        </div>

                        <div class="mt-2 mb-2">
                        <button
                            class="btn btn-primary" 
                            wire:click="comentar('{{$jumper->id}}')"
                            title="{{__('messages.Guardar')}}">
                            {{__('messages.Guardar')}}
                        </button>

                        </div>
                    </aside>

                    <div class="md:col-span-2 mt-8">
                        <div class="card container ml-2">
                            @if ($comments->count())
                                @foreach ($comments as $comment)
                                    <div class="flex justify-between card-body">
                                        <div class="">
                                            <p class="text-gray-200 text-lg font-semibold">{{$comment->user->name}}</p>
                                            <p class="text-gray-200 text-sm ">{{$comment->created_at->format('d/m/Y')}}</p>
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

            </div>
        @endif
        @if($no_detect != 0)
        <div class="m-2 mb-2" :class="{'hidden': (no_detect == '0')}">
            <div class="info-box mb-3 bg-info" >
                <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">No se encuentra en nuestros registros</span>
                    </div>
            </div>
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

