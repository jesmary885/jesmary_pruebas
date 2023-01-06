<?php

namespace App\Http\Livewire\Jumpers;

use App\Models\Link;
use App\Models\User_Links_Points;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public function updatingSearch(){
        $this->resetPage();
    }

    public $isopen = false,$jumper;

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function mount(Link $jumper){
        $this->jumper = $jumper;
    }

    public function calificacion($calificacion){
        if($calificacion == 'positive'){
            return "font-semibold far fa-thumbs-up py-2 px-3 text-md font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800";

        }
        else{

            return "font-semibold far fa-thumbs-down py-2 px-3 text-md font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800";

        }

    }
    
    public function render()
    {
        $califics = User_Links_Points::where('link_id',$this->jumper->id)
            ->latest('id')
            ->paginate(15);

        return view('livewire.jumpers.history',compact('califics'));
    }
}
