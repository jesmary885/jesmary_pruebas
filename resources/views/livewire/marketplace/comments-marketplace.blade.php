<div>
    <button type="submit" class="py-2 px-3 text-md font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" wire:click="open">
        Ver reseñas
    </button>
    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="flex justify-between w-full">
                            <div class="flex-1">
                                <h5 class="modal-title py-0 text-lg text-gray-300"> Reseñas sobre el {{$tipo}}</h5>
                            </div>
                            <button type="button" class="btn" data-dismiss="modal" wire:click="close"><i class="fas fa-window-close"></i></button>
                        </div>

                        
                    </div>
                    <div class="modal-body">

                        @if ($califics->count())
                        <div class="flex justify-center">
                            <h2 class="text-gray-200 text-lg font-semibold mb-2">Puntos registrados</h2>
                        </div>
                        <div class="flex justify-center mb-4">
                            <button disabled
                                class="py-2 px-3 mr-4 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                                title="Positivo">
                                <i class="font-semibold far fa-thumbs-up">{{$points_positive}}</i>
                            </button>

                            <button disabled
                                class="py-2 px-3 text-md font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" 
                                title="Negativo">
                                <i class="font-semibold far fa-thumbs-down">{{$points_negative}}</i>
                            </button>
                        </div>

                        <div class="flex justify-center">
                            <h2 class="text-gray-200 text-md font-semibold text-lg mb-2">Historial de reseñas</h2>

                        </div>

                        
                            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-400">
                                    <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                                        <tr>
                                            <th scope="col" class="py-3 px-6">
                                            Fecha
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                            Calificación
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                            Usuario
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                            Comentario
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($califics as $calific)
                                    
                                            <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                                <th scope="row" class="py-4 px-6 font-medium whitespace-nowrap text-white">
                                                {{$calific->created_at->format('d/m/Y h:i')}} 
                                                </th>
                                                <td class="py-4 px-6">
                                                
                                                {{$calific->categoria_comentario}}
                                                </td>
                                                <td class="py-4 px-6">
                                                {{$calific->envia->username}}
                                                </td>
                                                <td class="py-4 px-6">
                                                {{$calific->comment}}
                                                </td>
                                            
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{$califics->links()}}
                            </div>
                        @else
                            <div class="card-body">
                                <strong>Sin reseñas regsitradas</strong>
                            </div>
                        @endif
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">{{__('messages.Cerrar')}}</button>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>