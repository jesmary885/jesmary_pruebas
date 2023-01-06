<?php

namespace App\Http\Livewire\Footer;

use App\Models\User;
use Livewire\Component;

class Bloc extends Component
{
    public $isopen = false,$bloc;

    protected $listeners = ['render' => 'render'];

    public function open()
    {
        $this->isopen = true;  
        $this->emitTo('footer.bloc','render');
    }
    public function close()
    {
        $this->isopen = false;  
        $this->emit('volver');
    }

    public function mount(){
        if(auth()->user()->bloc){
            $this->bloc = auth()->user()->bloc;
        }
    }

    public function render()
    {
        return view('livewire.footer.bloc');
    }

    public function save(){
        if ( strlen( $this->bloc ) <  4294967200){
            $user = User::where('id',auth()->user()->id)->first();

            $user->update([
                    'bloc' => $this->bloc
            ]);

            $this->emit('volver');
        }

        else{
            $this->emit('error','Tu bloc se excede de la cantidad máxima de caracteres permitido');
        }
    }
}
