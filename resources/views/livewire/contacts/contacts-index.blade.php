<div>

<div class="card">
    <div class="card-header row flex justify-between">
        <div class="flex-grow-1">
                <input wire:model="search" placeholder="{{__('messages.busqueda_contacto')}}" class="form-control">
        </div>
        <div class="ml-2 mr-2 mt-1">
         @livewire('contacts.contacts-create',['accion' => 'create'])
        </div>
    </div>
</div>


@if ($contacts->count())
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-400">
            <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                    {{__('messages.nombre')}}
                    </th>
                    <th scope="col" class="py-3 px-6">
                    {{__('messages.username')}}
                    </th>
                   
                    <th colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr class="bg-gray-800 border-gray-700 hover:bg-gray-600">
                        <th scope="row" class="py-4 px-6 font-medium whitespace-nowrap text-white">
                        {{$contact->name}} 
                        </th>
                        <td class="py-4 px-6">
                        {{$contact->user->username}}
                        </td>
                
                        <td class="mr-2" width="10px">
                        @livewire('contacts.contacts-create',['accion' => 'edit', 'contact' => $contact],key($contact->id)) 
                        </td>

                        <td width="10px">
                            <button
                                class="btn btn-danger btn-sm mr-2" 
                                wire:click="delete('{{$contact->id}}')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>

                        <td width="10px">
                            <button
                                class="btn btn-success btn-sm mr-2" 
                                wire:click="contact('{{$contact->user->id}}')">
                                <i class="fas fa-comment"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$contacts->links()}}
    </div>
@else
    <div class="card-body">
        <strong>No hay registros</strong>
    </div>
@endif

</div>