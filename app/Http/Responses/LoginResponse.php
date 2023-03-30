<?php

namespace App\Http\Responses;

use App\Models\Multilog;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse {

        $user = User::where('id',auth()->user()->id)->first();
        $date = new DateTime();
        $date_actual= $date->format('Y-m-d H:i:s');

        if($user->last_logout){
            $date_last_login = new DateTime($user->last_logout);
            $date_last_login_aumentada = $date_last_login->modify('+25 minute')->format('Y-m-d H:i:s');
            

            if($date_actual <= $date_last_login_aumentada){

                $date_laa = new \Carbon\Carbon($date_last_login_aumentada);

                $faltante = $date_laa->diffInMinutes($date_actual);

                $msj = 'Por medidas de seguridad debe esperar '. $faltante. ' minutos para poder ingresar nuevamente a su cuenta';

                Session::flush();
                Auth::logout();

                return redirect()->route("login_guest")->with('info', $msj);
            }
    
            else{
               
                if ($request->user()->status == 'activo') {
    
                    $request->session()->regenerate();
        
                    $previous_session = Auth::User()->session_id;
                    if ($previous_session) {

                        $date = Carbon::now();

                        $user = User::where('id',auth()->user()->id)->first();

                        $user->update([
                            'last_logout' => $date

                        ]);

                        Session::getHandler()->destroy($previous_session);
                    }
        
                    $mes= date('m');
                    $ano= date('Y');
                    $dia= date('d');
            
                    $ip_user = request()->ip();
            
                    $user_ip = Multilog::whereDay('created_at', $dia)
                        ->whereYear('created_at', $ano)
                        ->whereMonth('created_at', $mes)
                        ->where('user_id',$user->id)
                        ->where('ip',$ip_user)
                        ->first();
            
                    if(!$user_ip){
                        $multilog_ip = new Multilog();
                        $multilog_ip->ip = $ip_user;
                        $multilog_ip->user_id  = $user->id;
                        $multilog_ip->save();
                    }
        
                    $user->session_id = Session::getId();
                    $user->save();
        
                    return redirect(route("home")) ?: redirect(route("login_guest"));
                }
        
                else{
                    Session::flush();
                    Auth::logout();

                    $msj = 'Su cuenta se encuentra inactiva, para más información comuníquese con Soporte Técnico';
                    return redirect()->route("login_guest")->with('info', $msj);
                    //return redirect('/login');
                }
            }
        }

        else{

            if ($request->user()->status == 'activo') {
    
                $request->session()->regenerate();
    
                $previous_session = Auth::User()->session_id;
                if ($previous_session) {

                    $date = Carbon::now();

                    $user = User::where('id',auth()->user()->id)->first();

                    $user->update([
                        'last_logout' => $date

                    ]);

                    Session::getHandler()->destroy($previous_session);
                }
    
                $mes= date('m');
                $ano= date('Y');
                $dia= date('d');
        
                $ip_user = request()->ip();
        
                $user_ip = Multilog::whereDay('created_at', $dia)
                    ->whereYear('created_at', $ano)
                    ->whereMonth('created_at', $mes)
                    ->where('user_id',$user->id)
                    ->where('ip',$ip_user)
                    ->first();
        
                if(!$user_ip){
                    $multilog_ip = new Multilog();
                    $multilog_ip->ip = $ip_user;
                    $multilog_ip->user_id  = $user->id;
                    $multilog_ip->save();
                }
    
                $user->session_id = Session::getId();
                $user->save();
    
                return redirect(route("home")) ?: redirect(route("login_guest"));
            }
    
            else{

                Session::flush();
                Auth::logout();
                $msj = 'Su cuenta se encuentra inactiva, para más información comuníquese con Soporte Técnico';
                return redirect()->route("login_guest")->with('info', $msj);
    
                //return redirect('/login');
            }
        }
       
    }
}