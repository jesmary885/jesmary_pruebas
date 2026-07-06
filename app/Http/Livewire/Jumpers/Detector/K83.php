<?php

namespace App\Http\Livewire\Jumpers\Detector;

use Livewire\Component;

use GuzzleHttp\Client;

class K83 extends Component
{

public $jumper_search, $respuesta, $error = 0, $jumper_detect,$posicion,$busqueda_id2,$psid_buscar,$psid_prov;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'jumper_search' => 'required',
    ];

     protected $rules_psid_prov = [
        'psid_prov' => 'required|min:6',
    ];

    public function render()
    {

        $this->jumper_search = trim($this->jumper_search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->jumper_search); //buscando cuantos caracteres tiene en total

        if($long_psid>=5){

            $busqueda_k1000_ = strpos($this->jumper_search, 'k=1083&');

            if($busqueda_k1000_ !== false){

                $busqueda_id1= strpos($this->jumper_search, 'psid=');
                $busqueda_id2= strpos($this->jumper_search, 'PSID=');
      


                if($busqueda_id1 !== false){

                    $this->posicion = $busqueda_id1;

                }elseif($busqueda_id2 !== false){
                    $this->posicion = $busqueda_id2;

                }
                else{
                    $this->psid_buscar = 'vacio';
                }

            }

        }
        return view('livewire.jumpers.detector.k83');
    }

    public function generar(){

        if($this->psid_buscar == 'vacio'){

            $rules_psid_prov = $this->rules_psid_prov;

            $this->validate($rules_psid_prov );

            $this->psid_buscar = $this->psid_prov;

            $posicion_def= strpos($this->jumper_search, $this->psid_buscar);

        }else{

            $posicion_def = $this->posicion+5;

        }

     
        $nuevoCaracter_2 = 'y';

        $caracterActual = $this->jumper_search[$posicion_def];

         if ($caracterActual !== 'x' && $caracterActual !== 'X' ) {
               
                $cadenaModificada = substr_replace($this->jumper_search, 'X', $posicion_def, 1);

        } else {

              $cadenaModificada = substr_replace($this->jumper_search, $nuevoCaracter_2, $posicion_def, 1);
        }


        try {
            $client = new Client();

            $response = $client->post('http://147.182.190.233/versiones_1083/1/', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                    'link' => $cadenaModificada
                ])
            ]);

            
            $respuesta_servidor = json_decode($response->getBody(),true);

            if($respuesta_servidor['jumper'] == 'El Jump es V1' ){
                return redirect()->route("k1083.index");
            } //con imperium o vieja
            elseif($respuesta_servidor['jumper'] == 'El Jump es V2'){
                return redirect()->route("k1083v2.index");
            } //sin imperium o nueva
            elseif($respuesta_servidor['jumper'] == 'El Jump es V3'){
                return redirect()->route("k1083v3.index");
            }
            else{

            } $this->error = 'Genera de acuerdo con los comentarios';
          

        }

        catch (\GuzzleHttp\Exception\RequestException $e) {
                
            $error['error'] = $e->getMessage();
            $error['request'] = $e->getRequest();

            if($e->getMessage()){
                if ($e->getResponse()->getStatusCode() !== '200'){
                    $error['response'] = $e->getResponse(); 
                    $this->jumper_detect = 15;
                }
            }
        }

    }

    public function clear(){
        $this->reset(['jumper_search']);
   
        return redirect()->route('version83.index');
    }
}
