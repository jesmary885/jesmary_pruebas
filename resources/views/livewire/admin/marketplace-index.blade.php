<div>
    <div class="card">
        <div class="card-header row flex justify-between">
            <div class="flex-grow-1"">
                <input wire:model="search" placeholder="Ingrese el nombre del marketplace a buscar" class="form-control">
            </div>
            @can('admin.sales')
                <div class="ml-2 mr-2 mt-1">
                        @livewire('marketplace.marketplace-create',['accion'=>'create','vista'=>$vista])
                </div>
            @endcan
            
        </div>
        @if ($marketplaces->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center py-3">Nombre</th>
                            @if($vista == 'venta')
                            <th class="text-center">Precio</th>
                            @else
                            <th class="text-center">Tasa</th>
                            @endif
                            <th class="text-center ">Cantidad</th>
                            <th class="text-center">Puntos</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Categoria</th>
                            <th></th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marketplaces as $marketplace)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                    <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{$this->get_name($marketplace->name)}}</th>
                                    @if($vista == 'venta')
                                    <td class="text-center">$ {{$marketplace->price}}</td>
                                    @else
                                    <td class="text-center">$ {{$marketplace->tasa}}</td>
                                    @endif
                                    <td class="text-center">{{$marketplace->cant}}</td>
                                    <td class="text-center"><i class="{{$this->reputation($marketplace)[1]}}"></i> <i class="{{$this->reputation($marketplace)[2]}}"></i> <i class="{{$this->reputation($marketplace)[3]}}"></i> <i class="{{$this->reputation($marketplace)[4]}}"></i> <i class="{{$this->reputation($marketplace)[5]}}"></i></td>
                                    <td class="text-center">{{$marketplace->status}}</td>
                                    <td class="text-center">{{$marketplace->categoryMarketplace->name}}</td>                          
                                    <td width="10px">
                                        @livewire('marketplace.marketplace-create',['accion'=>'edit','marketplace'=>$marketplace,'vista'=>$vista],key($marketplace->id))
                                    </td>

                                    <td class="py-4 whitespace-nowrap font-medium">
                                    <a href="{{ route('marketplace.add.files', $marketplace) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-image"></i>
                                    </a>
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
