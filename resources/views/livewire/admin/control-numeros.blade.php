<div class="container" >
    <div>

        <div class=" flex justify-end pt-2 mt-2 " >
            @livewire('admin.control-numeros-registro', ['tipo' => 'agregar'])
        </div>

         <div class="card-header">
                    <input wire:model="search" placeholder="Ingrese el número a buscar" class="form-control">
            </div>

        @if ($registros->count())

            <div class=" mt-8 mb-2">
                <h3 class="font-semibold text-lg text-gray-200 leading-tight mb-3">REGISTRO DE NÚMEROS</h3>
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
                                    Trabajador
                                
                                </th>

                                <th class="text-center py-3 text-white text-md">

                                
                                </th>

                                <th class="text-center py-3 text-white text-md">

                                
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

                                @if($registro->trabajador)
                                <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                    {{$registro->trabajador->name}}
                                </td>

                                @else

                                <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                    -
                                </td>

                                @endif


                                <td class="text-center">

                                    @livewire('admin.control-numeros-registro', ['tipo' => 'editar','registro' => $registro->id],key($registro->id))

                                </td>


                                 <td class="text-center">
                                    <button class="text-red-600 text-lg hover:text-red-800"
                                        
                                    wire:click="Eliminar('{{$registro->id}}')">
                                    <i class="	fa fa-times-circle"></i>
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



    </div>

</div>




