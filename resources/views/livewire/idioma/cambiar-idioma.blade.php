<div class="py-0 show" aria-labelledby="navbarVersionDropdown" style="left: 0px; right: inherit;">
     
    @foreach ($idiomas as $idioma)
        <button class="block dropdown-item" wire:click="cambiar_idioma('{{$idioma->id}}')">{{ $idioma->name }}</button>
    @endforeach
                
</div>

