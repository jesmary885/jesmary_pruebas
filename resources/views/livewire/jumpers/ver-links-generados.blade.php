<div>
    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> Últimos 10 jumpers generados</h5>
                    </div>
                    <div class="modal-body">
                        @if ($jumpers->count())
                        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                            <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                                    <tr>
                                        <th class="text-center">Acción</th>
                                        <th class="text-center py-3">Fecha</th>
                                        <th class="text-center">Tipo de Jumper</th>
                                        <th class="text-center">Link inicial</th>
                                        <th class="text-center">Jumper generado</th>
                               
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jumpers as $jumper)
                                            <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">

                                                <td class="text-center">

                                                    <div class="flex justify-center">
                                                        <button onclick="copiarAlPortapapeles('jumper_copy_{{$jumper->id}}')" class="btn btn-sm btn-success text-bold" title="{{__('messages.copiar_portapapeles')}}" id="button_copy">Copiar</button> 
                                                    </div>
                                                </td>
            
                                                <td class="text-center">{{\Carbon\Carbon::parse($jumper->created_at)->format('d-m-Y H:i:s')}}</td>
                                                <td class="text-center">{{$jumper->k_detected}}</td>
                                                <td class="text-justify">{{$jumper->link}}</td>
                                                <td class="text-justify" id="jumper_copy_{{$jumper->id}}">{{$jumper->link_resultado}}</td>

                                                                
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                          
                        @else
                             <div class="card-body">
                                <strong>No hay registros</strong>
                            </div>
                        @endif
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">{{__('messages.Cerrar')}}</button>
                      
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('js')

    <script>
        Livewire.on('volver', function(){
            window.history.back();      
        })
    </script>

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

@endpush

</div>
