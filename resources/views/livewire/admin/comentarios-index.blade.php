<div>
        <div class="card">
            <div class="card-header flex justify-between">
                    <div class="w-full md:mb-0 md:w-1/5">
                        <select wire:model="buscador"  class="form-control w-full" name="buscador">
                            <option value="2">PSID</option>
                            <option value="1">Username</option>
                        </select>
                    </div>

                    <input wire:model="search" placeholder="Ingrese el psid o username del usuario" class="form-control">
            </div>


            @if ($comentarios->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center py-3">Fecha</th>
                            <th class="text-center ">Comentario</th>
                            <th class="text-center">PSID</th>
                            <th class="text-center ">Ususario</th>
                          
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comentarios as $comentario)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                    <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{\Carbon\Carbon::parse($comentario->created_at)->format('d-m-Y')}}</th>
                                    <td class="text-center">{{$comentario->comment}}</td>
                                    <td class="text-center">{{$comentario->link->psid}}</td>
                                    <td class="text-center">{{$comentario->user->username}}</td>
                                    <td class="text-center">
                                        <button
                                            class="btn btn-danger btn-sm" 
                                            wire:click="delete('{{$comentario->id}}')"
                                            title="Eliminar comentario">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="flex-1">
                        {{$comentarios->links()}}
                    </div>
                  
                </div>
            @else
                 <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
                
        </div>
</div>
