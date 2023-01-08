<?php

namespace App\Http\Livewire\Jumpers\Ssidkr;

use App\Models\Link;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class SsidkrCreate extends Component
{
    public $isopen = false,$psid,$basic,$url,$posicion,$save = 0;

    protected $rules_create = [
        'psid' => 'required|min:5',
        'basic' => 'required|min:5',
    ];

    protected $listeners = ['render' => 'render'];

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
        
        return view('livewire.jumpers.ssidkr.ssidkr-create');
    }

    public function save(){
        $rules_create = $this->rules_create;
        $this->validate($rules_create);

        $this->posicion = 8; 

        $user_auth =  auth()->user()->id;
        $long_psid = strlen($this->psid);

       if($long_psid>5)$part_psid = substr($this->psid, 0, 5);
        else $part_psid = $this->psid;

       //$jumper = 'http://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$part_psid;

       $jumper = Link::where('psid',$part_psid)->first();

       if($jumper){
            $jumper->update([
                'basic' => $this->basic,
                'user_id' => $user_auth,
                'jumper_type_id' => 1,
            ]);
            $this->save = 1;
       }
       else{
            if($this->url){
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

                    $link = new Link();
                    $link->basic = $this->basic;
                    $link->psid = $part_psid;
                // $link->jumper = $jumper;
                    $link->user_id = $user_auth;
                    $link->jumper_type_id = 1;
                    if($this->url){
                    $link->jumper = $url_finish ;
                    }
                    $link->save();

                    $this->save = 1;
                }
                else{
                    $this->save = 0;
                    $this->emit('error','Su url no es correcta, verifiquela');
                    $this->emitTo('jumpers.ssidkr.ssidkr-create','render');
                }
            }
        }
       if($this->save == 1){
            $this->reset(['basic','isopen','psid','url']);
            $this->emit('alert','Datos registrados correctamente');
            $this->emitTo('jumpers.ssidkr.ssidkr-index','render');
       }
    }
}
