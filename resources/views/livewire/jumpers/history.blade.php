<div>
    <button type="submit" class="py-2 px-3 text-md font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" wire:click="open">
        <i class="fas fa-history"></i>
    </button>
    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> Historial de calificaciones</h5>
                    </div>
                    <div class="modal-body">
                        <p>Registrado por: {{$jumper->user->username}} </p>

                        @if ($califics->count())
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($califics as $calific)
                                    
                                            <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                                                <th scope="row" class="py-4 px-6 font-medium whitespace-nowrap text-white">
                                                {{$calific->created_at->format('d/m/Y h:i')}} 
                                                </th>
                                                <td class="py-4 px-6">
                                                <i class="{{$this->calificacion($calific->point)}}"></i>
                                                
                                                </td>
                                                <td class="py-4 px-6">
                                                {{$calific->user->username}}
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
                                <strong>Sin calificaciones regsitradas</strong>
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

