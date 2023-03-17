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
            ->whereDay('email_verified_at', $mes)
            ->whereYear('email_verified_at', $mes)
            ->count();

        $users_plan_7 = User::where('status','activo')
            ->where('plan','7')
            ->count();
        
        $users_plan_15 = User::where('status','activo')
            ->where('plan','15')
            ->count();

        $users_plan_30 = User::where('status','activo')
            ->where('plan','30')
            ->count();

        $ganancia_dia_7 = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','7')
            ->sum('monto');

        $ganancia_dia_15 = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','15')
            ->sum('monto');

        $ganancia_dia_30 = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','30')
            ->sum('monto');

        $users = User::where('type',null)
            ->paginate(15);

        
        

        return view('livewire.admin.comunidad-index',compact('users','users_activos','users_inactivos','registros_mes','registros_dias','users_plan_7','users_plan_15','users_plan_30','ganancia_dia_7','ganancia_dia_15','ganancia_dia_30','rol_user'));
    }
}
