<?php

namespace App\Http\Livewire\Jumpers\Ssidkr;

use App\Models\Link;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class SsidkrCreate extends Component
{
    public $isopen = false,$psid,$basic,$url;

    protected $rules_create = [
        'psid' => 'required|min:5',
        'basic' => 'required|min:5',
    ];

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
       }
       else{
        if($this->url){
            $url_detect_com= strpos($this->url, '.com');
            $url_detect = substr($this->url,8,($url_detect_com-8)).'.com';

            if($url_detect_com)$url_detect = substr($this->url,8,($url_detect_com-8)).'.com';
            else $url_detect = 'error';

            if($url_detect != 'dkr1.ssisurveys.com' && $url_detect != 'error'){
                $url_finish =  $url_detect;
            }else{
                $url_finish =  '';
            }
    
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
       }

        $this->reset(['basic','isopen','psid']);
        $this->emit('alert','Datos registrados correctamente');
        $this->emitTo('jumpers.ssidkr.ssidkr-index','render');
    }
}
