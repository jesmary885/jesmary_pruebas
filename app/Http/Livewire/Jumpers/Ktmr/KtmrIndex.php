<?php

namespace App\Http\Livewire\Jumpers\Ktmr;

use Livewire\Component;
use GuzzleHttp\Client;

class KtmrIndex extends Component
{
    public $jumper_complete = "", $search, $psid_register=0,$pid_new=0,$type, $jumper_detect = 0,$busqueda_link,$psid_buscar;

    protected $listeners = ['render' => 'render', 'jumpear' => 'jumpear'];

    public function jumpear(){
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

        session()->forget('search');

    }

    public function wait(){
        $this->emit('wait');
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

            if($this->jumper_complete == "") $this->wait();
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
