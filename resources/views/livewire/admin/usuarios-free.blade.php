<div>
        <div class="card">
            <div class="card-header">
                    <h2 class="text-lg font-semibold mb-2">Users Free</h2>
           
            </div>
            @if ($users->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center py-3">Username</th>
                            <th class="text-center">Correo</th>
                            <th class="text-center ">Fecha de corte</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Links registrados</th>
                            <th class="text-center px-8">Registrados con + 2 <i class="font-semibold far fa-thumbs-down text-red-800"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                    <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{$user->username}}</th>
                                    <td class="text-center">{{$user->email}}</td>
                                    <td class="text-center">{{$user->last_payment_date}}</td>
                                    <td class="text-center">{{$user->plan}} días</td>
                                    <td class="text-center">{{$user->roles->first()->name}}</td>
                                    <td class="text-center">{{$user->status}}</td> 
                                    <td class="text-center">{{$this->links($user->id)}}</td>   
                                    <td class="text-center">{{$this->links_negativos($user->id)}}</td>                     
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer flex justify-between">
                    <div class="flex-1">
                        {{$users->links()}}
                    </div>
                    <div>
                        <p class="text-gray-300 font-semibold text-lg ">TOTAL: {{$total}}</p>
                    </div>
                </div>
            @else
                 <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
                
        </div>
</div>
