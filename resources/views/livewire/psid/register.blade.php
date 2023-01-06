<div>
    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300"> Registro de psid o perfil</h5>
                    </div>
                    <div class="modal-body">
                    <h2 class="text-sm ml-2 m-0 p-0 text-gray-300 font-semibold"><i class="fas fa-info-circle"></i> El código PSID de su cuenta debe contener 22 digitos, ejemplo: A3G3_EllYvd6wEjHKyQDNw</h2> 
                    <hr class="m-2">
                
                        <div class="justify-between ">
                            <div class="form-group">
                                <label for="formGroupExampleInput">PSID:</label>
                                    <input type="text" wire:model="psid" class="form-control rounded" id="formGroupExampleInput">
                            </div>
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
