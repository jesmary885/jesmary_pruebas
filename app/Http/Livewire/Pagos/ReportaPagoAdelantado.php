<?php

namespace App\Http\Livewire\Pagos;

use App\Models\PagoRegistrosRecarga;
use App\Models\PaymentMethods;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\Tasa_dia;

use Livewire\WithFileUploads;

class ReportaPagoAdelantado extends Component
{
    use WithFileUploads;

    public $tasa_dia_dolar,$tasa_dia_ltc,$monto,$isopen,$type,$file,$comentario,$plan,$metodo_id,$payment_methods,$referencia,$fecha_pago;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'plan' => 'required',
        'metodo_id' => 'required',
        'referencia' => 'required|numeric',
        'fecha_pago' => 'required',
        'file' => 'required|image',
    ];

    protected $rules_con_balance = [
        'metodo_id' => 'required',
        'fecha_pago' => 'required',
    ];

    protected $rule_monto = [
        'monto' => 'required|numeric|min:5',
    ];

    public function open()
    {
        $this->isopen = true;  
        $this->emitTo('pagos.reporta-pago-adelantado','render');
    }
    public function close()
    {
        $this->isopen = false;  
        $this->emit('volver');
    }

    public function mount(){
        //$this->payment_methods = PaymentMethods::all();
        $this->tasa_dia_dolar = Tasa_dia::where('moneda','DOLAR')->first()->tasa;
        $this->tasa_dia_ltc = Tasa_dia::where('moneda','LTC')->first()->tasa;
    }

    public function render()
    {
        return view('livewire.pagos.reporta-pago-adelantado');
    }

    public function verific(){
        $user = User::where('id',Auth::id())->first();

        if($this->plan == "balance"){
            return $this->payment_methods = PaymentMethods::where('id','!=','1')->get();
        }

        else{
            if($user->balance>=10){
                return $this->payment_methods = PaymentMethods::all();
            }
            else{
                return $this->payment_methods = PaymentMethods::where('id','!=','1')->get();
            }
        }
    }

    public function save(){
        $date = Carbon::now();

        if($this->metodo_id == 1){
            $rules = $this->rules_con_balance;
            $this->validate($rules);
        }
        else{
            $rules = $this->rules;
            $this->validate($rules);
            
        }

            if($this->plan == "balance"){
                $rule_monto = $this->rule_monto;
                $this->validate($rule_monto);
            }

            $fecha_actual = date("Y-m-d h:s");
    
            $new_pago = new PagoRegistrosRecarga();
            $new_pago->user_id = Auth::id();
            $new_pago->nro_referencia = $this->referencia;
            $new_pago->fecha_pago = $this->fecha_pago;
            
            if($this->plan == "membresia")
            {
                $new_pago->type = 'Membresia';
                $new_pago->monto = '10';
                $new_pago->pago_basico = '1';
                $new_pago->pago_premium = '4';
                $new_pago->plan = '30';
            }
            else{
                $new_pago->plan = 'balance';
                $new_pago->type = 'Saldo en pagina';
                $new_pago->monto = $this->monto;
            }
            if($this->metodo_id != 1){
                $url = Storage::put('public/pagos_recargas', $this->file);
                $new_pago->file = $url;
                $new_pago->nro_referencia = $this->referencia;
            }
            $new_pago->status = 'pendiente';
            $new_pago->comentario = $this->comentario;
            $new_pago->payment_method_id = $this->metodo_id;
            $new_pago->save();
    
            $user = User::where('id',Auth::id())->first();
    
            $rol = $user->roles->first()->id;
    
            if($this->plan == "membresia"){
               // $proxima_fecha = date("Y-m-d h:s",strtotime($fecha_actual."+ 30 days"));
                $plan_nuevo = '30';
    
                $user->update([
                    'status' => 'activo',
                    //'last_payment_date' => $proxima_fecha,
                    'type' => $this->type,
                    'plan' => $plan_nuevo
                ]);
    
                /*if($date->toTimeString() <= '23:59:00' && $date->toTimeString() >= '06:00:00' ){
                    
                    if($this->type == 'premium'){
                        $user->roles()->sync(10);
                    }
                    else{
                        if($rol == '4') $user->roles()->sync(2);
                    }
                }*/
    
            }
            $this->emit('alert','Datos registrados correctamente');
            $this->reset(['plan','file','comentario','type']);
            $this->isopen = false;  

            //$msj = 'La activación automática no esta disponible por los momentos, espere que un administrador active su cuenta';
            return redirect()->route("home");
    
            //return redirect()->to('/home');
        
    }
}
