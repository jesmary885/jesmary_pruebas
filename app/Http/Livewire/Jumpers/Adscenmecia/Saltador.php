<?php

namespace App\Http\Livewire\Jumpers\Adscenmecia;

use App\Models\Links_usados;
use App\Models\User;
use DateTime;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class Saltador extends Component
{
     use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_detect = 0, $app_id, $search, $survery_id;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'search' => 'required',
    ];
    
    public function mount(){


      //  if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;

        $this->user = User::where('id',auth()->user()->id)->first();
    }

    public function clear(){
        $this->reset(['search']);
       // $this->informacion_complete = [];
        $this->jumper_complete = [];

         $this->jumper_detect = 0;
        //$this->emitTo('jumpers.encuestar.encuestar1-index','render');
    }

    public function procesar(){

        $rules = $this->rules;
        $this->validate($rules);

          ///////BUSQUEDA AFF //////////////////////////////////////////////////////////////////////////////

            $busqueda_aff= strpos($this->search, 'aff=');

            if($busqueda_aff != false){
                $posicion_aff = $busqueda_aff+ 4;
                $i_aff = 0;
                $busq_aff = 0;

                do{
                    $detect_aff= substr($this->search, $posicion_aff,1);
            
                    if($detect_aff == '&') $i_aff = 1;
                    else{
                        $posicion_aff = $posicion_aff + 1;
                        $busq_aff ++;
                    }

                    if($busq_aff > 300){
                        $i_aff = 2;
                    }
            
                }while($i_aff == 0 );

                if($i_aff == 1) $aff = substr($this->search,($busqueda_aff + 4),($posicion_aff - ($busqueda_aff + 4)));
                else $aff = substr($this->search,($posicion_aff ));
            }

            ///////BUSQUEDA CAMP//////////////////////////////////////////////////////////////////////////////

            $busqueda_camp= strpos($this->search, '&camp=');

            if($busqueda_camp != false){
                $posicion_camp = $busqueda_camp+ 6;
                $i_camp = 0;
                $busq_camp = 0;

                do{
                    $detect_camp= substr($this->search, $posicion_camp,1);
            
                    if($detect_camp == '&') $i_camp = 1;
                    else{
                        $posicion_camp = $posicion_camp + 1;
                        $busq_camp ++;
                    }

                    if($busq_camp > 300){
                        $i_camp = 2;
                    }
            
                }while($i_camp == 0 );

                if($i_camp == 1) $camp = substr($this->search,($busqueda_camp + 6),($posicion_camp - ($busqueda_camp + 6)));
                else $camp = substr($this->search,($posicion_camp ));
            }

            ///////BUSQUEDA FROM//////////////////////////////////////////////////////////////////////////////

            $busqueda_from= strpos($this->search, '&from=');

            if($busqueda_from != false){
                $posicion_from = $busqueda_from+ 6;
                $i_from = 0;
                $busq_from = 0;

                do{
                    $detect_from= substr($this->search, $posicion_from,1);
            
                    if($detect_from == '&') $i_from = 1;
                    else{
                        $posicion_from = $posicion_from + 1;
                        $busq_from ++;
                    }

                    if($busq_from > 300){
                        $i_from = 2;
                    }
            
                }while($i_from == 0 );

                if($i_from == 1) $from = substr($this->search,($busqueda_from + 6),($posicion_from - ($busqueda_from + 6)));
                else $from = substr($this->search,($posicion_from ));
            }

            ///////BUSQUEDA PROD//////////////////////////////////////////////////////////////////////////////

            $busqueda_prod= strpos($this->search, '&prod=');

            if($busqueda_prod != false){
                $posicion_prod = $busqueda_prod+ 6;
                $i_prod = 0;
                $busq_prod = 0;

                do{
                    $detect_prod= substr($this->search, $posicion_prod,1);
            
                    if($detect_prod == '&') $i_prod = 1;
                    else{
                        $posicion_prod = $posicion_prod + 1;
                        $busq_prod ++;
                    }

                    if($busq_prod > 300){
                        $i_prod = 2;
                    }
            
                }while($i_prod == 0 );

                if($i_prod == 1) $prod = substr($this->search,($busqueda_prod + 6),($posicion_prod - ($busqueda_prod + 6)));
                else $prod = substr($this->search,($posicion_prod ));
            }

            ///////BUSQUEDA SUB//////////////////////////////////////////////////////////////////////////////

            $busqueda_sub= strpos($this->search, '&sub1=');

            if($busqueda_sub != false){
                $posicion_sub = $busqueda_sub+ 6;
                $i_sub = 0;
                $busq_sub = 0;

                do{
                    $detect_sub= substr($this->search, $posicion_sub,1);
            
                    if($detect_sub == '&') $i_sub = 1;
                    else{
                        $posicion_sub = $posicion_sub + 1;
                        $busq_sub ++;
                    }

                    if($busq_sub > 300){
                        $i_sub = 2;
                    }
            
                }while($i_sub == 0 );

                if($i_sub == 1) $sub = substr($this->search,($busqueda_sub + 6),($posicion_sub - ($busqueda_sub + 6)));
                else $sub = substr($this->search,($posicion_sub ));
            }

             ///////BUSQUEDA PROD CHANNEL//////////////////////////////////////////////////////////////////////////////

            $busqueda_prod_ch= strpos($this->search, '&prod_channel=');

            if($busqueda_prod_ch != false){
                $posicion_prod_ch = $busqueda_prod_ch+ 14;
                $i_prod_ch = 0;
                $busq_prod_ch = 0;

                do{
                    $detect_prod_ch= substr($this->search, $posicion_prod_ch,1);
            
                    if($detect_prod_ch == '&') $i_prod_ch = 1;
                    else{
                        $posicion_prod_ch = $posicion_prod_ch + 1;
                        $busq_prod_ch ++;
                    }

                    if($busq_prod_ch > 300){
                        $i_prod_ch = 2;
                    }
            
                }while($i_prod_ch == 0 );

                if($i_prod_ch == 1) $prod_ch = substr($this->search,($busqueda_prod_ch + 14),($posicion_prod_ch - ($busqueda_prod_ch + 14)));
                else $prod_ch = substr($this->search,($posicion_prod_ch ));
            }

             ///////BUSQUEDA xt//////////////////////////////////////////////////////////////////////////////

            $busqueda_xt= strpos($this->search, '&xt=');

            if($busqueda_xt != false){
                $posicion_xt = $busqueda_xt+ 4;
               
                $xt = substr($this->search,($posicion_xt ));
            }

        try {

              $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://67.205.168.133/',
            ]);


            $resultado = $client->request('GET', 'Saltador_adscendmedia/1/'.$aff.'/'.$camp.'/'.$from.'/'.$prod.'/'.$sub.'/'.$prod_ch.'/'.$xt);

            if($resultado->getStatusCode() == 200){
                $this->jumper_complete = json_decode($resultado->getBody(),true);
            }


            else{

                $this->jumper_detect = 2;
            }


            if(!$this->jumper_complete)  $this->jumper_detect = 2;

            

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
        return view('livewire.jumpers.adscenmecia.saltador');
    }
}
