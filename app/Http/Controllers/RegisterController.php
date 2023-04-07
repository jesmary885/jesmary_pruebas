<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\StatefulGuard;
use MegaCreativo\API\CedulaVE;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    use PasswordValidationRules;

    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

 
    public function index(){

        return view('auth.register');
    }

    public function date_index(User $user){

       

        $user_search = $user->username;

        $user_search_email = $user->email;

        return view('auth.register_dates',compact('user_search','user_search_email'));
    }

    public function date_create(Request $request){

        $request->validate([
            'telegram' => ['required','unique:users'],
            'nacionalidad' => ['required'],
            'dni' => ['required','unique:users'],
            //'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        
        $user_search = User::where('email',$request['email'])->first();

        Session::flush();
        Auth::logout();


        $user_search->update([
            'last_logout' => null,
        ]);

        if($request['nacionalidad'] == 1){



            

            $dni = str_replace('.', '', $request['dni']);

            $datos = CedulaVE::info('V',$dni, false);

            if($datos['status'] == 200){

                $user_search->update([
                    'dni' => $dni,
                    'name_user' => $datos['data']['name'],
                    'lastname_user' => $datos['data']['lastname'],
                    'estado' => $datos['data']['state'],
                    'municipio' => $datos['data']['municipality'],
                    'parroquia' => $datos['data']['parish'],
                    'telegram' => $request['telegram'],
                    'nacionalidad' => 'Venezolana',
                ]);

                $user_search->assignRole($user_search->rol_name);

                return redirect()->route("login_guest");

             
            }

            else{

                $msj = 'Su número de cédula no se encuentra en los registros, intentalo de nuevo o comunicate con un administrador';
                return redirect()->route("register_dates.index",$user_search )->with('info', $msj);
            }
        }

        else{

            $user_search->update([
                'last_logout' => null,
            ]);

            $dni = str_replace('.', '', $request['dni']);

            $user_search->update([
                'dni' => $request['dni'],
                'telegram' => $request['telegram'],
                'nacionalidad' => 'Extranjera'
            ]);

            $user_search->assignRole($user_search->rol_name);

            Session::flush();
            Auth::logout();
    

            return redirect()->route("login_guest");

        }

        

        
    }

    public function create(Request $request){
        $busqueda_correo_gmail_min = strpos($request->email, 'gmail.com');
        $busqueda_correo_gmail_may = strpos($request->email, 'GMAIL.COM');
        $busqueda_correo_outlook_min = strpos($request->email, 'outlook.com');
        $busqueda_correo_outlook_may = strpos($request->email, 'OUTLOOK.COM');
        $busqueda_correo_yahoo_min = strpos($request->email, 'yahoo.com');
        $busqueda_correo_yahoo_may = strpos($request->email, 'YAHOO.COM');
        $busqueda_correo_hotmail_min = strpos($request->email, 'hotmail.com');
        $busqueda_correo_hotmail_may = strpos($request->email, 'HOTMAIL.COM');

        if($busqueda_correo_gmail_min !== false  ||
        $busqueda_correo_gmail_may !== false  ||
        $busqueda_correo_outlook_min !== false  ||
        $busqueda_correo_outlook_may !== false  ||
        $busqueda_correo_yahoo_min !== false  ||
        $busqueda_correo_yahoo_may !== false  ||
        $busqueda_correo_hotmail_min !== false  ||
        $busqueda_correo_hotmail_may !== false){

            $request->validate([
                'name' => ['required', 'string', 'max:255','unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            ]);
    
            return User::create([
                'name' => $request['name'],
                'username' => $request['name'],
                'status' => 'activo',
                'balance' => 0,
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'points_positive' => 0,
                'points_negative' => 0,
                'points_neutral' => 0,
                'plan' => 30,
                'last_payment_date' => date('Y-m-d'),
               // 'type' => 'gratis',
            ])->assignRole('Inactivo');

        }

        else{

            dd('jjjj');
            $msj = 'Cuenta no creada, ingrese una cuenta de correo segura (gmail,hotmail,outlook o yahoo)';
            return redirect('/registro')->with('info', $msj);
        }
    }
}
