<div>
    <button type="submit" class="btn btn-primary" width="50px" wire:click="open">
    <i class="fas fa-eye"></i>
    </button>

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="flex justify-between w-full">
                            <div class="flex-1">
                                <h5 class="modal-title py-0 text-lg text-gray-300">Copia el jumper y deja tu comentario</h5>
                            </div>

                            <button type="button" class="btn text-gray-300" data-dismiss="modal" wire:click="close"><i class="fas fa-window-close"></i></button>
                        </div>
                        
                        
                    </div>
                    <div class="modal-body">
                      

                        <div class="flex-nowrap justify-center callout callout-info container">

                            <p  class="text-blue-400 text-clip text-xs text-center font-bold mb-2" id="jumper_copy">{{$jumper->jumper}}</p>

                            <div class="flex justify-center">
                                <button onclick="copiarAlPortapapeles('jumper_copy')" class="btn btn-sm btn-success text-bold" title="{{__('messages.copiar_portapapeles')}}" id="button_copy">Copiar</button> 
                            </div>
                        </div>

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

                        <div>
                            
                            @if($comments)
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:click="save">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('js')
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
    @endpush
</div>

