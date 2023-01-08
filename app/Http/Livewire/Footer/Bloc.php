<?php

namespace App\Http\Livewire\Footer;

use App\Models\User;
use Livewire\Component;

class Bloc extends Component
{
    public $bloc;

    protected $listeners = ['render' => 'render'];

    public function mount(){
        if(auth()->user()->bloc){
            $this->bloc = auth()->user()->bloc;
        }
    }

    public function render()
    {

            if ( strlen( $this->bloc ) <  429496){
                $user = User::where('id',auth()->user()->id)->first();
    
                $user->update([
                    'bloc' => $this->bloc
                ]);

               // session(['bloc' => $this->bloc]);
            }
    
            else{
                $this->emit('error','Tu bloc se excede de la cantidad máxima de caracteres permitidos');
            }

        return view('livewire.footer.bloc');
    }


}
