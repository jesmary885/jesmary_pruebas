<div>
        <div class="card">
            <div class="card-header">
                <div class="flex justify-between">
                    <div class="flex-1">
                        <input wire:model="search" placeholder="Ingrese el nombre de la k que desee filtrar, ejemplo 1000" class="form-control">

                    </div>

                    

                    <div>
                        <button type="submit" class="btn btn-success btn-md ml-2" title="Exportar a excel" wire:click="export">
                            <i class="	fas fa-file-export"></i> Exportar
                        </button> 
                    </div>

                </div>
                    
           
            </div>
            @if ($jumpers->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center py-3">Fecha</th>
                            <th class="text-center py-3">JUMPER</th>
                            <th class="text-center p">LINK INICIAL</th>
                            <th class="text-center p">LINK RESULTADO</th>
                            <th class="text-center p">USUARIO</th>
                     
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($jumpers as $jumper)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">

                                    <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                    {{\Carbon\Carbon::parse($jumper->created_at)->format('d-m-Y h:i')}}
                                    </td>
                                  
                                    <td class="text-center py-3 px-2">{{$jumper->k_detected}}</td>
                                    <td class="text-center py-3 px-2">
                                        <button class="text-blue-600 text-lg hover:text-green-900"
                                        
                                        wire:click="ver_link('{{$jumper->id}}')">
                                        <i class="fas fa-eye"></i>
                                        </button>
                                    </td>

                                    <td class="text-center py-3 px-2">
                                        <button class="text-blue-600 text-lg hover:text-green-900"
                                        
                                        wire:click="ver_link_resultado('{{$jumper->id}}')">
                                        <i class="fas fa-eye"></i>
                                        </button>
                                    </td>

                                    @if($jumper->user)
                                    <td class=" text-justify py-3 px-2 ">{{$jumper->user->username}}</td>
                                    @else
                                    <td class=" text-justify py-3 px-2 ">-</td>
                                    @endif
                                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer flex justify-between">
                    <div class="flex-1">
                        {{$jumpers->links()}}
                    </div>
                    <div>
                        <p class="text-gray-300 font-semibold text-lg ">TOTAL: {{$total}}</p>
                    </div>
                </div>
            @else
                 <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
                
        </div>

    @push('js')
        <script>
            livewire.on('comment', function(ms){
                    Swal.fire({
                title: ms,
                showClass: {
                popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
                }
                })
            })
        </script>
    @endpush
</div>
