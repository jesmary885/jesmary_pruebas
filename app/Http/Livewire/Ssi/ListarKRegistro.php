<?php

namespace App\Http\Livewire\Ssi;

use App\Models\CommentLinkSsi;
use App\Models\Linkssi;
use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class ListarKRegistro extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

     public  $comentario,$user,$jumper_complete = [],$jumper_detect = 0, $ip,$token,$ctx,$jumper_ctx = [],$search,$k_detect=0;

    protected $listeners = ['render' => 'render'];


    protected $rules = [
        // 'ip' => 'required',
        'token' => 'required',
    ];

    /*public function busqueda(){

        $this->k_detect = 0;


        if($this->search){

            $busqueda = Linkssi::where('codigo',$this->search)->first();

            if($busqueda) {
                $this->k_detect = $busqueda;

                $this->comments = CommentLinkSsi::where('link_id',$busqueda->id)
                        ->latest('id')
                        ->paginate(3);

            }
            else $this->k_detect = 0;

            
        }
    }*/

     public function comentar($k_detect){

        if($this->comentario != ''){

        $bus = Linkssi::where('codigo',$k_detect)->first();

        if($bus){

            $comment = new CommentLinkSsi();
            $comment->comment = $this->comentario;
            $comment->link_id = $bus->id;
            $comment->user_id = auth()->user()->id;
            $comment->save();


        }else{

            $link = new Linkssi();
            $link->codigo = $k_detect;
            $link->user_id = auth()->user()->id;

            $link->save();


            $comment = new CommentLinkSsi();
            $comment->comment = $this->comentario;
            $comment->link_id = $link->id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            


        }

        

            

            $this->reset(['comentario']);

    
            $this->emit('render', '.ssi.listar-k-registro');
        }
    }



    public function render()
    {

    $this->k_detect = 0;
    $comments =[];


        if($this->search){

            $busqueda = Linkssi::where('codigo',$this->search)->first();

            if($busqueda) {
                $this->k_detect = $busqueda;

                $comments = CommentLinkSsi::where('link_id',$busqueda->id)
                        ->latest('id')
                        ->paginate(10);

            }
            else {

            $this->k_detect = 0;
            $comments = [];
            


            } 

            
        }

        return view('livewire.ssi.listar-k-registro',compact('comments'));
    }
}
