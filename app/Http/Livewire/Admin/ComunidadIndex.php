<?php

namespace App\Http\Livewire\Admin;

use App\Models\PagoRegistrosRecarga;
use App\Models\User;
use Livewire\Component;

class ComunidadIndex extends Component
{

    public $fecha_inicio, $fecha_fin, $carga_total = 0,
    $ganancia_mes_30_basic,
    $ganancia_mes_15_premium,
    $ganancia_mes_30_premium,
    $total_ganancia_mes,
    $ganancia_mes_basic_15_suscriptor,
    $ganancia_mes_basic_30_suscriptor,
    $ganancia_mes_basic_total_suscriptor,
    $ganancia_mes_premium_15_suscriptor,
    $ganancia_mes_premium_30_suscriptor,
    $ganancia_mes_premium_suscriptor_total;

    public function buscar(){

        if($this->fecha_inicio && $this->fecha_fin){
            $this->carga_total = 1;

            $this->ganancia_mes_30_basic=PagoRegistrosRecarga::where('status','verificado')
            ->whereDate('created_at', '>=', $this->fecha_inicio)
            ->whereDate('created_at', '<=', $this->fecha_fin)
            ->where('plan','30')
            ->where('type','basico')
            ->sum('monto');

            $this->ganancia_mes_15_premium=PagoRegistrosRecarga::where('status','verificado')
            ->whereDate('created_at', '>=', $this->fecha_inicio)
            ->whereDate('created_at', '<=', $this->fecha_fin)
            ->where('plan','15')
            ->where('type','premium')
            ->sum('monto');

            $this->ganancia_mes_30_premium=PagoRegistrosRecarga::where('status','verificado')
            ->whereDate('created_at', '>=', $this->fecha_inicio)
            ->whereDate('created_at', '<=', $this->fecha_fin)
            ->where('plan','30')
            ->where('type','premium')
            ->sum('monto');

            $this->total_ganancia_mes= $this->ganancia_mes_30_premium + $this->ganancia_mes_15_premium + $this->ganancia_mes_30_basic;

            $this->ganancia_mes_basic_15_suscriptor=PagoRegistrosRecarga::where('status','verificado')
            ->whereDate('created_at', '>=', $this->fecha_inicio)
            ->whereDate('created_at', '<=', $this->fecha_fin)
            ->where('plan','15')
            ->sum('pago_basico');

            $this->ganancia_mes_basic_30_suscriptor=PagoRegistrosRecarga::where('status','verificado')
            ->whereDate('created_at', '>=', $this->fecha_inicio)
            ->whereDate('created_at', '<=', $this->fecha_fin)
            ->where('plan','30')
            ->sum('pago_basico');

            $this->ganancia_mes_basic_total_suscriptor= $this->ganancia_mes_basic_30_suscriptor + $this->ganancia_mes_basic_15_suscriptor;

            $this->ganancia_mes_premium_15_suscriptor = PagoRegistrosRecarga::where('status','verificado')
            ->whereDate('created_at', '>=', $this->fecha_inicio)
            ->whereDate('created_at', '<=', $this->fecha_fin)
            ->where('type','premium')
            ->where('plan','15')
            ->sum('pago_premium');

            $this->ganancia_mes_premium_30_suscriptor = PagoRegistrosRecarga::where('status','verificado')
            ->whereDate('created_at', '>=', $this->fecha_inicio)
            ->whereDate('created_at', '<=', $this->fecha_fin)
            ->where('type','premium')
            ->where('plan','30')
            ->sum('pago_premium');

            $this->ganancia_mes_premium_suscriptor_total = $this->ganancia_mes_premium_15_suscriptor + $this->ganancia_mes_premium_30_suscriptor;
        }

    }

    public function render()
    {
        $user= User::where('id',auth()->id())->first();
        $rol_user = $user->roles->first()->id;

        $mes= date('m');
        $ano= date('Y');
        $dia= date('d');

        $users_activos = User::where('status','activo')
            ->where('type','!=','gratis')
            ->permission('ssidkr.index')
            ->count();

        $users_inactivos = User::where('status','inactivo')
            ->where('type','!=','gratis')
            ->count();
        
        $registros_mes = User::whereMonth('created_at', $mes)
        ->whereYear('created_at', $ano)
        ->whereMonth('email_verified_at', $mes)
        ->whereYear('email_verified_at', $ano)
        ->where('status','activo')
        ->permission('ssidkr.index')
        ->count();

        $registros_dias = User::whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->whereMonth('email_verified_at', $mes)
            ->whereDay('email_verified_at', $dia)
            ->whereYear('email_verified_at', $ano)
            ->where('status','activo')
            ->permission('ssidkr.index')
            ->count();

        
        $users_plan_15_basic = User::where('status','activo')
            ->where('plan','15')
            ->where('type','basico')
            ->permission('ssidkr.index')
            ->count();

        $users_plan_15_premium = User::where('status','activo')
            ->where('plan','15')
            ->where('type','premium')
            ->permission('menu.premium')
            ->count();

        $users_plan_30_basic = User::where('status','activo')
            ->where('plan','30')
            ->where('type','basico')
            ->permission('ssidkr.index')
            ->count();

        $users_plan_30_premium = User::where('status','activo')
            ->where('plan','30')
            ->where('type','premium')
            ->permission('menu.premium')
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

        $total_ganancia_dia = $ganancia_dia_30_premium + $ganancia_dia_15_premium + $ganancia_dia_30_basic;
        
        
        return view('livewire.admin.comunidad-index',compact('total_ganancia_dia','users_activos','users_inactivos','registros_mes','registros_dias','users_plan_15_basic','users_plan_15_premium','users_plan_30_basic','users_plan_30_premium','ganancia_dia_15_basic','ganancia_dia_30_basic','rol_user','ganancia_dia_15_premium','ganancia_dia_30_premium'));
    }
}
