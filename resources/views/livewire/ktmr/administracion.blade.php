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
                        <th class="text-center py-3">Username</th>
                        <th class="text-center">Cantidad de jumpers generados</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                <td class="text-center">{{$user->username}}</td>
                                <td class="text-center">{{$this->cant_jump($user->id)}}</td>
  

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
