<?php

namespace App\Http\Livewire\Pagos;

use App\Models\PagoRegistrosRecarga;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

use Livewire\Component;

class ReportePago extends Component
{
    use WithFileUploads;

    public $file,$isopen = false, $plan= false,$comentario;

    protected $rules = [
        'plan' => 'required',
        'file' => 'required'
    ];

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
        return view('livewire.pagos.reporte-pago');
    }

    public function save(){

        $rules = $this->rules;
        $this->validate($rules);

        $new_pago = new PagoRegistrosRecarga();
        $new_pago->user_id = Auth::id();
        $new_pago->file = $this->file->store('pagos_recargas');
        $new_pago->plan = $this->plan;
        $new_pago->comentario = $this->comentario;
        $new_pago->save();

        $user = User::where('id',Auth::id())->first();

        $user->update([
            'status' => 'activo',
            'last_payment_date' => date("Y-m-d H:i"),
        ]);

        $user->roles()->sync(2);

        $this->emit('alert','Datos registrados correctamente');
        $this->isopen = false;  

        return redirect()->to('/home');
        

    }
}
