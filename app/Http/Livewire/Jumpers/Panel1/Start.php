<?php

namespace App\Http\Livewire\Jumpers\Panel1;

use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class Start extends Component
{

      use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_detect = 0, $search;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'search' => 'required',
    ];
    
    public function mount(){


        if(session('search')) $this->search = session('search');
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

        $this->jumper_detect = 0;


         try {

            $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://146.190.74.228/',
            ]);


                    ///////BUSQUEDA E //////////////////////////////////////////////////////////////////////////////

            $busqueda_e= strpos($this->search, 'e=');

        
                $posicion_e = $busqueda_e + 2;
                $i_e = 0;
                $busq_e = 0;

                do{
                    $detect_e= substr($this->search, $posicion_e,1);
            
                    if($detect_e == '&') $i_e = 1;
                    else{
                        $posicion_e = $posicion_e + 1;
                        $busq_e ++;
                    }

                    if($busq_e > 300){
                        $i_e = 2;
                    }
            
                }while($i_e == 0 );

                if($i_e == 1) $e = substr($this->search,($busqueda_e + 2),($posicion_e - ($busqueda_e + 2)));
                else $e = substr($this->search,($posicion_e ));
            

        ///////BUSQUEDA P //////////////////////////////////////////////////////////////////////////////

       
            $busqueda_p= strpos($this->search, '&p=');
            $b_asper = 0;

            if($busqueda_p != false){
                $posicion_p = $busqueda_p + 3;
                $i_p = 0;
                $busq_p = 0;

                do{
                    $detect_p= substr($this->search, $posicion_p,1);
            
                    if($detect_p == '&') $i_p = 1;
                    else{
                        $posicion_p = $posicion_p + 1;
                        $busq_p ++;
                    }

                    if($busq_p > 300){
                        $i_p = 2;
                    }
            
                }while($i_p == 0 );

                if($i_p == 1) $p = substr($this->search,($busqueda_p + 3),($posicion_p - ($busqueda_p + 3)));
                else $p = substr($this->search,($posicion_p ));

                $busqueda_asper= strpos($p,'/');
                
                if($busqueda_asper != false) $b_asper = 1;
                else $b_asper = 0;
            }

          

            ///////BUSQUEDA C //////////////////////////////////////////////////////////////////////////////

            $busqueda_c= strpos($this->search, '&c=');

            if($busqueda_c != false){
                $posicion_c = $busqueda_c + 3;
                $i_c = 0;
                $busq_c = 0;

                do{
                    $detect_c= substr($this->search, $posicion_c,1);
            
                    if($detect_c == '&') $i_c = 1;
                    else{
                        $posicion_c = $posicion_c + 1;
                        $busq_c ++;
                    }

                    if($busq_c > 300){
                        $i_c = 2;
                    }
            
                }while($i_c == 0 );

                if($i_c == 1) $c = substr($this->search,($busqueda_c + 3),($posicion_c - ($busqueda_c + 3)));
                else $c = substr($this->search,($posicion_c ));
            }


             ///////BUSQUEDA U //////////////////////////////////////////////////////////////////////////////

            $busqueda_u= strpos($this->search, '&u=');

            if($busqueda_u != false){
                $posicion_u = $busqueda_u + 3;
                $i_u = 0;
                $busq_u = 0;

                do{
                    $detect_u= substr($this->search, $posicion_u,1);
            
                    if($detect_u == '&') $i_u = 1;
                    else{
                        $posicion_u = $posicion_u + 1;
                        $busq_u ++;
                    }

                    if($busq_u > 300){
                        $i_u = 2;
                    }
            
                }while($i_u == 0 );

                if($i_u == 1) $u = substr($this->search,($busqueda_u + 3),($posicion_u - ($busqueda_u + 3)));
                else $u = substr($this->search,($posicion_u ));
            }

         

            ///////BUSQUEDA S //////////////////////////////////////////////////////////////////////////////

            $busqueda_s= strpos($this->search, '&s=');

            if($busqueda_s != false){
                $posicion_s = $busqueda_s + 3;
                $i_s = 0;
                $busq_s = 0;

                do{
                    $detect_s= substr($this->search, $posicion_s,1);
            
                    if($detect_s == '&') $i_s = 1;
                    else{
                        $posicion_s = $posicion_s + 1;
                        $busq_s ++;
                    }

                    if($busq_s > 300){
                        $i_s = 2;
                    }
            
                }while($i_s == 0 );

                if($i_s == 1) $s = substr($this->search,($busqueda_s + 3),($posicion_s - ($busqueda_s + 3)));
                else $s = substr($this->search,($posicion_s ));
            }

          

             ///////BUSQUEDA L //////////////////////////////////////////////////////////////////////////////

            $busqueda_l= strpos($this->search, '&l=');

            if($busqueda_l != false){
                $posicion_l = $busqueda_l + 3;
                $i_l = 0;
                $busq_l = 0;

                do{
                    $detect_l= substr($this->search, $posicion_l,1);
            
                    if($detect_l == '&') $i_l = 1;
                    else{
                        $posicion_l = $posicion_l + 1;
                        $busq_l ++;
                    }


            
                }while($i_l == 0 );

                if($i_l == 1) $l = substr($this->search,($busqueda_l + 3),($posicion_l - ($busqueda_l + 3)));
                else $l = substr($this->search,($posicion_l ));
            }


            ///////BUSQUEDA R //////////////////////////////////////////////////////////////////////////////

            $busqueda_r= strpos($this->search, '&r=');

            if($busqueda_r != false){
                $posicion_r = $busqueda_r + 3;
                $i_r = 0;
                $busq_r = 0;

                do{
                    $detect_r= substr($this->search, $posicion_r,1);
            
                    if($detect_r == '&') $i_r = 1;
                    else{
                        $posicion_r = $posicion_r + 1;
                        $busq_r ++;
                    }

                    if($busq_r > 300){
                        $i_r = 2;
                    }
            
                }while($i_r == 0 );

                if($i_r == 1) $r = substr($this->search,($busqueda_r + 3),($posicion_r - ($busqueda_r + 3)));
                else $r = substr($this->search,($posicion_r ));
            }

             ///////BUSQUEDA T //////////////////////////////////////////////////////////////////////////////

            $busqueda_t= strpos($this->search, '&t=');

            if($busqueda_t != false){
                $posicion_t = $busqueda_t+ 3;
                $i_t = 0;
                $busq_t = 0;

                do{
                    $detect_t= substr($this->search, $posicion_t,1);
            
                    if($detect_t == '&') $i_t = 1;
                    else{
                        $posicion_t = $posicion_t + 1;
                        $busq_t ++;
                    }

                    if($busq_t > 300){
                        $i_t = 2;
                    }
            
                }while($i_t == 0 );

                if($i_t == 1) $t = substr($this->search,($busqueda_t + 3),($posicion_t - ($busqueda_t + 3)));
                else $t = substr($this->search,($posicion_t ));
            }

              ///////BUSQUEDA O //////////////////////////////////////////////////////////////////////////////

            $busqueda_o= strpos($this->search, '&o=');

            if($busqueda_o != false){
                $posicion_o = $busqueda_o + 3;
                $i_o = 0;
                $busq_o = 0;

                do{
                    $detect_o= substr($this->search, $posicion_o,1);
            
                    if($detect_o == '&') $i_o = 1;
                    else{
                        $posicion_o = $posicion_o + 1;
                        $busq_o ++;
                    }

                    if($busq_o > 300){
                        $i_o = 2;
                    }
            
                }while($i_o == 0 );

                if($i_o == 1) $o = substr($this->search,($busqueda_o + 3),($posicion_o - ($busqueda_o + 3)));
                else $o = substr($this->search,($posicion_o ));
            }

               ///////BUSQUEDA O //////////////////////////////////////////////////////////////////////////////

            $busqueda_prcr= strpos($this->search, '&prcr=');

            if($busqueda_prcr != false){
                $posicion_prcr = $busqueda_prcr + 6;
                $i_prcr = 0;
                $busq_prcr = 0;

                do{
                    $detect_prcr= substr($this->search, $posicion_prcr,1);
            
                    if($detect_prcr == '&') $i_prcr = 1;
                    else{
                        $posicion_prcr = $posicion_prcr + 1;
                        $busq_prcr ++;
                    }

                    if($busq_prcr > 300){
                        $i_prcr = 2;
                    }
            
                }while($i_prcr == 0 );

                if($i_prcr == 1) $prcr = substr($this->search,($busqueda_prcr + 6),($posicion_prcr - ($busqueda_prcr + 6)));
                else $prcr = substr($this->search,($posicion_prcr ));
            }

               ///////BUSQUEDA H //////////////////////////////////////////////////////////////////////////////

            $busqueda_h= strpos($this->search, '&h=');

            if($busqueda_h != false){

             $h = substr($this->search,($busqueda_h + 3 ));
            }


            if($b_asper == 0) $resultado = $client->request('GET', 'Startp/1/'.$e.'/'.$p.'/'.$c.'/'.$u.'/'.$s.'/'.$l.'/'.$r.'/'.$t.'/'.$o.'/'.$prcr.'/'.$h);
            else $resultado = $client->request('GET', 'Startg_post/1/'.$e.'/'.$p.'/'.$c.'/'.$u.'/'.$s.'/'.$l.'/'.$r.'/'.$t.'/'.$o.'/'.$prcr.'/'.$h);

            if($resultado->getStatusCode() == 200){

                $value = json_decode($resultado->getBody(),true);

                

                if (isset($value ['Encuesta'])) {

                    $this->jumper_complete = $value ['Encuesta'];

                } elseif (isset($value ['jumper'])) {

                    $this->jumper_complete = $value ['jumper'];
                }


                if(!$this->jumper_complete)  $this->jumper_detect = 2;
    
            }

            else{

                dd($resultado->getStatusCode() );

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
        return view('livewire.jumpers.panel1.start');
    }
}
