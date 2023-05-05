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

    public $monto_pago,$user_page,$tasa_dia_dolar,$tasa_dia_ltc,$msj_aviso,$type,$file,$isopen = false, $plan,$comentario,$metodo_id,$payment_methods,$referencia,$fecha_pago;

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
        
        $this->user_page = User::where('id',Auth::id())->first();

        if($this->user_page->type == 'premium') $this->plan = "membresia premium";
        else $this->plan = "membresia basica";

        

        $this->msj_aviso = 0;
        $this->tasa_dia_dolar = Tasa_dia::where('moneda','DOLAR')->first()->tasa;
        $this->tasa_dia_ltc = Tasa_dia::where('moneda','LTC')->first()->tasa;
    }

    public function verific(){
        $user = User::where('id',Auth::id())->first();

        if($this->plan == "membresia basica" ){
            if($user->balance>=10){
                return $this->payment_methods = PaymentMethods::all();
            }
            else{
                return $this->payment_methods = PaymentMethods::where('id','!=','1')->get();
            }
        }

        if($this->plan == "membresia premium" ){
            if($user->balance>=15){
                return $this->payment_methods = PaymentMethods::all();
            }
            else{
                return $this->payment_methods = PaymentMethods::where('id','!=','1')->get();
            }
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

        if($this->plan == "membresia basica")
        {
            $new_pago->type = 'basico';

            if($this->metodo_id == 1){
                $new_pago->monto = '0';
                $new_pago->status = 'verificado';
            }
            else{
                $new_pago->monto = '10';
                $new_pago->status = 'pendiente';
            }

            $new_pago->pago_basico = '1';
            $new_pago->pago_premium = '4';
            $new_pago->plan = '30';                
        }

        if($this->plan == "membresia premium")
        {
            $new_pago->type = 'premium';

            if($this->metodo_id == 1) {
                $new_pago->monto = '0';
                $new_pago->status = 'verificado';
            }
            else{
                $new_pago->monto = '15';
                $new_pago->status = 'pendiente';
            }

                $new_pago->pago_basico = '1';
                $new_pago->pago_premium = '6';
                $new_pago->plan = '30';                
            }
        $new_pago->fecha_pago = $this->fecha_pago;
        $new_pago->payment_method_id = $this->metodo_id;
        $new_pago->comentario = $this->comentario;
        $new_pago->save();

        $plan_nuevo = '30';

        if($this->metodo_id == 1) {
            $proxima_fecha = date("Y-m-d h:s",strtotime($fecha_actual."+ 30 days"));

            if($this->plan == "membresia basica"){
                $this->type = "basico";
                $this->monto_pago = '10';
                $user->roles()->sync(2);
            } 

            if($this->plan == "membresia premium") {
                $this->type = "premium";
                $this->monto_pago = '15';
                $user->roles()->sync(10);
            }

            $balance_new = $user->balance - $this->monto_pago;

            $user->update([
                'status' => 'activo',
                'last_payment_date' => $proxima_fecha,
                'type' => $this->type,
                'plan' => $plan_nuevo,
                'balance' => $balance_new,
            ]);

            return redirect()->route("home");

        }

        else{
            if($this->plan == "membresia basica"){
                $this->type = "basico";
            } 

            if($this->plan == "membresia premium") {
                $this->type = "premium";
            }

            $user->update([
                'status' => 'activo',
                'type' => $this->type,
                'plan' => $plan_nuevo
            ]);

            $msj = 'La activación automática no esta disponible por los momentos, espere que un administrador active su cuenta';
            return redirect()->route("home")->with('info', $msj);

        }


            $this->emit('alert','Datos registrados correctamente');
            $this->reset(['plan','file','comentario','type']);
            $this->isopen = false;  

           

    }
}
