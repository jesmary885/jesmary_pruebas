<div>
    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <div class="flex justify-between w-full">
                            <div class="flex-1">
                            <h5 class="modal-title py-0 text-lg text-gray-300"> Tu bloc de notas</h5>
                            </div>
                            <button type="button" class="btn" data-dismiss="modal" wire:click="close"><i class="fas fa-window-close"></i></button>
                        </div>
                        
                    </div>
                    <div class="modal-body">

                        <div class="form-group">

                            <textarea class=" form-control" rows="15" name="editor" wire:model="bloc"></textarea>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">{{__('messages.Cerrar')}}</button>
                        <button type="button" class="btn btn-primary" wire:click="save">{{__('messages.Guardar')}}</button>
                    </div>
                </div>
            </div>
          
        </div>
       
       
    @endif

    @push('js')


    <script>
        Livewire.on('volver', function(){
            window.history.back();      
        })
    </script>

    @endpush



    
    
</div>

