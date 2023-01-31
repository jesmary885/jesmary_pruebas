<?php

namespace App\Http\Livewire\Marketplace;

use App\Models\Marketplace;
use Livewire\Component;
use Livewire\WithPagination;

class MarketplaceIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $category,$type;

    public $marketplaces = [];

    public function loadPosts(){

        if($this->type == 'venta'){
            $this->marketplaces = $this->category->Marketplaces()
            ->where('status', 'Habilitado')
            ->where('type', 'venta')
            ->get();

            $this->emit('glider', $this->category->id,'venta');
        }
        else{
            $this->marketplaces= $this->category->Marketplaces()
            ->where('status', 'Habilitado')
            ->where('type', 'compra')
            ->get();

            $this->emit('glider', $this->category->id,'compra');
        }
    }

 
    public function render()
    {
        return view('livewire.marketplace.marketplace-index');
    }
}
