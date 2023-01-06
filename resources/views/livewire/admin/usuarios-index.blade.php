<div>
        <div class="card">
            <div class="card-header">
                    <input wire:model="search" placeholder="Ingrese el username o correo del usuario a buscar" class="form-control">
           
            </div>
            @if ($users->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center py-3">Username</th>
                            <th class="text-center">Balance</th>
                            <th class="text-center ">Fecha de corte</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Reputación(Vendedor)</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                    <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{$user->username}}</th>
                                    <td class="text-center">{{$user->balance}}</td>
                                    <td class="text-center">{{$this->next_payment_date($user->last_payment_date, $user->plan)}}</td>
                                    <td class="text-center">{{$user->plan}} días</td>
                                    @if($user->sales) <td class="text-center"> <i class="{{$this->reputation_vendedor($user->id)[1]}}"></i> <i class="{{$this->reputation_vendedor($user->id)[2]}}"></i> <i class="{{$this->reputation_vendedor($user->id)[3]}}"></i> <i class="{{$this->reputation_vendedor($user->id)[4]}}"></i> <i class="{{$this->reputation_vendedor($user->id)[5]}}"></i></td>
                                    @else <td class="text-center">Sin ventas registradas</td>
                                    @endif
                                    <td class="text-center">{{$user->roles->first()->name}}</td>
                                    <td class="text-center">{{$user->status}}</td>                          
                                    <td class="text-center">
                                        @livewire('admin.usuarios-edit', ['usuario' => $user],key($user->id))
                                    </td>
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


