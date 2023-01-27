<?php

namespace App\Http\Livewire\Marketplace;

use App\Models\Images;
use App\Models\Marketplace;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;

class CargaImagenes extends Component
{
    public $marketplace;

    protected $listeners = ['refreshMarketplace'];

    public function mount(Marketplace $marketplace){

        $this->marketplace = $marketplace;

    }
    public function render()
    {
        return view('livewire.marketplace.carga-imagenes');
    }

    public function refreshMarketplace(){
        $this->marketplace = $this->marketplace->fresh();
    }

    public function deleteImage(Images $image){
        Storage::delete([$image->url]);
        $image->delete();

        $this->marketplace = $this->marketplace->fresh();
    }
}
