<?php

namespace App\Http\Livewire\Jumpers\SurveyDash;

use Livewire\Component;
use App\Models\Link;
use App\Models\Comments;

class SurveyDashCreate extends Component
{
     public $isopen = false, $panel, $jumper, $comentario;

    protected $rules_create = [
        'panel' => 'required|min:4',
        'jumper' => 'required',
    ];

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

        $user_auth =  auth()->user()->id;

        $link = new Link();
        $link->panel = $this->panel;
        $link->jumper = $this->jumper;
        $link->user_id = $user_auth;
        $link->jumper_type_id = 57;
        $link->save();
        
        if($this->comentario != ''){
            $comment = new Comments();
            $comment->comment = $this->comentario;
            $comment->link_id = $link->id;
            $comment->user_id = $user_auth;
            $comment->save();
        }

        $this->reset(['panel','isopen','jumper','comentario']);
        $this->emit('alert','Datos registrados correctamente');
        $this->emitTo('jumpers.survey-emi.survey-emi-index','render');
    }

    public function render()
    {
        return view('livewire.jumpers.survey-dash.survey-dash-create');
    }
}
