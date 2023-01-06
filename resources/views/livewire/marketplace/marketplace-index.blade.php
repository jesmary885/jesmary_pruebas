<div>

<div class="card">
    <div class="card-header row flex justify-between">
        <div class="flex-grow-1">
                <input wire:model="search" placeholder="{{__('messages.busqueda_marketplace')}}" class="form-control">
        </div>
        
    </div>
</div>


@if ($marketplaces->count())
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-400">
            <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                    {{__('messages.nombre')}}
                    </th>
                    <th scope="col" class="py-3 px-6">
                    {{__('messages.categoria')}}
                    </th>
                    <th scope="col" class="py-3 px-6">
                    {{__('messages.precio')}}
                    </th>
                    <th scope="col" class="py-3 px-6">
                    {{__('messages.vendedor')}}
                    </th>
                    <th colspan="1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($marketplaces as $marketplace)
             
                    <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium whitespace-nowrap text-white">
                        {{$marketplace->name}} 
                        </th>
                        <td class="py-4 px-6">
                        {{$marketplace->categoryMarketplace->name}}
                        </td>
                        <td class="py-4 px-6">
                        $ {{$marketplace->price}}
                        </td>
                        <td class="py-4 px-6">
                        {{$marketplace->user->name}}
                        </td>
                        <td class="py-4 px-6 text-right">
                            <a class="font-medium text-blue-500 hover:underline" href="{{route('marketplace.shop',['marketplace'=>$marketplace])}}">Ver</a>
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
