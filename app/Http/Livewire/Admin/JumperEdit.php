<?php

namespace App\Http\Livewire\Admin;

use App\Models\JumperType;
use App\Models\Link;
use Livewire\Component;

class JumperEdit extends Component
{
    public $isopen = false;
    public $psid, $basic, $high, $pid, $jumper, $type_id, $types, $k_detect, $dominio;

    protected $rules = [
        'type_id' => 'required',
    ];

    public function mount(Link $jumper){
        $this->jumper = $jumper;
        $this->psid = $this->jumper->psid;
        $this->high = $this->jumper->high;
        $this->basic = $this->jumper->basic;
        $this->dominio = $this->jumper->jumper;
        $this->type_id = $this->jumper->jumper_type_id;
        $this->k_detect = $this->jumper->k_detected;
        $this->types=JumperType::all();
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
        return view('livewire.admin.jumper-edit');
    }

    public function update(){

        $rules = $this->rules;
        $this->validate($rules);
      
        $this->jumper->update([
            'psid' => $this->psid,
            'high' => $this->high,
            'basic' => $this->basic,
            'jumper' => $this->dominio,
            'jumper_type_id' => $this->type_id,
            'k_detect' => $this->k_detected,
        ]);
  
        $this->reset(['isopen']);
        $this->emitTo('admin.jumper-index','render');
        $this->emit('alert','Datos modificados correctamente');
    }
}
