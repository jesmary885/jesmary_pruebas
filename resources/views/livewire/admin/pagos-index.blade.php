<div>
<div class="card-header mb-10">
        <div class="flex items-center">
            <h2 class="font-semibold text-lg text-gray-200 leading-tight">
                Registros de pagos
            </h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-archive"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">Pendientes por verificar</span>
        <span class="info-box-number">
        {{$this->pendientes_verificar()}}
        <small></small>
        </span>
        </div>

        </div>

        </div>

        <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-hand-holding-heart"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">Verificados del día</span>
        <span class="info-box-number">{{$this->verificados_dia()}}</span>
        </div>

        </div>

        </div>


        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="	fas fa-money-bill-wave"></i></span>
        <div class="info-box-content">
        <span class="info-box-text">Verificados del mes</span>
        <span class="info-box-number">{{$this->verificados_mes()}}</span>
        </div>

        </div>

        </div>

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
                                <option value="0">Pendientes</option>
                                <option value="1">Verificados</option>
                            </select>
                        </div>

                        <div class="md:flex-1 md:ml-4 sm:mt-2 md:mt-0">
                            <label class="text-gray-200 text-md ">Buscador por fecha</label>
                            <div class="lg:flex justify-items-stretch w-full ">
                                <div>
                                    <div wire:ignore x-data="datepicker()">
                                        <div class="flex flex-col">
                                            <div class="flex items-center gap-2">
                                                <input 
                                                    type="text" 
                                                    class="px-4 outline-none cursor-pointer rounded" 
                                                    x-ref="myDatepicker" 
                                                    wire:model="fecha_inicio" 
                                                    placeholder="Fecha inicio">
                                                    <span class="cursor-pointer underline" x-on:click="reset()">
                                                        <svg class="h-6 w-5 text-gray-400 " fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2C5.44772 2 5 2.44772 5 3V4H4C2.89543 4 2 4.89543 2 6V16C2 17.1046 2.89543 18 4 18H16C17.1046 18 18 17.1046 18 16V6C18 4.89543 17.1046 4 16 4H15V3C15 2.44772 14.5523 2 14 2C13.4477 2 13 2.44772 13 3V4H7V3C7 2.44772 6.55228 2 6 2ZM6 7C5.44772 7 5 7.44772 5 8C5 8.55228 5.44772 9 6 9H14C14.5523 9 15 8.55228 15 8C15 7.44772 14.5523 7 14 7H6Z"/>
                                                        </svg>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="ml-2 mr-2 text-gray-700 font-semibold">-</p>
                                <div>
                                    <div wire:ignore x-data="datepicker()" class=" ">
                                        <div class="flex flex-col">
                                            <div class="flex items-center gap-2">
                                                <input 
                                                    type="text" 
                                                    class="px-4 outline-none cursor-pointer rounded" 
                                                    x-ref="myDatepicker" 
                                                    wire:model="fecha_fin" 
                                                    placeholder="Fecha fin">
                                                <span class="cursor-pointer underline" x-on:click="reset()">
                                                    <svg class="h-6 w-5 text-gray-200" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2C5.44772 2 5 2.44772 5 3V4H4C2.89543 4 2 4.89543 2 6V16C2 17.1046 2.89543 18 4 18H16C17.1046 18 18 17.1046 18 16V6C18 4.89543 17.1046 4 16 4H15V3C15 2.44772 14.5523 2 14 2C13.4477 2 13 2.44772 13 3V4H7V3C7 2.44772 6.55228 2 6 2ZM6 7C5.44772 7 5 7.44772 5 8C5 8.55228 5.44772 9 6 9H14C14.5523 9 15 8.55228 15 8C15 7.44772 14.5523 7 14 7H6Z"/>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

   
    <div class="px-2 ">

        @if ($registros->count())

            <div class=" mt-8 mb-2">
                <h3 class="my-2 mx-4 text-gray-200 font-bold text-lg">Registro de pagos</h3>
            </div>
            
            <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>
                      
                        <th class="text-center py-3">
                            Fecha
                        </th>
                        <th 
                            class="text-center">
                            Plan
                        </th>
                        <th 
                            class="text-center">
                            Método
                        </th>
                        <th 
                            class="text-center">
                            Monto
                        </th>
                        <th 
                            class="text-center">
                            Usuario
                        </th>
                        <th 
                            class="text-center">
                            Admin Verif 1
                        </th>

                        <th 
                            class="text-center">
                            Admin Verif 2
                        </th>

                        <th 
                            class="text-center">
                            Constancia
                        </th>

                        <th 
                            class="text-center">
                            Observación
                        </th>

                        <th 
                         
                        </th>
                        
                    </tr>
                </thead>
                <tbody>

                    @foreach ($registros as $registro)
                        <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                            
                            <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                            {{\Carbon\Carbon::parse($registro->created_at)->format('d-m-Y')}}
                            </td>
                            <td class="text-center">
                            {{$registro->plan}}
                            </td>
                            <td class="text-center">
                            {{$registro->paymentMethod->name}}
                            </td>
                            <td class="text-center">
                            {{$registro->monto}}
                            </td>
                            <td class="text-center">
                            {{$registro->user_cliente->username}}
                            </td>

                            <td class="text-center">
                            @if ($registro->admin_verific)
                                {{$registro->admin_verific->name}}
                            @else
                            -
                            @endif
                            </td>
                            <td class="text-center">
                            @if($registro->admin_verific2)
                                {{$registro->admin_verific2->name}}
                                @else
                            -
                            @endif
                            </td>
                            <td class="text-center">
                                <button class="text-green-600 text-lg hover:text-green-900"
                                    
                                    wire:click="download('{{$registro->file}}')">
                                    <i class="fas fa-download"></i>
                                </button>
                            </td>

                            @if ($registro->comentario != '')
                                <td class="text-center">
                                    <button class="text-blue-600 text-lg hover:text-green-900"
                                        
                                        wire:click="comment('{{$registro->comentario}}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            @else
                                <td class="text-center">
                                N/A
                                </td>
                            @endif

                            <td class="text-center">
                                @livewire('admin.pagos-edit', ['registro' => $registro],key($registro->id))
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @else
            <div class="px-6 py-4">
                No hay ningún registro coincidente
            </div>
        @endif

        @if ($registros->hasPages())
            
            <div class="px-6 py-4">
                {{ $registros->links() }}
            </div>
            
        @endif


    @push('js')

        <script>
            document.addEventListener('alpine:init',()=>{
                Alpine.data('datepicker',()=>({
            
                    init(){
                        flatpickr(this.$refs.myDatepicker, {dateFormat:'Y-m-d H:i', altInput:true, altFormat: 'F j, Y',})
                    },
                }))
            })

        </script>

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
