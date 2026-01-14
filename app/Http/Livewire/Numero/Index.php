<?php

namespace App\Http\Livewire\Numero;

use App\Models\Numeros;
use App\Models\Trabajadores;
use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;
use App\Services\PvaDealsService;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;


class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";
    protected $listeners = ['render' => 'render'];

    public $lider,$rol,$search;

    public function mount(){


        $admin = 0;
        $user = User::where('id',auth()->user()->id)->first();

  

        $roles_user = $user->roles->all();

      
        foreach($roles_user as $rol){
            if($rol->id == 1) $admin ++;
        }

        if($admin == 1)$this->rol = 'Admin';
        else{


                $this->rol = 'Trabajador';
                 $this->lider=Trabajadores::where('user_id',$user->id)->first()->user_id;

        }
        
    }




    public function Activar($result){

        $numero = Numeros::where('id',$result)->first();


         try {

            $client = new Client(['base_uri' => 'http://67.205.168.133/',]);
        
            $resultado = $client->request('GET', '/Text_verified/1/'.$numero->codigo);

            if($resultado->getStatusCode() == 200){

                $respuesta = json_decode($resultado->getBody(),true);

                //dd($respuesta);

    

                // if($respuesta['Codigo'] == 'Tiempo de esperado para recibir el codigo 2 minutos'){
                //     $this->emit('alert4','Envia aproximadamente en 2 minutos');
                // }
                // else{

                     $this->emit('alert3',' <p class="text-md text-gray-200 underline m-0 font-bold p-0 text-justify"> Fecha: </p>'.'<p class="text-sm text-gray-200 m-0 font-bold p-0 text-justify">'.$respuesta['Fecha']  .'</p>'.' <br> <p class="text-md underline text-gray-200 m-0 font-bold p-0 text-justify"> Código: '.'<p class="text-sm text-gray-200 m-0 font-bold p-0 text-justify">'. $respuesta['codigo'].'</p>');
               // }

            }
        }
        catch (\GuzzleHttp\Exception\RequestException $e) {
           

            $error['error'] = $e->getMessage();
            $error['request'] = $e->getRequest();

            if($e->hasResponse()){
                if ($e->getResponse()->getStatusCode() !== '200'){

                    $error['response'] = $e->getResponse(); 
                  
                }
            }
        }
    }


    public function render()
    {


        if($this->rol == 'Admin'){

            $registros = Numeros::where('numero', 'LIKE', '%' . $this->search . '%')
                //->where('user_id',auth()->user()->id)
                ->get();


        }else{

            $registros = Numeros::where('numero', 'LIKE', '%' . $this->search . '%')
            //->where('user_id',$this->lider)
            ->get();


        }

        return view('livewire.numero.index', compact('registros'));
    }

   
}
