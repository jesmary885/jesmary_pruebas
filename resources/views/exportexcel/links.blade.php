
<p class="text-gray-500 text-md font-bold bg-white text-center rounded shadow-lg border h-8"> JUMPERS GENERADOS </p>

<table class="table table-striped w-full">
    <thead>
        <tr class="text-gray-500 text-md font-bold bg-white rounded shadow-lg border h-8">
      
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Tipo de jumper</th>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Link inicial</th>
                            <th class="text-center">Jumper generado</th>

        </tr>
    </thead>
    <tbody>
        
        @foreach ($links as $value)
            <tr class="py-2 border-collapse border border-gray-300">
               
                <td class="text-center">{{$value->created_at}}</td>
                <td class="text-center">{{$value->k_detected}}</td>
                <td class="text-center">{{$value->user->username}}</td>
                <td class="text-center">{{$value->link}}</td>
                <td class="text-center">{{$value->link_resultado}}</td>
            </tr>
        @endforeach 
    </tbody>
</table>