<div>
    <button type="submit" class="btn btn-primary btn-sm float-right" wire:click="open">
        <i class="fas fa-plus-circle"></i> IMPORTAR
    </button>

    @if ($isopen)
        <div class="modal d-block" tabindex="-1" role="dialog" style="overflow-y: auto; display: block;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title py-0 text-lg text-gray-300">ADJUNTE EL ARCHIVO</h5>
                    </div>
                    <div class="modal-body">

                        <form action="{{route('cint.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="import_file">
                            <div class="flex justify-end mt-4">
                                <div>
                                    <button type="submit" class="mr-2 btn btn-success disabled:opacity-25 justify-center" wire:loading.attr="disabled" ><i class="far fa-file-excel"></i> Importar</button>
                                </div>
                                <hr>
                            </div>
                        </form>
                        <hr>
                       
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="close">Cerrar</button>
                        <button type="button" class="btn btn-primary" wire:click="save">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

