<div>
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-semibold mb-2">Cuentas de usuarios</h2>
        </div>
        @if ($users->count())
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>
                        <th class="text-center py-3">Username</th>
                        <th class="text-center">Cantidad de cuentas</th>
                        <th class="text-center">Rol</th>
                        <th class="text-center">Administrador</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                            <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{$user->username}}</th>
                            <td class="text-center">{{$this->cant_cuentas($user->id)}}</td>
                            <td class="{{$this->rol($user->id)[1]}}">{{$this->rol($user->id)[2]}}</td>
                            <td class="text-center">{{$this->lider($user->id)}}</td>

                            @if($user->roles->first()->name != 'Administrador')
                                <td class="text-center">
                                    @livewire('admin.cuentas-psid-edit', ['usuario' => $user],key($user->id))
                                </td>
                            @else
                                <td class="text-center">
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>
</div>
