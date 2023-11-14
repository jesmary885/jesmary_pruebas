<div>
    <div class="card">
     
        @if ($cuentas->count())
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>
                        <th class="text-center py-3">Fecha</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Contraseña</th>
                        <th class="text-center">Link Inicial</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cuentas as $cuenta)
                            <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">

                                <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                    {{\Carbon\Carbon::parse($cuenta->created_at)->format('d-m-Y h:i')}}
                                </td>

                                <td class="text-center">{{$cuenta->email}}</td>
                                <td class="text-center">{{$cuenta->password}}</td>


                                <td class="text-center py-3 px-2">
                                    <button class="text-blue-600 text-lg hover:text-green-900"
                                    
                                    wire:click="ver('{{$cuenta->id}}')">
                                    <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                
                                <td class="text-center">
                                    @livewire('ktmr.cuentas-crear-datos', ['cuenta_id' => $cuenta->id],key($cuenta->id))
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$cuentas->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>

    @push('js')
        <script>
            livewire.on('comment', function(ms){
                    Swal.fire({
                title: ms,
                showClass: {
                popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
                }
                })
            })
        </script>
    @endpush
</div>
