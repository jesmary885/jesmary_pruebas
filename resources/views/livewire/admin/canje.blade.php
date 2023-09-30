<div>
    <div class="card">
        <div class="card-header">

        </div>
        @if ($canjes->count())
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="table text-sm table-bordered table-responsive-lg table-responsive-md table-responsive-sm">
                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>
                        <th class="text-center py-3">Fecha</th>
                        <th class="text-center py-3">K</th>
                        <th class="text-center p">USUARIO</th>
                 
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($canjes as $canje)
                            <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">

                                <td class="py-3 text-center font-medium whitespace-nowrap text-white">
                                {{\Carbon\Carbon::parse($canje->created_at)->format('d-m-Y h:i')}}
                                </td>
                              
                                <td class="text-center py-3 px-2">{{$canje->k}}</td>

                                <td class="text-center py-3 px-2">{{$canje->user->username}}</td>
                                
                            
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                    {{$canjes->links()}}
            </div>
        @else
             <div class="card-body">
                <strong>No hay registros</strong>
            </div>
        @endif
            
    </div>


</div>
