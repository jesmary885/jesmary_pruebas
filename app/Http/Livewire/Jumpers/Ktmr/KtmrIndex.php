<?php

namespace App\Http\Livewire\Jumpers\Ktmr;

use App\Models\Antibot;
use Livewire\Component;
use GuzzleHttp\Client;

class KtmrIndex extends Component
{
    public $calculo = 0, $jumper_complete = "", $search, $psid_register=0,$pid_new=0,$type, $jumper_detect = 0,$busqueda_link,$psid_buscar,$operacion;

    protected $listeners = ['render' => 'render', 'jumpear' => 'jumpear', 'verific' => 'verific', 'jump' => 'jump'];

    public function numerologia(){

        $cant = Antibot::count();
        $random = rand(1,$cant);
        $this->calculo = 1;
        $this->operacion = Antibot::where('id',$random)->first();
        $operacion_total = 'Resuelve esta operación matemática ('.$this->operacion->nro1.' + '.$this->operacion->nro2. ')';

        $this->emit('numerologia',$operacion_total,'jumpers.ktmr.ktmr-index','verific');
    }

    public function verific($result){

        if($result[0] == $this->operacion->resultado){

            $this->emit('wait');       
        }

        else{
            $this->reset(['search','operacion']);
            $this->calculo = 0;
            $this->emit('error','Resultado incorrecto, intentalo de nuevo');
       
        }
    }

    public function jump(){
  
        $client = new Client([
            //'base_uri' => 'http://127.0.0.1:8000',
            'base_uri' => 'http://209.94.57.88/',
        ]);

        $resultado = $client->request('GET', '/ktmr/1/'.$this->psid_buscar);

        if($resultado->getStatusCode() == 200){
            $this->jumper_detect = 1;

            $this->jumper_complete = json_decode($resultado->getBody(),true);
        }

        else{
             $this->jumper_detect = 3;
        }
    }



    public function render()
    {
        //$this->jumper_complete = 0;
        $link_complete = 0;
        $this->jumper_detect = 0;

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        if($long_psid>5){

            $busqueda_f_ = strpos($this->search, '/Fingerprint/');

            if($busqueda_f_ != false) $this->psid_buscar= substr($this->search, $busqueda_f_ + 13);
            else $this->psid_buscar= $this->search;

            //dd($this->psid_buscar);

            if($this->jumper_complete == "" && $this->calculo == 0) $this->numerologia();
        }
        
        return view('livewire.jumpers.ktmr.ktmr-index');
    }

    public function clear(){
        $this->reset(['search']);
        $this->jumper_complete = [];
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('ktmr.index');
    }
}
