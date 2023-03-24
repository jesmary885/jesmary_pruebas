<?php

namespace App\Http\Livewire\Pagos;

use App\Models\PagoRegistrosRecarga;
use App\Models\PaymentMethods;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

use Livewire\Component;

class ReportePago extends Component
{
    use WithFileUploads;

    public $type,$file,$isopen = false, $plan,$comentario,$metodo_id,$payment_methods,$referencia,$fecha_pago;

    protected $rules = [
        'plan' => 'required',
        'metodo_id' => 'required',
        'referencia' => 'required|numeric',
        'fecha_pago' => 'required',
        'file' => 'required|image|max:2048',
        'type' => 'required'
    ];

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function mount(){
        $this->payment_methods = PaymentMethods::all();
    }

    public function render()
    {
        return view('livewire.pagos.reporte-pago');
    }

    public function save(){

        $rules = $this->rules;
        $this->validate($rules);

        $fecha_actual = date("Y-m-d h:s");
        $date = Carbon::now();

        $new_pago = new PagoRegistrosRecarga();
        $new_pago->user_id = Auth::id();
        $new_pago->file = $this->file->store('pagos_recargas');
        $new_pago->plan = $this->plan;
        $new_pago->status = 'pendiente';
        $new_pago->nro_referencia = $this->referencia;
        $new_pago->fecha_pago = $this->fecha_pago;
        $new_pago->payment_method_id = $this->metodo_id;
        $new_pago->comentario = $this->comentario;
        $new_pago->type = $this->type;
        if($this->type == 'basico' && $this->plan == '30'){
            $new_pago->monto = '5';
            $new_pago->pago_basico = '1';
        } 
        if($this->type == 'basico' && $this->plan == '15'){
            $new_pago->monto = '3';
            $new_pago->pago_basico = '0.5';
        } 
        $new_pago->save();

        $user = User::where('id',Auth::id())->first();

        $rol = $user->roles->first()->id;

        if($this->plan == '15'){
            $proxima_fecha = date("Y-m-d h:s",strtotime($fecha_actual."+ 15 days"));
            $plan_nuevo = '15';
        } 
        else{
            $proxima_fecha = date("Y-m-d h:s",strtotime($fecha_actual."+ 30 days"));
            $plan_nuevo = '30';
        } 

        $user->update([
            'status' => 'activo',
            'last_payment_date' => $proxima_fecha,
            'type' => $this->type,
            'plan' => $plan_nuevo
        ]);

        if($date->toTimeString() <= '21:00:00' && $date->toTimeString() >= '06:00:00' ){
            if($rol == '4') $user->roles()->sync(2);
        }

        $this->emit('alert','Datos registrados correctamente');
        $this->reset(['plan','file','comentario','type']);
        $this->isopen = false;  

        $this->emitTo('admin.pagos-pendientes','render');

        return redirect()->to('/home');
    }
}
