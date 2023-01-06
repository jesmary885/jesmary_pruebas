<div>
    <div class="card">
        <div class="card-header row flex justify-between">
            <div class="flex-grow-1"">
                <input wire:model="search" placeholder="Ingrese el nombre del marketplace o del comprador para buscar" class="form-control">
            </div> 
        </div>
        @if ($marketplaces->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center py-3">Fecha</th>
                            <th class="text-center py-3">Producto</th>
                            <th class="text-center">Cant</th>
                            <th class="text-center ">Método</th>
                            <th class="text-center">Comprador</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Pto producto</th>
                            <th class="text-center">Pto vendedor</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($marketplaces as $marketplace)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                    <td class="text-center">{{\Carbon\Carbon::parse($marketplace->created_at)->format('d-m-Y')}}</td>
                                    <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{$marketplace->marketplace->name}}</th>
                                    <td class="text-center">{{$marketplace->cant}}</td>
                                    <td class="text-center">{{$marketplace->paymentMethod->name ?? 'No se ha registrado'}}</td>
                                    <td class="text-center">{{$marketplace->user->username}}</td>
                                    <td class="text-center">{{$this->status_value($marketplace->status)}}</td>
                                    <td class="text-center">{{$marketplace->total_paid}}</td> 
                                    <td class="text-center"><i class="{{$this->reputation_producto($marketplace->points_producto)[1]}}"></i> <i class="{{$this->reputation_producto($marketplace->points_producto)[2]}}"></i> <i class="{{$this->reputation_producto($marketplace->points_producto)[3]}}"></i> <i class="{{$this->reputation_producto($marketplace->points_producto)[4]}}"></i> <i class="{{$this->reputation_producto($marketplace->points_producto)[5]}}"></i></td>
                                    <td class="text-center"><i class="{{$this->reputation_vendedor($marketplace->points_vendedor)[1]}}"></i> <i class="{{$this->reputation_vendedor($marketplace->points_vendedor)[2]}}"></i> <i class="{{$this->reputation_vendedor($marketplace->points_vendedor)[3]}}"></i> <i class="{{$this->reputation_vendedor($marketplace->points_vendedor)[4]}}"></i> <i class="{{$this->reputation_vendedor($marketplace->points_vendedor)[5]}}"></i></td>                         
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$marketplaces->links()}}
                </div>
            @else
                 <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
                
        </div>
</div>

