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

    public $monto_pago,$user_page,$tasa_dia_dolar,$tasa_dia_ltc,$monto,$isopen,$type,$file,$comentario,$plan,$metodo_id,$payment_methods,$referencia,$fecha_pago;

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
        $this->user_page = User::where('id',Auth::id())->first();
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


        elseif($this->plan == "membresia basica" ){
            if($user->balance>=10){
                return $this->payment_methods = PaymentMethods::all();
            }
            else{
                return $this->payment_methods = PaymentMethods::where('id','!=','1')->get();
            }
        }

        elseif($this->plan == "membresia premium" ){
            if($user->balance>=15){
                return $this->payment_methods = PaymentMethods::all();
            }
            else{
                return $this->payment_methods = PaymentMethods::where('id','!=','1')->get();
            }
        }

        else{

            if($user->balance>=5){
                return $this->payment_methods = PaymentMethods::all();
            }
            else{
                return $this->payment_methods = PaymentMethods::where('id','!=','1')->get();
            }
        }
    }

    public function save(){

        $pago_registrado = PagoRegistrosRecarga::where('user_id',Auth::id())
        ->where('status','pendiente')
        ->count();

        if($pago_registrado == 0){

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
            //$new_pago->nro_referencia = $this->referencia;
            $new_pago->fecha_pago = $this->fecha_pago;
            
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
            elseif($this->plan == "balance"){
                $new_pago->plan = 'balance';
                $new_pago->type = 'Saldo en pagina';
                $new_pago->monto = $this->monto;
                $new_pago->status = 'pendiente';
                
            }
            elseif($this->plan == "membresia premium")
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
            else{
                if($this->metodo_id == 1) {
                    $new_pago->monto = '0';
                    $new_pago->status = 'verificado';
                }
                else{
                     $new_pago->monto = '5';
                     $new_pago->status = 'pendiente';
                }
                $new_pago->type = 'Pago_restante_premium';
                $new_pago->pago_basico = '0';
                $new_pago->pago_premium = '2';
                $new_pago->plan = '30';
            }
            if($this->metodo_id != 1){
                $url = Storage::put('public/pagos_recargas', $this->file);
                $new_pago->file = $url;
                $new_pago->nro_referencia = $this->referencia;
            }
            
            $new_pago->comentario = $this->comentario;
            $new_pago->payment_method_id = $this->metodo_id;
            $new_pago->save();
    
            $user = User::where('id',Auth::id())->first();
    
            $rol = $user->roles->first()->id;
    
            if($this->plan == "membresia basica" || $this->plan == "membresia premium" || $this->plan == "Pago_restante_premium"){
                $plan_nuevo = '30';

                if($this->metodo_id == 1) {
                    $proxima_fecha = date("Y-m-d h:s",strtotime($fecha_actual."+ 30 days"));

                    if($this->plan == "membresia basica"){
                        $this->monto_pago = '10';
                        $this->type = "basico";
                        $user->roles()->sync(2);

                        $balance_new = $user->balance - $this->monto_pago;

                        $user->update([
                            'status' => 'activo',
                            'last_payment_date' => $proxima_fecha,
                            'type' => $this->type,
                            'plan' => $plan_nuevo,
                            'balance' => $balance_new,
                        ]);
                    } 

                    if($this->plan == "membresia premium") {
                        $this->monto_pago = '15';
                        $this->type = "premium";
                        $user->roles()->sync(10);

                        $balance_new = $user->balance - $this->monto_pago;

                        $user->update([
                            'status' => 'activo',
                            'last_payment_date' => $proxima_fecha,
                            'type' => $this->type,
                            'plan' => $plan_nuevo,
                            'balance' => $balance_new,
                        ]);
                    }

                    if($this->plan == "Pago_restante_premium") {
                        $this->monto_pago = '5';
                        $this->type = "premium";

                        $balance_new = $user->balance - $this->monto_pago;

                        $user->update([
                            'balance' => $balance_new,
                        ]);
                    }
                }
                else{
                    
                    $user->update([
                        'status' => 'activo',
                        'type' => $this->type,
                        'plan' => $plan_nuevo
                    ]);

                }
    
            }
            $this->emit('alert','Datos registrados correctamente');
            $this->reset(['plan','file','comentario','type']);
            $this->isopen = false;  

            return redirect()->route("home");

        }

        else{

            $this->emit('error','Su operación no ha sido procesada, tiene un pago pendiente por verificar');
            $this->reset(['plan','file','comentario','type']);
            $this->isopen = false;  

            return redirect()->route("home");
        }
    }
}
