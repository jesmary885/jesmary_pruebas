<?php

namespace App\Http\Livewire\Admin;

use App\Models\PagoRegistrosRecarga;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

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
    $ganancia_mes_premium_suscriptor_total,
    $ganancia_mes_premium_5_suscriptor,
    $ganancia_saldos_pagina,
    $ganancia_mes_10_premium,
    $ganancia_mes_2_premium,
    $ganancia_mes_premium_2_suscriptor,
    $ganancia_mes_premium_10_suscriptor,
    $ganancia_mes_5_premium;

    public function buscar(){

        if($this->fecha_inicio && $this->fecha_fin){

            $fecha_inicio = date("Y-m-d H:i", strtotime($this->fecha_inicio));
            $fecha_fin = date("Y-m-d H:i", strtotime($this->fecha_fin));

            $this->carga_total = 1;

            $ganancia_saldos_pagina = DB::select('SELECT sum(p.monto) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "balance" AND p.type = "Saldo en pagina" AND p.status = "verificado"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach($ganancia_saldos_pagina as $e){
                $this->ganancia_saldos_pagina = $e->monto;
            }


            $ganancia_mes_30_basic_q = DB::select('SELECT sum(p.monto) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "30" AND p.type = "basico" AND p.status = "verificado"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach($ganancia_mes_30_basic_q as $e){
                $this->ganancia_mes_30_basic = $e->monto;
            }


            $ganancia_mes_30_premium_q = DB::select('SELECT sum(p.monto) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "30" AND p.type = "premium 30" AND p.status = "verificado"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach($ganancia_mes_30_premium_q as $e){
                $this->ganancia_mes_30_premium = $e->monto;
            }

            $ganancia_mes_10_premium_q = DB::select('SELECT sum(p.monto) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "10" AND p.type = "premium 10" AND p.status = "verificado"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach($ganancia_mes_10_premium_q as $e){
                $this->ganancia_mes_10_premium = $e->monto;
            }

            $ganancia_mes_2_premium_q = DB::select('SELECT sum(p.monto) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "2" AND p.type = "premium 2" AND p.status = "verificado"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach($ganancia_mes_2_premium_q as $e){
                $this->ganancia_mes_2_premium = $e->monto;
            }

            $ganancia_mes_premium_5_q = DB::select('SELECT sum(p.monto) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "30"  AND p.status = "verificado" AND p.type = "Pago_restante_premium"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach( $ganancia_mes_premium_5_q as $e){
                $this->ganancia_mes_5_premium = $e->monto;
            }

            $this->total_ganancia_mes= $this->ganancia_saldos_pagina + $this->ganancia_mes_30_premium + $this->ganancia_mes_2_premium + $this->ganancia_mes_10_premium + $this->ganancia_mes_30_basic + $this->ganancia_mes_5_premium;


            ////////////////////////////////////////////////


            $ganancia_mes_basic_15_suscriptor_q = DB::select('SELECT sum(p.pago_basico) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "30" AND p.status = "verificado" AND p.type = "basico"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach($ganancia_mes_basic_15_suscriptor_q as $e){
                $this->ganancia_mes_basic_15_suscriptor = $e->monto;
            }

            $ganancia_mes_basic_30_suscriptor_q = DB::select('SELECT sum(p.pago_basico) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "30" AND p.status = "verificado" AND p.type = "premium 30"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach($ganancia_mes_basic_30_suscriptor_q as $e){
                $this->ganancia_mes_basic_30_suscriptor = $e->monto;
            }


            $this->ganancia_mes_basic_total_suscriptor= $this->ganancia_mes_basic_30_suscriptor + $this->ganancia_mes_basic_15_suscriptor;

            //////////////////////////////////////////

            
            $ganancia_mes_premium_15_suscriptor_q = DB::select('SELECT sum(p.pago_premium) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "30" AND p.status = "verificado" AND p.type = "basico"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));
            
            foreach($ganancia_mes_premium_15_suscriptor_q as $e){
                $this->ganancia_mes_premium_15_suscriptor = $e->monto;
            }

            $ganancia_mes_premium_30_suscriptor_q = DB::select('SELECT sum(p.pago_premium) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "30"  AND p.status = "verificado" AND p.type = "premium 30"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach($ganancia_mes_premium_30_suscriptor_q as $e){
                $this->ganancia_mes_premium_30_suscriptor = $e->monto;
            }

            $ganancia_mes_premium_10_suscriptor_q = DB::select('SELECT sum(p.pago_premium) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "10"  AND p.status = "verificado" AND p.type = "premium 10"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach($ganancia_mes_premium_10_suscriptor_q as $e){
                $this->ganancia_mes_premium_10_suscriptor = $e->monto;
            }

            $ganancia_mes_premium_2_suscriptor_q = DB::select('SELECT sum(p.pago_premium) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "2"  AND p.status = "verificado" AND p.type = "premium 2"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach($ganancia_mes_premium_2_suscriptor_q as $e){
                $this->ganancia_mes_premium_2_suscriptor = $e->monto;
            }



            $ganancia_mes_premium_5_suscriptor_q = DB::select('SELECT sum(p.pago_premium) as monto from pago_registros_recargas p
            where p.created_at BETWEEN :fecha_inicioo AND :fecha_finn AND p.plan = "30"  AND p.status = "verificado" AND p.type = "Pago_restante_premium"'
            ,array('fecha_inicioo' =>$fecha_inicio, 'fecha_finn' => $fecha_fin));

            foreach( $ganancia_mes_premium_5_suscriptor_q as $e){
                $this->ganancia_mes_premium_5_suscriptor = $e->monto;
            }


            $this->ganancia_mes_premium_suscriptor_total = $this->ganancia_mes_premium_15_suscriptor + $this->ganancia_mes_premium_30_suscriptor + $this->ganancia_mes_premium_10_suscriptor + $this->ganancia_mes_premium_2_suscriptor + $this->ganancia_mes_premium_5_suscriptor;
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
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->permission('ssidkr.index')
            ->count();

        $users_inactivos = User::where('status','inactivo')
            ->where('type','!=','gratis')
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->count();

        $users_inactivos_rol = User::where('type','!=','gratis')
            ->permission('cuenta.inactiva')
            ->count();
        
        $registros_mes = User::whereMonth('created_at', $mes)
        ->whereYear('created_at', $ano)
        ->where('id','!=','2017')
        ->where('id','!=','2018')
        ->where('id','!=','2019')
        ->where('id','!=','2020')
        ->where('id','!=','2021')
        ->where('id','!=','2022')
        ->where('id','!=','2023')
        ->where('id','!=','2024')
        ->where('id','!=','2033')
        ->where('id','!=','2034')
        ->where('id','!=','2035')
        ->where('id','!=','2036')
        ->where('id','!=','2037')
        ->where('id','!=','2038')
        ->where('id','!=','2039')
        ->where('id','!=','2040')
        ->whereMonth('email_verified_at', $mes)
        ->whereYear('email_verified_at', $ano)
        ->where('status','activo')
        ->permission('ssidkr.index')
        ->count();

        $registros_dias = User::whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->whereMonth('email_verified_at', $mes)
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->whereDay('email_verified_at', $dia)
            ->whereYear('email_verified_at', $ano)
            ->where('status','activo')
            ->count();

        $users_plan_15_basic = User::where('status','activo')
            ->where('plan','15')
            ->where('type','basico')
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->permission('ssidkr.index')
            ->count();

        $users_plan_10_premium = User::where('status','activo')
            ->where('plan','10')
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->where('type','premium 10')
            ->permission('menu.premium')
            ->count();

        $users_plan_2_premium = User::where('status','activo')
            ->where('plan','2')
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->where('type','premium 2')
            ->permission('menu.premium')
            ->count();

        $users_plan_30_basic = User::where('status','activo')
            ->where('plan','30')
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->where('type','basico')
            ->permission('ssidkr.index')
            ->count();

        $users_plan_30_premium = User::where('status','activo')
            ->where('plan','30')
            ->where('id','!=','2017')
            ->where('id','!=','2018')
            ->where('id','!=','2019')
            ->where('id','!=','2020')
            ->where('id','!=','2021')
            ->where('id','!=','2022')
            ->where('id','!=','2023')
            ->where('id','!=','2024')
            ->where('id','!=','2033')
            ->where('id','!=','2034')
            ->where('id','!=','2035')
            ->where('id','!=','2036')
            ->where('id','!=','2037')
            ->where('id','!=','2038')
            ->where('id','!=','2039')
            ->where('id','!=','2040')
            ->where('type','premium 30')
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

        $ganancia_dia_2_premium = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','2')
            ->where('type','premium 2')
            ->sum('monto');

        $ganancia_dia_10_premium = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','10')
            ->where('type','premium 10')
            ->sum('monto');

        $ganancia_dia_30_premium = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','30')
            ->where('type','premium 30')
            ->sum('monto');

        $ganancia_dia_5_premium = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','30')
            ->where('type','Pago_restante_premium')
            ->sum('monto');

        $ganancia_dia_saldo_pagina = PagoRegistrosRecarga::where('status','verificado')
            ->whereMonth('created_at', $mes)
            ->whereDay('created_at', $dia)
            ->whereYear('created_at', $ano)
            ->where('plan','balance')
            ->where('type','Saldo en pagina')
            ->sum('monto');

        $total_ganancia_dia = $ganancia_dia_saldo_pagina + $ganancia_dia_30_premium  + $ganancia_dia_30_basic + $ganancia_dia_5_premium + $ganancia_dia_10_premium + $ganancia_dia_2_premium;
        
        
        return view('livewire.admin.comunidad-index',compact('users_inactivos_rol','users_plan_2_premium','ganancia_dia_saldo_pagina','ganancia_dia_5_premium','total_ganancia_dia','users_activos','users_inactivos','registros_mes','registros_dias','users_plan_15_basic','users_plan_10_premium','users_plan_30_basic','users_plan_30_premium','ganancia_dia_15_basic','ganancia_dia_30_basic','rol_user','ganancia_dia_10_premium','ganancia_dia_30_premium','ganancia_dia_2_premium'));
    }
}
