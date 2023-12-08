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

    public $monto_pago,$user_page,$tasa_dia_dolar,$tasa_dia_ltc,$msj_aviso,$type,$file,$isopen = false, $plan,$comentario,$metodo_id,$payment_methods,$nro_referencia,$fecha_pago;

    protected $rules = [
        'metodo_id' => 'required',
        'nro_referencia' => 'required|numeric|unique:pago_registros_recargas|min_digits:6',
        'plan' => 'required',
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

      /*  if($this->user_page->type == 'premium'){

            $this->plan = "membresia premium 30";

        } 
        else $this->plan = "membresia basica";*/

        

        $this->msj_aviso = 0;
        $this->tasa_dia_dolar = Tasa_dia::where('moneda','DOLAR')->first()->tasa;
        $this->tasa_dia_ltc = Tasa_dia::where('moneda','LTC')->first()->tasa;
    }

    public function verific(){
        $user = User::where('id',Auth::id())->first();

        if($this->plan == "membresia premium_30" ){
            if($user->balance>=25){
                return $this->payment_methods = PaymentMethods::all();
            }
            else{
                return $this->payment_methods = PaymentMethods::where('id','!=','1')->get();
            }
        }
        elseif($this->plan == "membresia premium_10" ){
            if($user->balance>=10){
                return $this->payment_methods = PaymentMethods::all();
            }
            else{
                return $this->payment_methods = PaymentMethods::where('id','!=','1')->get();
            }
        }
        elseif($this->plan == "membresia premium_2" ){
            if($user->balance>=3){
                return $this->payment_methods = PaymentMethods::all();
            }
            else{
                return $this->payment_methods = PaymentMethods::where('id','!=','1')->get();
            }
        }

        else{
            if($user->balance>=6){
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

        $pasa = 1;

        if($this->plan == "membresia premium_30"){
            if(auth()->user()->type != 'premium 30'){
                $this->emit('error','No estas autorizado para realizar un pago para el plan "PREMIUM 30 DÍAS"');
                $this->isopen = false;  
                $pasa = 0;
            }
            else{
                $users_plan_30_premium = User::where('status','activo')
                ->where('plan','10')
                ->where('type','premium 30')
                ->permission('menu.premium')
                ->count();

                if($users_plan_30_premium >= 85){
                    $this->emit('error','Su operación no ha sido procesada, en estos momentos no hay cupos disponibles para este plan');
                    $this->isopen = false;  
                    $pasa = 0;
                }
                else $pasa = 1;

            }
        }

        if($this->plan == "membresia premium_10"){

            if(auth()->user()->type != 'premium 10'){
                $this->emit('error','No estas autorizado para realizar un pago para el plan "PREMIUM 10 DÍAS"');
                $this->isopen = false;  
                $pasa = 0;
            }

            else{

                $users_plan_10_premium = User::where('status','activo')
                ->where('plan','10')
                ->where('type','premium 10')
                ->permission('menu.premium')
                ->count();

                if($users_plan_10_premium >= 65){
                    $this->emit('error','Su operación no ha sido procesada, en estos momentos no hay cupos disponibles para este plan');
                    $this->isopen = false;  
                    $pasa = 0;
                }
                else $pasa = 1;
            }
        }

        if($this->plan == "membresia premium_2"){

            if(auth()->user()->type != 'premium 2'){
                $this->emit('error','No estas autorizado para realizar un pago para el plan "PREMIUM 2 DÍAS"');
                $this->isopen = false;  
                $pasa = 0;
            }

            else{
                $users_plan_2_premium = User::where('status','activo')
                ->where('plan','2')
                ->where('type','premium 2')
                ->permission('menu.premium')
                ->count();

                if($users_plan_2_premium >= 50){
                    $this->emit('error','Su operación no ha sido procesada, en estos momentos no hay cupos disponibles para este plan');
                    $this->isopen = false; 
                    $pasa = 0; 
                }
                else $pasa = 1;
            }

        }

        if($pasa == 1){
            $fecha_actual = date("Y-m-d h:s");
            $date = Carbon::now();

            $user = User::where('id',Auth::id())->first();
            $rol = $user->roles->first()->id;
            

            $new_pago = new PagoRegistrosRecarga();
            $new_pago->user_id = Auth::id();
            if($this->metodo_id != 1){
                $url = Storage::put('public/pagos_recargas', $this->file);
                $new_pago->file = $url;
                $new_pago->nro_referencia = $this->nro_referencia;
            }

            if($this->plan == "membresia basica"){
                $new_pago->type = 'basico';

                if($this->metodo_id == 1){
                    $new_pago->monto = '0';
                    $new_pago->status = 'verificado';
                    $new_pago->pago_basico = '0';
                    $new_pago->pago_premium = '0';
                }
                else{
                    $new_pago->monto = '6';
                    $new_pago->status = 'pendiente';
                    $new_pago->pago_basico = '1';
                    $new_pago->pago_premium = '2.4';
                }

                
                $new_pago->plan = '30';                
            }

            elseif($this->plan == "membresia premium_30"){
                $new_pago->type = 'premium 30 dias';

                if($this->metodo_id == 1) {
                    $new_pago->monto = '0';
                    $new_pago->status = 'verificado';
                    $new_pago->pago_basico = '0';
                    $new_pago->pago_premium = '0';
                }
                else{
                    $new_pago->monto = '25';
                    $new_pago->status = 'pendiente';
                    $new_pago->pago_basico = '1';
                    $new_pago->pago_premium = '10';
                }

                    
                    $new_pago->plan = '30';                
            }

            elseif($this->plan == "membresia premium_10"){
                $new_pago->type = 'premium 10 dias';

                if($this->metodo_id == 1) {
                    $new_pago->monto = '0';
                    $new_pago->status = 'verificado';
                    $new_pago->pago_basico = '0';
                    $new_pago->pago_premium = '0';
                }
                else{
                    $new_pago->monto = '10';
                    $new_pago->status = 'pendiente';
                    $new_pago->pago_basico = '0';
                    $new_pago->pago_premium = '4';
                }

                    
                    $new_pago->plan = '10';                
            }

            elseif($this->plan == "membresia premium_2"){
                $new_pago->type = 'premium 2 dias';

                if($this->metodo_id == 1) {
                    $new_pago->monto = '0';
                    $new_pago->status = 'verificado';
                    $new_pago->pago_basico = '0';
                    $new_pago->pago_premium = '0';
                }
                else{
                    $new_pago->monto = '3';
                    $new_pago->status = 'pendiente';
                    $new_pago->pago_basico = '0';
                    $new_pago->pago_premium = '1.2';
                }
                    $new_pago->plan = '2';                
            }
            else{
                if($this->metodo_id == 1) {
                    $new_pago->monto = '0';
                    $new_pago->status = 'verificado';
                    $new_pago->pago_basico = '0';
                    $new_pago->pago_premium = '0';
                }
                else{
                    $new_pago->monto = '5';
                    $new_pago->status = 'pendiente';
                    $new_pago->pago_basico = '0';
                    $new_pago->pago_premium = '2';
                }
                $new_pago->type = 'Pago_restante_premium';
                
                $new_pago->plan = '30';
            }

                $new_pago->fecha_pago = $this->fecha_pago;
                $new_pago->payment_method_id = $this->metodo_id;
                $new_pago->comentario = $this->comentario;
                $new_pago->save();

            if($this->metodo_id == 1) {

                    if($this->plan == "Pago_restante_premium") {
                        $this->monto_pago = '5';
                        $this->type = "premium 30";
                        $plan_nuevo = '30';

                        $balance_new = $user->balance - $this->monto_pago;

                        $user->update([
                            'balance' => $balance_new,
                        ]);
                    }

                    else{
                        if($this->plan == "membresia basica"){
                            $proxima_fecha = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 30 days"));
                            $plan_nuevo = '30';
                            $this->type = "basico";
                            $this->monto_pago = '6';
                            $user->roles()->sync(2);
                        } 

                        if($this->plan == "membresia premium_30") {
                            $proxima_fecha = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 30 days"));
                            $plan_nuevo = '30';
                            $this->type = "premium 30";
                            $this->monto_pago = '25';
                            $user->roles()->sync(10);
                        }

                        if($this->plan == "membresia premium_10") {
                            $proxima_fecha = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 10 days"));
                            $plan_nuevo = '10';
                            $this->type = "premium 10";
                            $this->monto_pago = '10';
                            $user->roles()->sync(10);
                        }


                        if($this->plan == "membresia premium_2") {
                            $proxima_fecha = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 2 days"));
                            $plan_nuevo = '2';
                            $this->type = "premium 2";
                            $this->monto_pago = '3';
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
                    }

                    return redirect()->route("home");
                }

            else{
                if($this->plan == "membresia premium_30"){
                    $plan_nuevo = '30';
                    $this->type = "premium 30";
                } 
                elseif($this->plan == "membresia premium_10"){
                    $plan_nuevo = '10';
                    $this->type = "premium 10";
                } 
                elseif($this->plan == "membresia premium_2"){
                    $plan_nuevo = '2';
                    $this->type = "premium 2";
                } 
                elseif($this->plan == "Pago_restante_premium") {
                    $plan_nuevo = '30';
                    $this->type = "premium 30";
                }
                else {
                    $this->type = "basico";
                    $plan_nuevo = '30';
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
                $this->reset(['plan','file','comentario','type','nro_referencia']);
                $this->isopen = false;  

        }
    }
}
