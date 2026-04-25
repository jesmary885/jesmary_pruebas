<?php

namespace App\Http\Livewire\Admin;

use App\Models\Numeros;
use App\Models\User;
use Livewire\Component;

class ControlCuentasRegistro extends Component
{

 public $isopen = false;

    public $pid,$hash,$user,$tipo,$registro,$numero,$codigo,$status,$type,$trabajador_id,$trabajadores;

    protected $listeners = ['render'];

    protected $rules = [
        'pid' => 'required',
        'hash' => 'required',
    
    ];

    public function mount(){

         $this->user = auth()->user();

        if($this->tipo == 'editar'){

            $registro = Numeros::where('id',$this->registro)
                ->first();

            $this->numero = $registro->numero;
            $this->codigo = $registro->codigo;
            $this->status = $registro->status;
            $this->trabajadores = User::where('status','activo')
                ->permission('ssidkr.index')
                ->get();

            $this->trabajador_id = $registro->trabajador_id;

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
        return view('livewire.admin.control-cuentas-registro');
    }

     public function procesar(){

        $buscar = Numeros::where('numero',$this->numero)->first();

        if($buscar){

    
        $this->emitTo('admin.control-numeros','render');
            $this->emit('alert','Ya el número se encuentra registrado'); 

            $this->isopen = false; 

        }
        else{

            if($this->tipo == 'agregar'){

                Numeros::create([
                    'mumero' => $this->numero,
                    'codigo' => $this->codigo,
                    'user_id' => '2',
                    'type' => 'ER',
                    'status' => 'activo'
                ]);

                Numeros::create([
                    'mumero' => $this->numero,
                    'codigo' => $this->codigo,
                    'user_id' => '2',
                    'type' => 'VO',
                    'status' => 'activo'
                ]);


                Numeros::create([
                    'mumero' => $this->numero,
                    'codigo' => $this->codigo,
                    'user_id' => '2',
                    'type' => 'QT',
                    'status' => 'activo'
                ]);


                Numeros::create([
                    'numero' => $this->numero,
                    'codigo' => $this->codigo,
                    'user_id' => '2',
                    'type' => 'OO',
                    'status' => 'activo'
                ]);


                $this->reset(['numero','codigo']);

                $this->emit('alert','Datos registrada correctamente'); 

            }
            else{

                $registro_modf = Numeros::where('id',$this->registro)->first();

                dd($registro_modf);

                $registro_modf->update([
                    'numero' => $this->numero,
                    'codigo' => $this->codigo,
                    'status' => $this->status,
                    'trabajador_id' => $this->trabajador_id
                ]);

                $this->emit('alert','Datos modificados correctamente');
            }

            $this->emitTo('admin.control-numeros','render');
            $this->isopen = false; 

            
        }

       
    }
}
