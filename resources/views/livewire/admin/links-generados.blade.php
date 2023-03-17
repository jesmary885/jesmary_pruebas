<div>
        <div class="card">
            <div class="card-header">
                    <input wire:model="search" placeholder="Ingrese el nombre de la k que desee filtrar" class="form-control">
           
            </div>
            @if ($jumpers->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center py-3">K</th>
                            <th class="text-center p">LINK</th>
                     
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jumpers as $jumper)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                  
                                    <td class="text-center py-3 px-2">{{$jumper->k_detected}}</td>
                                    <td class=" text-justify py-3 px-2 ">{{$jumper->link}}</td>
                                
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
</div>
