<?php

namespace App\Http\Livewire\Admin;

use App\Models\PagoRegistrosRecarga;
use App\Models\User;
use Livewire\Component;

class ComunidadIndex extends Component
{
    public function pago_user($user){

        $mes= date('m');
        $ano= date('Y');
        $dia= date('d');

        return PagoRegistrosRecarga::whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->where('user_id',$user)
            ->where('status','verificado')
            ->get();

    }
    public function render()
    {
        $user= User::where('id',auth()->id())->first();
        $rol_user = $user->roles->first()->id;

        $mes= date('m');
        $ano= date('Y');
        $dia= date('d');

        $users_activos = User::where('status','activo')
            ->count();

        $users_inactivos = User::where('status','inactivo')
            ->count();
        
        $registros_mes = User::whereMonth('created_at', $mes)
        ->whereYear('created_at', $ano)
        ->whereMonth('email_verified_at', $mes)
        ->whereYear('email_verified_at', $ano)
        ->count();

        $registros_dias = User::whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->whereMonth('email_verified_at', $mes)
            ->whereDay('email_verified_at', $dia)
            ->whereYear('email_verified_at', $ano)
            ->count();

        
        $users_plan_15_basic = User::where('status','activo')
            ->where('plan','15')
            ->where('type','basico')
            ->count();

        $users_plan_15_premium = User::where('status','activo')
            ->where('plan','15')
            ->where('type','premium')
            ->count();

        $users_plan_30_basic = User::where('status','activo')
            ->where('plan','30')
            ->where('type','basico')
            ->count();

        $users_plan_30_premium = User::where('status','activo')
            ->where('plan','30')
            ->where('type','premium')
            ->count();

        //GANANCIAS DEL DIA

        $ganancia_dia_15_basic = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','15')
            ->where('type','basico')
            ->sum('monto');

        $ganancia_dia_30_basic = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','30')
            ->where('type','basico')
            ->sum('monto');

        $ganancia_dia_15_premium = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','15')
            ->where('type','premium')
            ->sum('monto');

        $ganancia_dia_30_premium = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','30')
            ->where('type','premium')
            ->sum('monto');

        //GANANCIAS DEL MES

        $ganancia_mes_15_basic = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->where('plan','15')
            ->where('type','basico')
            ->sum('monto');

        $ganancia_mes_30_basic = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->where('plan','30')
            ->where('type','basico')
            ->sum('monto');

        $ganancia_mes_15_premium = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->where('plan','15')
            ->where('type','premium')
            ->sum('monto');

        $ganancia_mes_30_premium = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->where('plan','30')
            ->where('type','premium')
            ->sum('monto');

        
        /////////////////// GANANCIA DE 1$ POR SUSCRIPTOR

        $ganancia_mes_basic_15_suscriptor = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->where('plan','15')
            ->sum('pago_basico');

        $ganancia_mes_basic_30_suscriptor = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->where('plan','30')
            ->sum('pago_basico');
        
        $ganancia_mes_basic_total_suscriptor = $ganancia_mes_basic_15_suscriptor + $ganancia_mes_basic_30_suscriptor;

        $users = User::where('type',null)
            ->paginate(15);

        
        return view('livewire.admin.comunidad-index',compact('users','users_activos','users_inactivos','registros_mes','registros_dias','users_plan_15_basic','users_plan_15_premium','users_plan_30_basic','users_plan_30_premium','ganancia_dia_15_basic','ganancia_dia_30_basic','rol_user','ganancia_dia_15_premium','ganancia_dia_30_premium','ganancia_mes_15_basic','ganancia_mes_30_basic','ganancia_mes_15_premium','ganancia_mes_30_premium','ganancia_mes_basic_15_suscriptor','ganancia_mes_basic_30_suscriptor','ganancia_mes_basic_total_suscriptor'));
    }
}
