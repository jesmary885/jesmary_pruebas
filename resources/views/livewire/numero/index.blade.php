<div class="container" >
    <div>

         <div class="card-header">
                    <input wire:model="search" placeholder="Ingrese el número a buscar" class="form-control">
            </div>

        @if ($registros->count())

            <div class=" mt-8 mb-2">
                <h3 class="font-semibold text-lg text-gray-200 leading-tight mb-3">REGISTRO NÚMEROS</h3>
            </div>

              <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                            <tr>
                           
                                <th class="text-center py-3 text-white text-md">
                                    Número
                                </th>

                                 <th class="text-center py-3 text-white text-md">
                                    Panel
                                </th>
                             
                                <th class="text-center py-3 text-white text-md">

                                    Activar
                                </th>

                            </tr>
                    </thead>
                    <tbody>

                        @foreach ($registros as $registro)
                             <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                    {{$registro->numero}}
                                </td>

                                <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                    {{$registro->type}}
                                </td>

                            

                                


                                <td class="text-center">
                                    <button class="text-green-600 text-xl hover:text-green-400"
                                        
                                    wire:click="Activar('{{$registro->id}}')">
                                    <i class="fas fa-share"></i>	
                                </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <div class="px-6 py-4 justify-center mt-4 text-center w-full">
                ---No hay números registrados---
            </div>
        @endif

        @if ($registros->count())
            
            <div class="px-6 py-4">
                {{ $registros->links() }}
            </div>
            
        @endif

    </div>

</div>
