<div>
        <div class="card">
            <div class="card-header">
                    <input wire:model="search" placeholder="Ingrese el username del usuario cliente" class="form-control">
           
            </div>
            @if ($users_modif->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center py-3">Fecha</th>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Administrador</th>
                            <th class="text-center ">Justificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users_modif as $user_modif)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                    <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{\Carbon\Carbon::parse($user_modif->created_at)->format('d-m-Y h:i')}}</th>
                                    <td class="text-center">{{$user_modif->user->username}}</td>
                                    <td class="text-center">{{$user_modif->admin->username}}</td>
                                    <td class="text-center">{{$user_modif->justificacion}}</td>
                       
                
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$users_modif->links()}}
                </div>
            @else
                 <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
                
        </div>
</div>
