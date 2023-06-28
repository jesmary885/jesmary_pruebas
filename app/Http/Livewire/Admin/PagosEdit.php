<?php

namespace App\Http\Livewire\Admin;

use App\Models\PagoRegistrosRecarga;
use App\Models\User;
use Livewire\Component;

class PagosEdit extends Component
{

    public $isopen = false;
    public $registro,$admin_verifi_id,$status,$users_admin,$type_confirmed;

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    protected $rules = [
        'status' => 'required',
        'admin_verifi_id' => 'required'
    ];

    protected $rule_pago_recibido = [
        'type_confirmed' => 'required',
    ];

    public function mount(PagoRegistrosRecarga $registro){
        $this->registro = $registro;

        if($registro->status == 'verificado'){
            $this->status = 1;
            $this->admin_verifi_id = $registro->admin_second_id;
        }

        $this->users_admin = User::whereHas("roles", function($q){ $q->where("name", "Administrador"); })
        ->where('id','!=',auth()->id())
        ->get();

    }

    public function render()
    {
        return view('livewire.admin.pagos-edit');
    }

    public function save(){

        $rules = $this->rules;
        $this->validate($rules);

        if($this->registro->plan != 'balance'){
            if($this->status == '1'){

                if($this->registro->type != 'Pago_restante_premium'){
                    $rules_type_confirmed = $this->rule_pago_recibido;
                    $this->validate($rules_type_confirmed);

                    $this->registro->update([
                        'status' => 'verificado',
                        'admin_first_id' => auth()->id(),
                        'admin_second_id' => $this->admin_verifi_id
                    ]);
    
                    $user_cliente = User::where('id',$this->registro->user_id)->first();

                    $fecha_actual = date("Y-m-d H:i:s");

                    if($this->type_confirmed == 1 || $this->type_confirmed == 2) $proxima_fecha = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 30 days"));
                    if($this->type_confirmed == 3) $proxima_fecha = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 10 days"));
                    if($this->type_confirmed == 4) $proxima_fecha = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 2 days"));

                    if($this->registro->payment_method_id == 1){
                        

                        $user_cliente = User::where('id',$this->registro->user_id)->first();
                        $balance_new = $user_cliente->balance - $this->registro->monto;

                        $user_cliente->update([
                            'status' => 'activo',
                            'balance' => $balance_new,
                            'last_payment_date' => $proxima_fecha,
                        ]);

                        $this->registro->update([
                            'monto' => '0',
                     
                        ]);

                    }
                    else{

                        $user_cliente->update([
                            'status' => 'activo',
                            'last_payment_date' => $proxima_fecha,
                        ]);
                    }
        

                    if($this->type_confirmed == 1){
                        $user_cliente->roles()->sync(2);

                        $this->registro->update([
                            'type' => 'basico',
                        ]);
                    }
                    if($this->type_confirmed == 2){
                        $user_cliente->roles()->sync(10);

                        $this->registro->update([
                            'type' => 'premium 30',
                        ]);
                    }
                    if($this->type_confirmed == 3){
                        $user_cliente->roles()->sync(10);

                        $this->registro->update([
                            'type' => 'premium 10',
                        ]);
                    }
                    if($this->type_confirmed == 4){
                        $user_cliente->roles()->sync(10);

                        $this->registro->update([
                            'type' => 'premium 2',
                        ]);
                    }
                }

                else{
                    $rules_type_confirmed = $this->rule_pago_recibido;
                    $this->validate($rules_type_confirmed);

                    $this->registro->update([
                        'status' => 'verificado',
                        'admin_first_id' => auth()->id(),
                        'admin_second_id' => $this->admin_verifi_id
                    ]);
    
                    $user_cliente = User::where('id',$this->registro->user_id)->first();

                    if($this->registro->payment_method_id == 1){

                        $user_cliente = User::where('id',$this->registro->user_id)->first();
                        $balance_new = $user_cliente->balance - $this->registro->monto;

                        $user_cliente->update([
                            'status' => 'activo',
                            'balance' => $balance_new,
                        ]);

                        $this->registro->update([
                            'monto' => '0',
                     
                        ]);

                    }
                    else{
                        $user_cliente->update([
                            'status' => 'activo',
                        ]);
                    }
                }
            }
    
            else{
                $this->registro->update([
                    'status' => 'no_recibido',
                    'admin_first_id' => auth()->id(),
                    'admin_second_id' => $this->admin_verifi_id
                ]);
    
                $user_cliente = User::where('id',$this->registro->user_id)->first();
    
                $user_cliente->update([
                    'status' => 'inactivo',
                ]);
    
                $user_cliente->roles()->sync(4);
            }
        }

        else{
            if($this->status == '1'){

                $this->registro->update([
                    'status' => 'verificado',
                    'admin_first_id' => auth()->id(),
                    'admin_second_id' => $this->admin_verifi_id
                ]);

                $user_cliente = User::where('id',$this->registro->user_id)->first();
                $balance_total = $user_cliente->balance + $this->registro->monto;
        
                $user_cliente->update([
                    'balance' => $balance_total,
                ]);
            }
            else{
                $this->registro->update([
                    'status' => 'no_recibido',
                    'admin_first_id' => auth()->id(),
                    'admin_second_id' => $this->admin_verifi_id
                ]);
            }
        }

        

        $this->reset(['isopen']);
        $this->emitTo('admin.pagos-index','render');
        $this->emitTo('admin.pagos-pendientes','render');
        $this->emit('alert','Datos modificados correctamente');
    }
}
