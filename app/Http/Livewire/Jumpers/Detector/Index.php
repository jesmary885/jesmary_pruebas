<?php

namespace App\Http\Livewire\Jumpers\Detector;

use Livewire\Component;

use GuzzleHttp\Client;

class Index extends Component
{
    public $jumper_search, $respuesta, $error = 0, $jumper_detect;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'jumper_search' => 'required',
    ];
    public function render()
    {
        return view('livewire.jumpers.detector.index');
    }

    public function generar(){

        try {
            $client = new Client();

            $response = $client->post('http://147.182.190.233/score/1/', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                    'link' => $this->jumper_search
                ])
            ]);

            
            $respuesta_servidor = json_decode($response->getBody(),true);

            if($respuesta_servidor['jumper'] == 'El Jump es V1' ) $version = 'v1'; //con imperium o vieja
            elseif($respuesta_servidor['jumper'] == 'El Jump es V2') $version = 'v2'; //sin imperium o nueva
            elseif ($respuesta_servidor['jumper'] == 'El Jump bajo comentario') $version = 'comentario';
            else $version = 'error';

            $busqueda_k23_ = strpos($this->jumper_search, 'k=23&');
            $busqueda_k1083_ = strpos($this->jumper_search, 'k=1083&');
            $busqueda_k1000_ = strpos($this->jumper_search, 'k=1000&');

            if($busqueda_k23_ !== false || $busqueda_k1083_ !== false || $busqueda_k1000_ !== false){

                if($version == 'v1'){
                    if($busqueda_k23_ !== false) return redirect()->route("k23_poderosa.index");
                    elseif($busqueda_k1083_ !== false) return redirect()->route("k1083.index");
                    else return redirect()->route("admin.yoursurveynow");
                }
                elseif($version == 'v2'){
                    if($busqueda_k23_ !== false) return redirect()->route("k23_poderosav2.index");
                    elseif($busqueda_k1083_ !== false) return redirect()->route("k1083v2.index");
                    else return redirect()->route("kmil_poderosa1.index");
                }
                elseif($version == 'comentario'){
                    $this->error = 'Genera de acuerdo con los comentarios';
                }
                else $this->error = 'El link de la encuesta es incorrecto o la encuesta esta cerrada';

            }

            else{
                $this->error = 'Esta sección es solo para K-23, K1083 y K1000';
            }



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
   
        return redirect()->route('version.index');
    }
}
