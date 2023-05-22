<?php

namespace App\Http\Livewire\Jumpers\Samplicio;

use App\Models\Link;
use Livewire\Component;

class SamplicioCreate extends Component
{
    public $isopen = false, $id_id, $token;

    protected $rules_create = [
        'id_id' => 'required|min:7',
        'token' => 'required',
    ];

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function render()
    {
        return view('livewire.jumpers.samplicio.samplicio-create');
    }

    public function save(){
        $rules_create = $this->rules_create;
        $this->validate($rules_create);

        $user_auth =  auth()->user()->id;

        $jumper = Link::where('jumper',$this->token)->first();

        if($jumper){

            $jumper->update([
                'psid' => $this->id_id,
                'user_id' => $user_auth,
                'jumper_type_id' => 11,
            ]);

        }else{
            $link = new Link();
            $link->psid = $this->id_id;
            $link->jumper = $this->token;
            $link->user_id = $user_auth;
            $link->jumper_type_id = 11;
            $link->save();

        }

        

        $this->reset(['id','isopen','token']);
        $this->emit('alert','Datos registrados correctamente');
        $this->emitTo('jumpers.samplicio.samplicio-index-principal','render');
    }

}
