<?php

namespace App\Console\Commands;

use App\Models\PagoRegistrosRecarga;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class RenovarMembresia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'renovation:membresia';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach($users as $user){

            $role_id = $user->roles->first()->id;

            $fecha_actual = date("Y-m-d h:s");
            $date = Carbon::now();

            $user = User::where('id',$user->id)->first();
        
            $new_pago = new PagoRegistrosRecarga();
            $new_pago->user_id = $user->id;

            if($role_id == '4' && $user->status == 'activo' && $user->type != 'gratis' && $user->check_renovation == 'si'  && $user->type != 'null'){

                if ($user->type == 'basico' ){

                    if($user->balance >= 10){ 

                        $new_pago->type = 'basico';
                        $new_pago->monto = '0';
                        $new_pago->status = 'verificado';
                        $new_pago->pago_basico = '0';
                        $new_pago->pago_premium = '0';
                        $new_pago->plan = '30';  
                        $new_pago->payment_method_id = 1;
                        $new_pago->save();

                        $plan_nuevo = '30';
                        $monto_pago = '10';
                        $type = "basico";
                        $user->roles()->sync(2);

                        $proxima_fecha = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 30 days"));

                        $balance_new = $user->balance - $monto_pago;

                        $user->update([
                            'status' => 'activo',
                            'last_payment_date' => $proxima_fecha,
                            'type' => $type,
                            'plan' => $plan_nuevo,
                            'balance' => $balance_new,
                        ]);
                    }
                }

                elseif ($user->type == 'premium 30' ){

                    if($user->balance >= 25){ 

                        $new_pago->type = 'premium 30 dias';
                        $new_pago->monto = '0';
                        $new_pago->status = 'verificado';
                        $new_pago->pago_basico = '0';
                        $new_pago->pago_premium = '0';
                        $new_pago->plan = '30';  
                        $new_pago->payment_method_id = 1;
                        $new_pago->save();

                        $plan_nuevo = '30';
                        $monto_pago = '25';
                        $type = "premium 30";
                        $user->roles()->sync(10);

                        $proxima_fecha = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 30 days"));

                        $balance_new = $user->balance - $monto_pago;

                        $user->update([
                            'status' => 'activo',
                            'last_payment_date' => $proxima_fecha,
                            'type' => $type,
                            'plan' => $plan_nuevo,
                            'balance' => $balance_new,
                        ]);
                    }
                }

                elseif ($user->type == 'premium 10' ){

                    if($user->balance >= 10){ 

                        $new_pago->type = 'premium 10 dias';
                        $new_pago->monto = '0';
                        $new_pago->status = 'verificado';
                        $new_pago->pago_basico = '0';
                        $new_pago->pago_premium = '0';
                        $new_pago->plan = '10';  
                        $new_pago->payment_method_id = 1;
                        $new_pago->save();

                        $plan_nuevo = '10';
                        $monto_pago = '10';
                        $type = "premium 10";
                        $user->roles()->sync(10);

                        $proxima_fecha = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 10 days"));

                        $balance_new = $user->balance - $monto_pago;

                        $user->update([
                            'status' => 'activo',
                            'last_payment_date' => $proxima_fecha,
                            'type' => $type,
                            'plan' => $plan_nuevo,
                            'balance' => $balance_new,
                        ]);
                    }
                }

                elseif ($user->type == 'premium 2' ){

                    if($user->balance >= 3){ 

                        $new_pago->type = 'premium 2 dias';
                        $new_pago->monto = '0';
                        $new_pago->status = 'verificado';
                        $new_pago->pago_basico = '0';
                        $new_pago->pago_premium = '0';
                        $new_pago->plan = '2';  
                        $new_pago->payment_method_id = 1;
                        $new_pago->save();

                        $plan_nuevo = '2';
                        $monto_pago = '3';
                        $type = "premium 2";
                        $user->roles()->sync(10);

                        $proxima_fecha = date("Y-m-d H:i:s",strtotime($fecha_actual."+ 2 days"));

                        $balance_new = $user->balance - $monto_pago;

                        $user->update([
                            'status' => 'activo',
                            'last_payment_date' => $proxima_fecha,
                            'type' => $type,
                            'plan' => $plan_nuevo,
                            'balance' => $balance_new,
                        ]);
                    }
                }
            }
        }
    }
}
