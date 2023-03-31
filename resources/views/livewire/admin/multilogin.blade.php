<div>
        <div class="card">
          
            @foreach ($users as $user)
                @if($this->multilog($user->id) >= 2)
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                            <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                                <tr>
                                    <th class="text-center py-3">Username</th>
                                    <th class="text-center">Cambios en el día</th>
                                
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                            <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                                <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{$user->username}}</th>
                                                <th class="py-3 text-center font-medium whitespace-nowrap text-white">{{$this->multilog($user->id)}}</th>
                                                                        
                                                <td class="text-center">
                                                    @livewire('admin.usuarios-edit', ['usuario' => $user],key($user->id))
                                                </td>
                                            </tr>
                                       
                                </tbody>
                            </table>
                        </div>
                        
            @endif
                
            @endforeach
                
        </div>
</div>

