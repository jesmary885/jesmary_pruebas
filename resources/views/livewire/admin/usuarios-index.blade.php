<div>
        <div class="card">
            <div class="card-header">
                    <input wire:model="search" placeholder="Ingrese el username o correo del usuario a buscar" class="form-control">
           
            </div>
            @if ($users->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center py-3">Username</th>
                            <th class="text-center">Nacionalidad</th>
                            <th class="text-center">Telegram</th>
                            <th class="text-center">Balance</th>
                            <th class="text-center ">Fecha de corte</th>
                            <th class="text-center">Plan(días)</th>
                            <th class="text-center">Plan </th>
                            <th class="text-center">Reputación(Vendedor)</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Estado</th>
                                <th></th>

                                @if($user_autentic == 2 || $user_autentic == 5 || $user_autentic == 10)
                                <th></th>
                                <th></th>
                            @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">

                                    <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{$user->username}}</th>
                                    <td class="text-center">{{$user->nacionalidad}}</td>
                                    <td class="text-center">{{$user->telegram}}</td>
                                    <td class="text-center">{{$user->balance}}</td>

                                    @if($user->last_payment_date)
                                    <td class="text-center">{{\Carbon\Carbon::parse($user->last_payment_date)->format('d-m-Y H:i:s')}}</td>
                                    @else
                                    <td class="text-center">Usuario sin pagos</td>
                                    @endif
                                    <td class="text-center">{{$user->plan}}</td>
                                    <td class="text-center">{{$user->type}}</td>
                                    @if($user->sales) <td class="text-center"> <i class="{{$this->reputation_vendedor($user->id)[1]}}"></i> <i class="{{$this->reputation_vendedor($user->id)[2]}}"></i> <i class="{{$this->reputation_vendedor($user->id)[3]}}"></i> <i class="{{$this->reputation_vendedor($user->id)[4]}}"></i> <i class="{{$this->reputation_vendedor($user->id)[5]}}"></i></td>
                                    @else <td class="text-center">Sin ventas registradas</td>
                                    @endif
                                    <td class="text-center">{{$user->roles->first()->name}}</td>
                                    <td class="text-center">{{$user->status}}</td>                          
                                    <td class="text-center">
                                        @livewire('admin.usuarios-edit', ['usuario' => $user],key($user->id))
                                    </td>

                                    @if($user_autentic == 2 || $user_autentic == 5 || $user_autentic == 10)

                                        <td class="text-center">
                                            <button
                                                class="btn btn-info btn-sm" 
                                                wire:click="rol_ktmr('{{$user->id}}')"
                                                title="Otorgar rol de Ktmr">
                                                <i class="fas fa-award"></i>
                                            </button>
                                        </td>

                                        <td class="text-center">
                                            <button
                                                class="btn btn-danger btn-sm" 
                                                wire:click="quitar_rol_ktmr('{{$user->id}}')"
                                                title="Quitar rol de Ktmr">
                                                <i class="fas fa-award"></i>
                                            </button>
                                        </td>

                                    @endif

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


