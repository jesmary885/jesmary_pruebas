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
            //'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        
        $user_search = User::where('email',$request['email'])->first();

        if($request['nacionalidad'] == 1){

                    $user_search->update([
                       
                        'telegram' => $request['telegram'],
                        'nacionalidad' => 'Venezolana',
                    ]);

                    if($user_search->rol_name == 'Administrador'){
                        $user_search->roles()->sync(1);
                    }

                    if($user_search->rol_name == 'Encuestador Premium'){
                        $user_search->roles()->sync(10);
                    }

                    if($user_search->rol_name == 'Encuestador Basico'){
                        $user_search->roles()->sync(2);
                    }

                    if($user_search->rol_name == 'Proveedor links'){
                        $user_search->roles()->sync(7);
                    }

                    return redirect(route("home"));
        }

        else{


                $user_search->update([
                    'telegram' => $request['telegram'],
                    'nacionalidad' => 'Extranjera'
                ]);

                if($user_search->rol_name == 'Administrador'){
                    $user_search->roles()->sync(1);
                }

                if($user_search->rol_name == 'Encuestador Premium'){
                    $user_search->roles()->sync(10);
                }

                if($user_search->rol_name == 'Encuestador Basico'){
                    $user_search->roles()->sync(2);
                }

                if($user_search->rol_name == 'Proveedor links'){
                    $user_search->roles()->sync(7);
                }

                return redirect(route("home"));


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
