<?php

namespace App\Http\Livewire\Cuentas;

use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;

class Registro extends Component
{

    public  $user, $jumper_complete = [],$jumper_detect = 0, $dia,$mes,$ano,$firstname,$lastname,$gender,$email,$password,$zip,$address,$capt,$opcion;

    protected $listeners = ['render' => 'render'];


    protected $rules = [
        'dia' => 'required|integer|max:31|digits:2',
        'mes' => 'required|integer|max:12',
        'ano' => 'required|integer|digits:4',
        'firstname' => 'required',
        'lastname' => 'required',
        'gender' => 'required',
        'email' => 'required|email|max:255',
        'password' => 'required', 
        'zip' => 'required',
        'address' => 'required',
        'capt' => 'required',
        'opcion' => 'required',
    ];
    
    public function mount(){


      //  if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;

        $this->user = User::where('id',auth()->user()->id)->first();
    }


    public function procesar(){

  

        $rules = $this->rules;
        $this->validate($rules);

        $birthDate = $this->mes.'/'.$this->dia.'/'.$this->ano;


        try {

            $client = new Client();

                if($this->opcion == 'VO'){

                    $resultado = $client->post('http://147.182.190.233/Registro_VO/', [
                        'headers' => ['Content-Type' => 'application/json'],
                        'body' => json_encode([
                            "firstName"=> $this->firstname,
                            "lastName"=> $this->lastname,
                            "gender"=> $this->gender,
                            "birthDate"=> $birthDate,
                            "email"=> $this->email,
                            "password"=> $this->password,
                            "zipc"=> $this->zip,
                            "streetAddress1"=> $this->address,
                            "captcha"=> $this->capt,
                
                        ])
                    ]);
                }
                elseif($this->opcion == 'ER'){
                    $resultado = $client->post('http://147.182.190.233/Registro_ER/', [
                        'headers' => ['Content-Type' => 'application/json'],
                        'body' => json_encode([
                            "firstName"=> $this->firstname,
                            "lastName"=> $this->lastname,
                            "gender"=> $this->gender,
                            "birthDate"=> $birthDate,
                            "email"=> $this->email,
                            "password"=> $this->password,
                            "zipc"=> $this->zip,
                            "streetAddress1"=> $this->address,
                            "captcha"=> $this->capt,
                
                        ])
                    ]);

                }
                else{
                    $resultado = $client->post('http://147.182.190.233/Registro_OO/', [
                        'headers' => ['Content-Type' => 'application/json'],
                        'body' => json_encode([
                            "firstName"=> $this->firstname,
                            "lastName"=> $this->lastname,
                            "gender"=> $this->gender,
                            "birthDate"=> $birthDate,
                            "email"=> $this->email,
                            "password"=> $this->password,
                            "zipc"=> $this->zip,
                            "streetAddress1"=> $this->address,
                            "captcha"=> $this->capt,
                
                        ])
                    ]);
                }

            
           
     
            if($resultado->getStatusCode() == 200){


               $this->jumper_complete = json_decode($resultado->getBody(),true);

           

                if(!$this->jumper_complete)  $this->jumper_detect = 2;

            }

            else{

                $this->jumper_detect = 2;
            }
        }
        catch (\GuzzleHttp\Exception\RequestException $e) {
            
            $error['error'] = $e->getMessage();
            $error['request'] = $e->getRequest();

            if($e->hasResponse()){
                if ($e->getResponse()->getStatusCode() !== '200'){

                    $error['response'] = $e->getResponse(); 
                    $this->jumper_detect = 2;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.cuentas.registro');
    }
}
