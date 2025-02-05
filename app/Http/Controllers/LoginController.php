<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Multilog;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use DateTime;

class LoginController extends Controller
{
    public function authenticate(Request $request){

        // Retrive Input
        $credentials =  $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $request->validate([
            'captcha' => ['required','captcha'],

        ]);

        if (Auth::attempt($credentials)) {
            $user = User::where('id',auth()->user()->id)->first();
            $date = new DateTime();
            $date_actual= $date->format('Y-m-d H:i:s');

            if($user->telegram){

                $user->update([
                    'ip'=> request()->ip(),
                ]);


                if($user->last_logout){
                    $date_last_login = new DateTime($user->last_logout);
                    $date_last_login_aumentada = $date_last_login->modify('+20 minute')->format('Y-m-d H:i:s');
                    
                    //cierro
                    if($date_actual <= $date_last_login_aumentada && $user->id != 2 && $user->id != 2049 && $user->id != 5 && $user->id != 1500){
        
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
        
                            if($user->id != 14 && $user->id != 22 && $user->id != 2049){
        
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
                
                        if($user->id != 14 && $user->id != 22){
        
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
                $user->update([
                    'ip'=> request()->ip(),
                ]);
                return redirect()->route("register_dates.index",$user);

            // return redirect()->route("register_dates.index")->with('email_user', $request['email']);
            }

            
        }
        // if failed login
        return redirect('login');
    }
}
