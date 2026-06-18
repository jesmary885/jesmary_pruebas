<?php

namespace App\Http\Livewire\Admin;

use App\Models\UseYunkei;
use Livewire\Component;
use Livewire\WithPagination;

class RegistroJunkie extends Component
{

    use WithPagination;

    public $user;

     protected $paginationTheme = "bootstrap";

    protected $listeners = [
        'render' => 'render',
    ];

    public function mount(){
        $this->user = auth()->user();
    }

    public function render()
    {

        $registros = UseYunkei::latest('id')
            ->paginate(20);

        return view('livewire.admin.registro-junkie',compact('registros'));
    }
}
