<div class="container" >
    <div>


        @if ($registros->count())

            <div class=" mt-8 mb-2">
                <h3 class="font-semibold text-lg text-gray-200 leading-tight mb-3">REGISTRO DE PETICIONES JUNKIE</h3>
            </div>

              <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                            <tr>

                                <th class="text-center py-3 text-white text-md">
                                    Fecha de petición
                                </th>
                           
                                <th class="text-center py-3 text-white text-md">
                                    Usuario
                                </th>

                                 <th class="text-center py-3 text-white text-md">
                                    User_id
                                </th>
                             

                            </tr>
                    </thead>
                    <tbody>

                        @foreach ($registros as $registro)
                             <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                    {{$registro->created_at}}
                                </td>

                                <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                    {{$registro->user->name}}
                                </td>

                                <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                    {{$registro->codigo_user}}
                           


                     


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                    {{$registros->links()}}
            </div>

        @else
            <div class="px-6 py-4 justify-center mt-4 text-center w-full">
                ---No hay números registrados---
            </div>
        @endif



    </div>

</div>




