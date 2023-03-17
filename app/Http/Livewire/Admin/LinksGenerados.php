<?php

namespace App\Http\Livewire\Admin;

use App\Models\Links_usados;
use Livewire\Component;
use Livewire\WithPagination;

class LinksGenerados extends Component
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
        $jumpers = Links_usados::where('k_detected', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(25);

        $total = Links_usados::count();

        return view('livewire.admin.links-generados',compact('jumpers','total'));
    }
}
