<?php

namespace App\Http\Livewire\Admin;

use App\Models\Links_usados;
use Livewire\Component;
use Livewire\WithPagination;

class KNuevas extends Component
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
        ->where('type','nuevo')
        ->latest('id')
        ->paginate(25);

        $total = Links_usados::where('type','nuevo')
        ->count();

        return view('livewire.admin.k-nuevas',compact('jumpers','total'));
    }

    public function ver_link($jumper){
        $jump = Links_usados::where('id',$jumper)->first();

        $this->emit('comment',$jump->link);
    }
}
