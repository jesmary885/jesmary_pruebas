<?php

namespace App\Http\Controllers;

use App\Models\Multilog;
use App\Models\PagoRegistrosRecarga;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
//require __DIR__.'/../src/CedulaVE.php';

use MegaCreativo\API\CedulaVE;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $fecha_actual = Carbon::now();

        $ip_user = request()->ip();

        $mensaje = '';
        $user = User::where('id',auth()->user()->id)->first();
        $rol = $user->roles->first()->id;

        $pago_registrado = PagoRegistrosRecarga::where('user_id',$user->id)
            ->where('status','pendiente')
            ->count();

        if($user->last_payment_date){
            
            $corte = Carbon::parse($user->last_payment_date);

            $diasDiferencia = ($corte->diffInDays($fecha_actual) + 1);

            if($diasDiferencia == 2){
                $mensaje = "$user->username, te recordamos que el saldo de tu cuenta vence en 2 días, reporta tu pago";
            }
            if($diasDiferencia == 1){
                $mensaje = "$user->username, te recordamos que el saldo de tu cuenta vence en 1 día, reporta tu pago";
            }
            if($diasDiferencia < 1){
                $mensaje = "$user->username, te recordamos que el saldo de tu cuenta vence hoy, reporta tu pago";
            }
        }

        return view('home',compact('rol','mensaje','pago_registrado','user','ip_user'));
    }

}
