<div>
        <div class="card">
            <div class="card-header">
                    <input wire:model="search" placeholder="Ingrese el psid o la url del jumper" class="form-control">
           
            </div>
            @if ($jumpers->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center px-16">TIPO</th>
                            <th class="text-center py-3">PSID</th>
                            <th class="text-center">PID</th>
                            <th class="text-center ">HIGH</th>
                            <th class="text-center">BASIC</th>
                            <th class="text-center">DOMINIO</th>
                            <th class="text-center">K-DETECT</th>
                            <th class="text-center">USUARIO</th>
                            <th class="text-center px-8"><i class="fas fa-thumbs-up text-blue-800"></i></th>
                            <th class="text-center px-8"><i class="font-semibold far fa-thumbs-down text-red-800"></i></th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jumpers as $jumper)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                    <th class="py-3 text-center font-medium whitespace-nowrap text-white w-full">{{$jumper->jumperType->name}}</th>
                                    <td class="text-center">{{$jumper->psid}}</td>
                                    <td class="text-center">{{$jumper->pid}}</td>
                                    <td class="text-center">{{$jumper->high}}</td>
                                    <td class="text-center">{{$jumper->basic}}</td>
                                    <td class="text-center">{{$jumper->jumper}}</td>
                                    <td class="text-center">{{$jumper->k_detected}}</td>
                                    <td class="text-center">{{$jumper->user->username}}</td>
                                    <td class="text-center"> {{$jumper->positive_points}}</td>
                                    <td class="text-center"> {{$jumper->negative_points}}</td>
                                    <td class="text-center">
                                        @livewire('admin.jumper-edit', ['jumper' => $jumper],key($jumper->id))
                                    </td>
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



