<?php

namespace App\Http\Livewire\Jumpers;

use App\Models\Antibot;
use App\Models\User;
use DateTime;
use App\Models\Comments;
use App\Models\Link;
use App\Models\Links_usados;
use App\Models\User_Links_Points;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Livewire\WithPagination;

use Livewire\Component;

class PollfishIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_list = 0,$busqueda_link,$comment_new_psid_register,$pid_register_high,$psid_register_bh,$high_register_bh,$basic_register_bh,$posicionpid,$psid_detectado,$posicion_total_k,$posicionk,$no_jumpear,$posicion, $no_detect = '0', $jumper_detect = 0, $k_detect = '0', $wix_detect = '0', $psid_register=0,$jumper_redirect,$link_complete_2,$calculo_high = 0,$pid_new=0,$search,$jumper_2,$points_user,$user_auth,$comentario,$is_high,$is_basic,$calc_link,$jumper_select,$points_user_positive, $points_user_negative, $jumper_detect_k ='',$pid_manual,$pid_detectado = 'si',$pid_buscar,$psid_buscar,$operacion;

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid','verific' => 'verific', 'confirmacion' => 'confirmacion'];
    
    public function mount(){

        $this->user_auth =  auth()->user()->id;
        if(session('pid')) $this->pid_new = session('pid');
        if(session('psid')) $this->psid_register = session('psid');
        if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;
        $this->jumper_list = 0;
        $this->busqueda_link = "";

        $this->user = User::where('id',auth()->user()->id)->first();
    }


    public function numerologia(){

        $cant = Antibot::count();
        $random = rand(1,$cant);
        $this->operacion = Antibot::where('id',$random)->first();
        $operacion_total = 'Resuelve esta operación matemática ('.$this->operacion->nro1.' + '.$this->operacion->nro2. ')';

        $this->emit('numerologia',$operacion_total,'jumpers.pollfish.pollfish-index','verific');
    }

    public function verific($result){

        if($result[0] == $this->operacion->resultado){



            $busqueda= strpos($this->search, '.com/r/');


            $posicion_elem1 = $busqueda + 7;
            $i_elem1 = 0;
            $busq_elem1 = 0;
            
            do{
                $detect_elem1= substr($this->search, $posicion_elem1,1);

                if($detect_elem1 == '/') $i_elem1 = 1;
                else{
                    $posicion_elem1 = $posicion_elem1 + 1;
                    $busq_elem1 ++;
                }

                if($busq_elem1 > 200){
                    $i_elem1 = 1;
                }

            }while($i_elem1 != 1);

            $token_1 = substr($this->search,($busqueda + 7),($posicion_elem1 - ($busqueda + 7)));


            ////////////////////


            $posicion_elem2 = $posicion_elem1 + 1;
            $i_elem2 = 0;
            $busq_elem2 = 0;

            do{
                $detect_elem2= substr($this->search, $posicion_elem2,1);
                
                if($detect_elem2 == '/' || $detect_elem2 == '&' || $detect_elem2 == '?') $i_elem2 = 1;
                else{
                    $posicion_elem2 = $posicion_elem2 + 1;
                        $busq_elem2 ++;
                }

                if($busq_elem2 > 200){
                    $i_elem2 = 1;
                }
                
            }while($i_elem2 != 1);

            $token_2 = substr($this->search,($posicion_elem1 + 1),($posicion_elem2 - ($posicion_elem1 + 1)));


            try {
                $client = new Client(['base_uri' => 'http://67.205.168.133/',]);
    
                $resultado = $client->request('GET', '/Saltador_pollfish/1/'.$token_1.'/'.$token_2 );

                if($resultado->getStatusCode() == 200){

                    $this->jumper_complete = json_decode($resultado->getBody(),true);

                    $link_register = new Links_usados();
                    $link_register->link = $this->search;
                    $link_register->k_detected  = 'POLLFISH';
                    $link_register->link_resultado = $this->jumper_complete['jumper'];
                    $link_register->user_id  = auth()->user()->id;
                    $link_register->save();


                    $this->jumper_list = 1;
                    $this->jumper_detect = 1;

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

        else{

            $this->reset(['operacion']);

            $this->emit('error','Resultado incorrecto, intentalo de nuevo');
       
        }

      
    }

    public function render()
    {

        $subs_psid = '0';
        $comments =0;
        $jumper = "";
        $link_complete="";

        $busqueda_link_def = "";
        $this->no_jumpear = 0;
        $this->k_detect = '0';
        //$this->jumper_detect = 0;
        //$this->busqueda_link = "";
        $this->no_detect = '0';
        $this->comment_new_psid_register = '';
        $this->posicion = 8; //me esta buscand a partir de https://

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total


        if($long_psid>=5 && $this->jumper_detect == 0){

            $this->numerologia();

        }

        return view('livewire.jumpers.pollfish-index');
    }

    public function clear(){

        $this->reset(['search']);
        $this->jumper_list = 0;
        $this->jumper_detect = 0;
        $this->jumper_complete = [];
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('pollfish.index');

  }

}
