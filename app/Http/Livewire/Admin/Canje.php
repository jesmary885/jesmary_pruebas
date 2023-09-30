<?php

namespace App\Http\Livewire\Admin;

use App\Models\RecargaLink;
use Livewire\Component;
use Livewire\WithPagination;

class Canje extends Component
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
        $canjes = RecargaLink::latest('id')
        ->paginate(25);

        return view('livewire.admin.canje',compact('canjes'));
    }
}
