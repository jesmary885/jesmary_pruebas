<?php

namespace App\Http\Livewire\Admin;

use App\Models\CuentaK;
use Livewire\Component;

class RegistrocCreate extends Component
{

    public $isopen = false;

    public $pid,$hash,$user,$tipo,$registro;

    protected $listeners = ['render'];

    protected $rules = [
        'pid' => 'required',
        'hash' => 'required',
    
    ];

    public function mount(){

         $this->user = auth()->user();

        if($this->tipo == 'editar'){

            $registro = CuentaK::where('id',$this->registro)
                ->first();

            $this->pid = $registro->pid;
            $this->hash = $registro->hash;

        }

    }

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
        return view('livewire.admin.registroc-create');
    }

    public function procesar(){

        if($this->tipo == 'agregar'){

            CuentaK::create([
                'pid' => $this->pid,
                'hash' => $this->hash,
                'user_id' => $this->user->id,
            ]);

            $this->reset(['hash','pid']);

            $this->emit('alert','Cuenta registrada correctamente'); 

        }
        else{

            $registro_modf = CuentaK::where('id',$this->registro)->first();

            $registro_modf->update([
                'pid' => $this->pid,
                'hash' => $this->hash,
            ]);

            $this->emit('alert','Datos modificados correctamente');
            

        }

        $this->emitTo('admin.registroc','render');
        $this->isopen = false; 

    }
}
