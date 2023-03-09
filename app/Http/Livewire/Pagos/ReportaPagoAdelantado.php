<?php

namespace App\Http\Livewire\Pagos;

use App\Models\PagoRegistrosRecarga;
use App\Models\PaymentMethods;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Livewire\WithFileUploads;

class ReportaPagoAdelantado extends Component
{
    use WithFileUploads;

    public $monto,$isopen,$type,$file,$comentario,$plan,$metodo_id,$payment_methods,$referencia,$fecha_pago;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'plan' => 'required',
        'metodo_id' => 'required',
        'referencia' => 'required|numeric',
        'fecha_pago' => 'required',
        'file' => 'required|image|max:2048'
    ];

    protected $rule_monto = [
        'monto' => 'required|numeric',
    ];

    public function open()
    {
        $this->isopen = true;  
        $this->emitTo('pid.register','render');
    }
    public function close()
    {
        $this->isopen = false;  
        $this->emit('volver');
    }

    public function mount(){
        $this->payment_methods = PaymentMethods::all();
    }

    public function render()
    {
        return view('livewire.pagos.reporta-pago-adelantado');
    }

    public function save(){

        $rules = $this->rules;
        $this->validate($rules);

        if($this->plan == "balance"){
            $rule_monto = $this->rule_monto;
            $this->validate($rule_monto);
        }

        $fecha_actual = date("Y-m-d h:s");

        $new_pago = new PagoRegistrosRecarga();
        $new_pago->user_id = Auth::id();
        $new_pago->file = $this->file->store('pagos_recargas');
        $new_pago->plan = $this->plan;
        $new_pago->nro_referencia = $this->referencia;
        $new_pago->fecha_pago = $this->fecha_pago;
        if($this->plan == "balance"){
            $new_pago->monto = $this->monto;
        }
        $new_pago->status = 'pendiente';
        $new_pago->comentario = $this->comentario;
        $new_pago->payment_method_id = $this->metodo_id;
        $new_pago->save();

        $user = User::where('id',Auth::id())->first();

        $rol = $user->roles->first()->id;

        if($this->plan == 7 || $this->plan == 15 || $this->plan == 30){
            if($this->plan == '7') $proxima_fecha = date("Y-m-d h:s",strtotime($fecha_actual."+ 7 days"));
            elseif($this->plan == '15') $proxima_fecha = date("Y-m-d h:s",strtotime($fecha_actual."+ 15 days"));
            else $proxima_fecha = date("Y-m-d h:s",strtotime($fecha_actual."+ 30 days"));

            $user->update([
                'status' => 'activo',
                'last_payment_date' => $proxima_fecha,
            ]);

            if($rol == '4') $user->roles()->sync(2);

        }

        $this->emit('alert','Datos registrados correctamente');
        $this->reset(['plan','file','comentario']);
        $this->isopen = false;  

        $this->emit('volver');
    }
}
