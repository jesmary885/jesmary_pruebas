<?php

namespace App\Http\Livewire\Admin;

use App\Models\Comments;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ComentariosIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render','confirmacion' => 'confirmacion'];

    public $search, $comentario,$buscador;

    public function mount(){
        $this->buscador = 1;
    }

    public function render()
    {

        if($this->buscador == 1){

            $comentarios = Comments::whereHas('user',function(Builder $query){
                $query->where('username','LIKE', '%' . $this->search . '%');
            })
            ->latest('id')
            ->paginate(20);
        }
        
        else{

            $comentarios = Comments::whereHas('link',function(Builder $query){
                $query->where('psid','LIKE', '%' . $this->search . '%');
            })
            ->paginate(20);
        }
     

        return view('livewire.admin.comentarios-index',compact('comentarios'));
    }

    public function delete($comentarioId){

        $this->comentario = $comentarioId;
        $this->emit('confirm', 'Esta seguro de eliminar este comentario?','admin.comentarios-index','confirmacion','El comentario se ha eliminado.');
    
    }

    public function confirmacion(){
       
        $comentario_destroy = Comments::where('id',$this->comentario)->first();
        $comentario_destroy->delete();

    }
}
