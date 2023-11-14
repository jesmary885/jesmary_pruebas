<div>
    <div class="card">
        <div class="card-header">
            <input wire:model="search" placeholder="Ingrese el username buscar" class="form-control">
        </div>
        @if ($users->count())
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>
                        <th class="text-center py-3">Fecha</th>
                        <th class="text-center py-3">Username</th>
                        <th class="text-center">Email cuenta</th>
                        <th class="text-center">Contraseña cuenta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                    {{\Carbon\Carbon::parse($user->created_at)->format('d-m-Y h:i')}}
                                    </td>
                                <td class="text-center">{{$user->user->username}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center">{{$user->password}}</td>
                              

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$users->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>