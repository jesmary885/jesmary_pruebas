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

    public $msj_aviso,$type,$file,$isopen = false, $plan,$comentario,$metodo_id,$payment_methods,$referencia,$fecha_pago;

    protected $rules = [
        'plan' => 'required',
        'metodo_id' => 'required',
        'referencia' => 'required|numeric',
        'fecha_pago' => 'required',
        'file' => 'required',
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
        $this->msj_aviso = 0;
    }

    public function render()
    {
        return view('livewire.pagos.reporte-pago');
    }

    public function save(){

        $rules = $this->rules;
        $this->validate($rules);

        if($this->type == 'basico' && $this->plan == '15'){
            return redirect()->to('/home');
        }


        else{
            $fecha_actual = date("Y-m-d h:s");
            $date = Carbon::now();

            $user = User::where('id',Auth::id())->first();
            $rol = $user->roles->first()->id;

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
                $new_pago->monto = '6';
                $new_pago->pago_basico = '1';
            } 
            if($this->type == 'premium' && $this->plan == '15'){
                $new_pago->monto = '16';
                $new_pago->pago_premium = '5';
                $new_pago->pago_basico = '0.5';
            } 
            if($this->type == 'premium' && $this->plan == '30'){
                $new_pago->monto = '30';
                $new_pago->pago_premium = '10';
                $new_pago->pago_basico = '1';
            } 
            $new_pago->save();

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

           /* if($date->toTimeString() <= '21:05:00' && $date->toTimeString() >= '06:00:00' ){
                if($this->type == 'premium'){
                    $user->roles()->sync(10);
                }
                else{
                    if($rol == '4') $user->roles()->sync(2);

                }
            }

            else{*/

                $msj = 'La activación automática esta programada entre 6:00 am y 9:00 pm hora Venezuela, espere que un administrador active su cuenta';
                return redirect()->route("home")->with('info', $msj);

               
            //}

            $this->emit('alert','Datos registrados correctamente');
            $this->reset(['plan','file','comentario','type']);
            $this->isopen = false;  

           // $this->emitTo('admin.pagos-pendientes','render');

            return redirect()->to('/home');
        }
    }
}
