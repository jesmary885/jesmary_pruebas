<?php

namespace App\Http\Livewire\Pagos;

use App\Models\PagoRegistrosRecarga;
use App\Models\PaymentMethods;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Tasa_dia;

use Livewire\Component;

class ReportePago extends Component
{
    use WithFileUploads;

    public $tasa_dia_dolar,$tasa_dia_ltc,$msj_aviso,$type,$file,$isopen = false, $plan,$comentario,$metodo_id,$payment_methods,$referencia,$fecha_pago;

    protected $rules = [
        'metodo_id' => 'required',
        'referencia' => 'required|numeric',
        'fecha_pago' => 'required',
        'file' => 'required|image',
    ];

    protected $rules_con_balance = [
        'metodo_id' => 'required',
        'fecha_pago' => 'required',
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
        //$this->payment_methods = PaymentMethods::all();
        $this->msj_aviso = 0;
        $this->tasa_dia_dolar = Tasa_dia::where('moneda','DOLAR')->first()->tasa;
        $this->tasa_dia_ltc = Tasa_dia::where('moneda','LTC')->first()->tasa;
    }

    public function verific(){
        $user = User::where('id',Auth::id())->first();

        if($user->balance>=10){
            return $this->payment_methods = PaymentMethods::all();
        }
        else{
            return $this->payment_methods = PaymentMethods::where('id','!=','1')->get();
        }
    }

    public function render()
    {
        return view('livewire.pagos.reporte-pago');
    }

    public function save(){

        if($this->metodo_id == 1){
            $rules = $this->rules_con_balance;
            $this->validate($rules);
        }
        else{
            $rules = $this->rules;
            $this->validate($rules);
            
        }

        $fecha_actual = date("Y-m-d h:s");
        $date = Carbon::now();

        $user = User::where('id',Auth::id())->first();
        $rol = $user->roles->first()->id;
        

        $new_pago = new PagoRegistrosRecarga();
        $new_pago->user_id = Auth::id();
        if($this->metodo_id != 1){
            $url = Storage::put('public/pagos_recargas', $this->file);
            $new_pago->file = $url;
            $new_pago->nro_referencia = $this->referencia;
        }
        
        $new_pago->plan = '30';
        $new_pago->status = 'pendiente';
        $new_pago->fecha_pago = $this->fecha_pago;
        $new_pago->payment_method_id = $this->metodo_id;
        $new_pago->comentario = $this->comentario;
        $new_pago->type = 'Membresia';
        $new_pago->monto = '10';
        $new_pago->pago_basico = '1';
        $new_pago->pago_premium = '4';
        $new_pago->save();

        //$proxima_fecha = date("Y-m-d h:s",strtotime($fecha_actual."+ 30 days"));
        $plan_nuevo = '30';
        
        $user->update([
            'status' => 'activo',
            //'last_payment_date' => $proxima_fecha,
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

            $msj = 'La activación automática no esta disponible por los momentos, espere que un administrador active su cuenta';
            return redirect()->route("home")->with('info', $msj);


            $this->emit('alert','Datos registrados correctamente');
            $this->reset(['plan','file','comentario','type']);
            $this->isopen = false;  

            //eturn redirect()->to('/home');
        
    }
}
