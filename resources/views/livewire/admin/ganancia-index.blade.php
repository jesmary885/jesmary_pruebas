<div>
    <div class="card">
        <div class="card-header flex items-center justify-between">
            <div>
                <div class="lg:flex justify-items-stretch w-full ml-4">
                    <div>
                        <div wire:ignore x-data="datepicker()">
                            <div class="flex flex-col">
                                <div class="flex items-center gap-2">
                                    <input 
                                        type="text" 
                                        class="px-4 outline-none cursor-pointer" 
                                        x-ref="myDatepicker" 
                                        wire:model="fecha_inicio" 
                                        placeholder="Seleccione la fecha fin">
                                        <span class="cursor-pointer underline" x-on:click="reset()">
                                            <svg class="h-6 w-5 text-gray-400 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 2C5.44772 2 5 2.44772 5 3V4H4C2.89543 4 2 4.89543 2 6V16C2 17.1046 2.89543 18 4 18H16C17.1046 18 18 17.1046 18 16V6C18 4.89543 17.1046 4 16 4H15V3C15 2.44772 14.5523 2 14 2C13.4477 2 13 2.44772 13 3V4H7V3C7 2.44772 6.55228 2 6 2ZM6 7C5.44772 7 5 7.44772 5 8C5 8.55228 5.44772 9 6 9H14C14.5523 9 15 8.55228 15 8C15 7.44772 14.5523 7 14 7H6Z"/>
                                            </svg>
                                        </span>
                                </div>
                             </div>
                        </div>
                    </div>

                    <p class="ml-2 mr-2 text-gray-700 font-semibold">-</p>
                    <div>
                        <div wire:ignore x-data="datepicker()" class=" ml-2">
                            <div class="flex flex-col">
                                 <div class="flex items-center gap-2">
                                    <input 
                                        type="text" 
                                        class="px-4 outline-none cursor-pointer" 
                                        x-ref="myDatepicker" 
                                        wire:model="fecha_fin" 
                                        placeholder="Seleccione la fecha fin">
                                    <span class="cursor-pointer underline" x-on:click="reset()">
                                        <svg class="h-6 w-5 text-gray-400 ml-2" fill="currentColor" viewBox="0 0 20 20">
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

        <div class="card-body mt-0">
            @if ($array)
                <table class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">
                                Método de pago
                            </th>
                            <th class="text-center">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($array)
                            @foreach ($array as $value)
                                <tr>
                                    <td class="text-center">
                                        {{$value['metodo_nombre']}}
                                    </td>
                                    <td class="text-center">
                                        {{$value['quantity']}}
                                    </td>
                                </tr>
                            @endforeach 
                        @endif  
                    </tbody>
                </table>
            @endif
        </div>


        @if ($sales->count())
            <div class="card-body mt-0">
                <table class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Cliente</th>
                            <th class="text-center">Método de pago</th>
                            <th class="text-center">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td class="text-center">{{  \Carbon\Carbon::parse($sale->created_at)->format('d-m-Y H:i') }}</td>
                                <td class="text-center">{{$sale->user->username}}</td>
                                <td class="text-center">{{$sale->paymentMethod->name}}</td>
                                <td class="text-center">{{$sale->total_paid}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                <div class="card-footer">
                    {{$sales->links()}}
                </div>
        @endif


            
    </div>

    <script>
    document.addEventListener('alpine:init',()=>{
        Alpine.data('datepicker',()=>({
    
            init(){
                flatpickr(this.$refs.myDatepicker, {dateFormat:'Y-m-d H:i', altInput:true, altFormat: 'F j, Y',})
            },
        }))
    })

</script>
</div>