<div>

<div class="card-header mb-10">
        <div class="flex items-center">
            <h2 class="font-semibold text-lg text-gray-200 leading-tight">
                Usuarios pagos activos
            </h2>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-boxes"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">Total de registros</span>
        <span class="info-box-number">{{$total_registros}}</span>
        </div>

        </div>

        </div>

    </div>

    <section class="content">
            <div class="card card-secondary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Buscador</h3>
                </div> 
                <div class="card-body">
                    <div class="md:flex items-center justify-between">
                        <div class="w-full md:mb-0 md:w-1/5">
                            <label class="text-gray-200 text-md mx-2 ">Vista de registro</label>
                            <select wire:model="vista_registros" id="vista_registros" class="form-control w-full" name="vista_registros">
                                <option value="0">Todos</option>
                                <option value="1">Usuarios Básicos</option>
                                <option value="2">Usuarios Premium - Plan 15</option>
                                <option value="3">Usuarios Premium - Plan 30</option>
                            </select>
                        </div>

                        <div class="md:flex-1 md:ml-4 sm:mt-2 md:mt-0">
                            <label class="text-gray-200 text-md ">-</label>
                           
                                <input wire:model="search" placeholder="Ingrese username del usuario" class="form-control">
                            

                        </div>
                    </div>
                </div>
            </div>
    </section>


        <div class="card">
            <div class="card-header">
                    <h2 class="text-lg font-semibold mb-2">Users Paying</h2>
           
            </div>
            @if ($users->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
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
                </div>
            @else
                 <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
                
        </div>
</div>
