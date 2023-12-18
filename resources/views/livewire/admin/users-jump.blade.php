<div>

    <section class="content">

    <div class="card-header">
                    <h2 class="text-lg font-semibold mb-2">Jumpers generados en el día</h2>
           
            </div>

            <div class="card card-secondary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Buscador</h3>
                </div> 
                <div class="card-body">
                    <div class="md:flex items-center justify-between">
                       
                        <div class="md:flex-1 md:ml-4 sm:mt-2 md:mt-0">
                           
                            <input wire:model="search" placeholder="Ingrese username del usuario" class="form-control">

                        </div>
                    </div>
                </div>
            </div>
    </section>


        <div class="card">
            
            @if ($users->count())
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                        <tr>
                            <th class="text-center py-3">Username</th>
                            <th class="text-center">K-1000</th>
                            <th class="text-center">K-1000 YSN</th>
                            <th class="text-center ">K-23</th>
                            <th class="text-center">K-1083</th>
                           
                            @if($user_autentic == 2)
                                <th></th>
                            @endif
                          
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                
                                    <td class="text-center">{{$user->name}}</td>
                                    <td class="text-center">{{$this->cant_k1000($user->id)}}</td>
                                    <td class="text-center">{{$this->cant_k1000YSN($user->id)}}</td>
                                    <td class="text-center">{{$this->cant_k23($user->id)}}</td>
                                    <td class="text-center">{{$this->cant_k1083($user->id)}}</td>

                                    @if($user_autentic == 2)

                                        <td class="text-center">
                                            <button
                                                class="btn btn-success btn-sm" 
                                                wire:click="reiniciar('{{$user->id}}')"
                                                title="Reiniciar">
                                                <i class="fas fa-music"></i>
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