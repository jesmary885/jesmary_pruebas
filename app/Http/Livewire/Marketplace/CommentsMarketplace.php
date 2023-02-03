<?php

namespace App\Http\Livewire\Marketplace;

use App\Models\CommentUser;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CommentsMarketplace extends Component
{
    
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $tipo,$points_positive,$points_negative;

    public function updatingSearch(){
        $this->resetPage();
    }

    public $isopen = false,$user;

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function mount(User $user,$tipo){
        $this->user = $user;
        $this->tipo = $tipo;

        if($this->tipo == 'Vendedor'){
            $this->points_negative = CommentUser::where('user_id',$this->user->id)
            ->where('posicion','Vendedor')
            ->where('categoria_comentario','negativo')
            ->count();

            $this->points_positive = CommentUser::where('user_id',$this->user->id)
            ->where('posicion','Vendedor')
            ->where('categoria_comentario','positivo')
            ->count();
        }
        else{
            $this->points_negative = CommentUser::where('user_id',$this->user->id)
            ->where('posicion','Comprador')
            ->where('categoria_comentario','negativo')
            ->count();

            $this->points_positive = CommentUser::where('user_id',$this->user->id)
            ->where('posicion','Comprador')
            ->where('categoria_comentario','positivo')
            ->count();
        }

    }


    public function render()
    {

        if($this->tipo == 'Vendedor'){
            $califics = CommentUser::where('user_id',$this->user->id)
            ->where('posicion','Vendedor')
            ->latest('id')
            ->paginate(5);
        }
        else{
            $califics = CommentUser::where('user_id',$this->user->id)
            ->where('posicion','Comprador')
            ->latest('id')
            ->paginate(5);
        }

        return view('livewire.marketplace.comments-marketplace',compact('califics'));
    }
}
