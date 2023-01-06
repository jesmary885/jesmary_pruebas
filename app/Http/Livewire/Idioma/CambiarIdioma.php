<?php

namespace App\Http\Livewire\Idioma;

use App\Models\Idioma;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class CambiarIdioma extends Component
{
    public $idiomas, $idioma_new, $idioma_id;
    public $isopen = false;

    protected $listeners = ['render'];

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function mount(){
         if (session()->has('locale')){
            $idioma_actual = session('locale');
            if($idioma_actual == 'Español') $idioma_actual_a = "Español";
            if($idioma_actual == 'en') $idioma_actual_a = "English";
            if($idioma_actual == 'es') $idioma_actual_a = "Español";
         } 
         else{
            $idioma_actual_a = "Español";
         }

         $this->idioma_id = Idioma::where('name',$idioma_actual_a)->first()->id;
         
         $this->idiomas=Idioma::where('id', '!=', $this->idioma_id)->get();
     }

    public function render()
    {
        return view('livewire.idioma.cambiar-idioma');
    }

    public function cambiar_idioma($idioma_select){
        $this->idioma_new = Idioma::where('id',$idioma_select)
        ->first();

        if($this->idioma_new->name == 'Español') $idio_new = 'es';
        else $idio_new = 'en';

        session(['locale' => $idio_new]);

        App::setLocale($idio_new);

        return redirect(request()->header('Referer'));
    }
}
