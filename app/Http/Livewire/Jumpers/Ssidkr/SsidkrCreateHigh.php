<?php

namespace App\Http\Livewire\Jumpers\Ssidkr;

use App\Models\Link;
use Livewire\Component;

class SsidkrCreateHigh extends Component
{
    public $isopen = false, $psid, $high, $pid, $posicion, $save =0;

    protected $listeners = ['render' => 'render'];

    protected $rules_create = [
        'psid' => 'required|min:5',
        'high' => 'required|min:10',
        'pid' => 'required|min:9',
    ];

    public function mount(){
        if(session('pid')){
            $this->pid = session('pid');
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
        return view('livewire.jumpers.ssidkr.ssidkr-create-high');
    }

    public function save(){
        $rules_create = $this->rules_create;
        $this->validate($rules_create);

        $user_auth =  auth()->user()->id;
        $long_psid = strlen($this->psid);

        //$this->posicion = 8; 

       if($long_psid>5)$part_psid = substr($this->psid, 0, 5);
        else $part_psid = $this->psid;

        $jumper = Link::where('psid',$part_psid)->first();

       if($jumper){
            $jumper->update([
                'high' => $this->high,
                'pid' => $this->pid,
                'user_id' => $user_auth,
                'jumper_type_id' => 2,
            ]);
          //  $this->save = 1;
       }
       else{

            $link = new Link();
            $link->high = $this->high;
            $link->psid = $part_psid;
            $link->pid = $this->pid;
            $link->user_id = $user_auth;
            $link->jumper_type_id = 2;
           /* if($this->url){
                $link->jumper = $url_finish ;
            }*/
            $link->save();
           /* if($this->url){
                $this->url = trim($this->url);
                $url_detect_com= strpos($this->url, 'ttp');

                if($url_detect_com != false){
                    $i = 0;
                        
                    do{
                        $detect= substr($this->url, $this->posicion,1);

                        if($detect == '/') $i = 1;
                        else{
                            $i = 0;
                            $this->posicion = $this->posicion + 1;
                        }
                    }
                    while($i != 1);

                    $url_detect = 'https://'.substr($this->url,8,($this->posicion-8));

                    if($url_detect != 'dkr1.ssisurveys.com'){
                        $url_finish =  $url_detect;
                    }else{
                        $url_finish =  '';
                    }

                    $this->save = 1;
                }
                else{
                    $this->save = 0;
                    $this->emit('error','Su url no es correcta, verifiquela');
                    $this->emitTo('jumpers.ssidkr.ssidkr-create','render');
                }
            }
            else{
                $this->save = 1;
            }*/
        }

       // if($this->save == 1){

        $this->reset(['high','isopen','pid','psid']);
        $this->emit('alert','Datos registrados correctamente');
        $this->emitTo('jumpers.ssidkr.ssidkr-index','render');
        //}
    }
}
