<div>
    <div class="card">
        <div class="card-header row flex justify-between">
            <div class="flex-grow-1"">

                <input wire:model="search" placeholder="Ingrese el nombre del marketplace a buscar" class="form-control">
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
                            <th class="text-center ">Método de pago</th>
                            <th class="text-center">Vendedor</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Monto</th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marketplaces as $marketplace)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                    <td class="text-center">{{\Carbon\Carbon::parse($marketplace->created_at)->format('d-m-Y')}}</td>
                                    <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{$marketplace->marketplace->name}}</th>
                                    <td class="text-center">{{$marketplace->cant}}</td>
                                    <td class="text-center">{{$marketplace->paymentMethod->name ?? 'No se ha registrado'}}</td>
                                    <td class="text-center">{{$marketplace->marketplace->user->username}}</td>
                                    <td class="text-center">{{$this->status_value($marketplace->status)}}</td>
                                    <td class="text-center">{{$marketplace->total_paid}}</td>                          
                                    <td width="10px">
                                        @livewire('admin.venta-edit',['sale_marketplace'=>$marketplace],key($marketplace->id))
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