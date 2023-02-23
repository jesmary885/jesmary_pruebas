<?php

namespace App\Http\Livewire\Jumpers\Cint;

use Livewire\Component;

use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CintImport extends Component
{
    public $isopen = false;

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
        return view('livewire.jumpers.cint.cint-import');
    }


}
