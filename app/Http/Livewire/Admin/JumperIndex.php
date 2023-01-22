<?php

namespace App\Http\Livewire\Admin;

use App\Models\Link;
use Livewire\Component;
use Livewire\WithPagination;

class JumperIndex extends Component
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
        $jumpers = Link::where('psid', 'LIKE', '%' . $this->search . '%')
        ->orwhere('jumper', 'LIKE', '%' . $this->search . '%')
        ->latest('id')
        ->paginate(10);

        $total = Link::count();

        return view('livewire.admin.jumper-index',compact('jumpers','total'));
    }

}
