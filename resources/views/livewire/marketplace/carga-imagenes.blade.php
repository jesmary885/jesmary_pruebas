<div>

    <h5 class=" container modal-title py-0 text-lg text-gray-300 font-bold mt-4"> Registro de imágenes del producto</h5>
        
        
                
                        <hr class="m-2 p-2">

                        <div class="mb-4" wire:ignore>
                            <form action="{{ route('marketplace.files', $marketplace) }}" method="POST" class="text-gray-800 dropzone bg-gray-300" 
                            id="my-awesome-dropzone">

                            </form>
                        </div>

                        @if ($marketplace->images->count())

                            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                                <h1 class="text-2xl text-center font-semibold mb-2 text-gray-600">Imágenes del producto</h1>
                                <hr class="m-2 p-2">

                                <ul class="flex flex-wrap">
                                    @foreach ($marketplace->images as $image)

                                        <li class="relative" wire:key="image-{{ $image->id }}">
                                            <img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}" alt="">
                                            <x-jet-danger-button class="absolute right-2 top-2"
                                                wire:click="deleteImage({{ $image->id }})" wire:loading.attr="disabled"
                                                wire:target="deleteImage({{ $image->id }})">
                                                x
                                            </x-jet-danger-button>
                                        </li>

                                    @endforeach

                                </ul>
                            </section>

                        @endif

                      


                        
                   
                        <button type="button" class="btn btn-primary" wire:click="regresar">Regresar</button>

         

        @push('js')
    {{-- dropzone --}}
    
        <script>

            
            Dropzone.options.myAwesomeDropzone = {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre una(s) imagen(es) al recuadro o haga click aquí para seleccionarlas",
                acceptedFiles: 'image/*',
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function() {
                    Livewire.emit('refreshMarketplace');
                }
            };


        </script>
     @endpush
       
   
</div>
