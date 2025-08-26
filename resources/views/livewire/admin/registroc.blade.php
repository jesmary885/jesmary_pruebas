<div class="container" >
    <div>
        <div class=" flex justify-end pt-2 mt-2 " >
            @livewire('admin.registroc-create', ['tipo' => 'agregar'])
        </div>

        @if ($registros->count())

            <div class=" mt-8 mb-2">
                <h3 class="font-semibold text-lg text-gray-200 leading-tight mb-3">REGISTRO DE MIS CUENTAS</h3>
            </div>

              <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                            <tr>
                           
                                <th class="text-center py-3 text-white text-md">
                                    PID
                                </th>

                                <th class="text-center py-3 text-white text-md">
                                    HASH
                                </th>
                             

                                <th>
                                </th>

                                <th>
                                </th>
                            </tr>
                    </thead>
                    <tbody>

                        @foreach ($registros as $registro)
                             <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                    {{$registro->pid}}
                                </td>


                                <td class="text-center">
                                {{$registro->hash}}
                                </td>


                                <td class="text-center">

                                    @livewire('admin.registroc-create', ['tipo' => 'editar','registro' => $registro->id],key($registro->id))

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
                ---No hay cuentas registradas---
            </div>
        @endif

        @if ($registros->count())
            
            <div class="px-6 py-4">
                {{ $registros->links() }}
            </div>
            
        @endif

    </div>

</div>
