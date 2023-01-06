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

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        $marketplaces = Marketplace::where('name', 'LIKE', '%' . $this->search . '%')
            ->where('status','Habilitado')
            ->latest('id')
            ->paginate(5);

        return view('livewire.marketplace.marketplace-index',compact('marketplaces'));
    }
}
