<?php

namespace App\Http\Livewire\Ssi;

use App\Models\CommentLinkSsi;
use App\Models\Linkssi;
use Livewire\Component;

class KCreate extends Component
{

 public $isopen = false,$psid,$k_type,$save = 0;

    protected $rules_create = [
        'k_type' => 'required',
        'psid' => 'required',
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

    public function save(){

     $rules_create = $this->rules_create;
        $this->validate($rules_create);

        //$this->posicion = 8; 

    $user_auth =  auth()->user()->id;
       

       $jumper = Linkssi::where('codigo',$this->psid)->first();

       if($jumper){
            $jumper->update([
                'codigo' => $this->psid,
                'user_id' => $user_auth,
                
            ]);
            //$this->save = 1;
       }
       else{
 
            $link = new Linkssi();
            $link->codigo = $this->psid;
            $link->user_id = $user_auth;

            $link->save();

            $comment = new CommentLinkSsi();
            $comment->comment = $this->comentario;
            $comment->link_id = $link->id;
            $comment->user_id = auth()->user()->id;
            $comment->save();
        }


        $this->reset(['k_type','isopen','psid']);
        $this->emit('alert','Datos registrados correctamente');
        $this->emitTo('ssi.listar','render');


    }


    public function render()
    {
        return view('livewire.ssi.k-create');
    }
}
