<?php

namespace App\Http\Livewire\Compras;

use App\Models\saleMarketplace;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ComprasIndex extends Component
{
    public $search;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $marketplaces = saleMarketplace::whereHas('marketplace',function(Builder $query){
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        })
        ->where('user_id',Auth::id())
        ->latest('id')
        ->paginate(25);

        return view('livewire.compras.compras-index',compact('marketplaces'));
    }
}
