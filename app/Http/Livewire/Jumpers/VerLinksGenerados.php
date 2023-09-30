<?php

namespace App\Http\Livewire\Jumpers;

use App\Models\Links_usados;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class VerLinksGenerados extends Component
{

    protected $listeners = ['render' => 'render'];

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $user,$isopen;

    public function mount(){
        $this->user = User::where('id',Auth::id())->first();
    }

    public function open()
    {
        $this->isopen = true;  
        $this->emitTo('jumpers.ver-links-generados','render');
    }
    public function close()
    {
        $this->isopen = false;  
        $this->emit('volver');
    }
    public function render()
    {

        $jumpers = Links_usados::where('user_id', Auth::id()) 
                    ->latest('id')
                    ->take('10')
                    ->paginate(5);

        return view('livewire.jumpers.ver-links-generados',compact('jumpers'));
    }
}
