<?php

namespace App\Http\Livewire\Jumpers\Cint;

use App\Models\Comments;
use App\Models\Link;
use Livewire\Component;
use Livewire\WithPagination;

class Cint2JumperCom extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

   
    protected $listeners = ['render' => 'render'];

    public $isopen = false, $jumper,$comentario;


    public function comentar(){
        if($this->comentario != ''){
           
            $comment = new Comments();
            $comment->comment = $this->comentario;
            $comment->link_id = $this->jumper->id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            $this->reset(['comentario']);
        }

        $this->emitTo('jumpers.cint.cint2-jumper-com','render');
    }

    public function render()
    {

        $comments = Comments::where('link_id',$this->jumper->id)
                ->latest('id')
                ->paginate(5);

        return view('livewire.jumpers.cint.cint2-jumper-com',compact('comments'));
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

}
