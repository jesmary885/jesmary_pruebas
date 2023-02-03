<div>
    <div class="card">
        
        <div class="card-header row flex justify-between">
        
            <div class="flex-grow-1 mt-2">
                <input wire:model="search" placeholder="Ingrese el nro de orden a buscar" class="form-control">
            </div>

            <div>
                <a class="btn btn-app bg-success">
                    <span class="badge bg-purple text-md">{{$nuevas}}</span>
                    <i class="fas fa-heart"></i> Nuevas
                </a>

                <a class="btn btn-app bg-warning">
                    <span class="badge bg-info text-md">{{$pago_recibido}}</span>
                    <i class="fas fa-heart"></i> Pago recibido
                </a>

                <a class="btn btn-app bg-info">
                    <span class="badge bg-danger text-md">{{$orden_recibida}}</span>
                    <i class="fas fa-heart"></i> Orden recibida
                </a>
                <a class="btn btn-app bg-danger">
                    <span class="badge bg-teal text-md">{{$no_recibido}}</span>
                    <i class="fas fa-heart-broken"></i> No recibido
                </a>
            </div>
        </div>
        @if ($marketplaces->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center py-3">Nro</th>
                            <th class="text-center py-3">Fecha</th>
                            <th class="text-center py-3">Producto</th>
                            <th class="text-center">Cant</th>
                            <th class="text-center ">Método</th>
                            <th class="text-center">Comprador</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Pto producto</th>
                            <th class="text-center">Constancia</th>
                            <th class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($marketplaces as $marketplace)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                    <td class="text-center">{{$marketplace->id}}</td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($marketplace->created_at)->format('d-m-Y')}}</td>
                                    <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{$this->get_name($marketplace->marketplace->name)}}</th>
                                    <td class="text-center">{{$marketplace->cant}}</td>
                                    <td class="text-center">{{$marketplace->paymentMethod->name ?? 'No se ha registrado'}}</td>
                                    <td class="text-center">{{$marketplace->user->username}}</td>
                                    <td class="text-center font-semibold {{$this->color_status($marketplace->status)}}">{{$marketplace->status}}</td>
                                    <td class="text-center">{{$marketplace->total_paid}}</td> 
                                    <td class="text-center"><i class="{{$this->reputation_producto($marketplace->points_producto)[1]}}"></i> <i class="{{$this->reputation_producto($marketplace->points_producto)[2]}}"></i> <i class="{{$this->reputation_producto($marketplace->points_producto)[3]}}"></i> <i class="{{$this->reputation_producto($marketplace->points_producto)[4]}}"></i> <i class="{{$this->reputation_producto($marketplace->points_producto)[5]}}"></i></td>
                                    @if($marketplace->file)
                                    <td class="text-center">
                                        <button class="text-green-600 text-lg hover:text-green-900"
                                            
                                            wire:click="download('{{$marketplace->file}}')">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                    @else
                                    <td class="text-center"></td> 
                                    @endif
                                    <td width="10px">
                                        @livewire('admin.venta-edit',['marketplace'=>$marketplace],key($marketplace->id))
                                    </td>
                                    
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

