<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use MegaCreativo\API\CedulaVE;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255','unique:users'],
            'telegram' => ['required','unique:users'],
            'nacionalidad' => ['required'],
            //'dni' => ['required','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        if($input['nacionalidad'] == 1){

            $dni = str_replace('.', '', $input['dni']);

            if ($dni){
                $datos = CedulaVE::info('V',$dni, false);

                if($datos['status'] == 200){

                    return User::create([
                        'name' => $input['name'],
                        'username' => $input['name'],
                        'telegram' => $input['telegram'],
                        'nacionalidad' => $input['nacionalidad'],
                        'dni' => $dni,
                        'status' => 'activo',
                        'balance' => 0,
                        'email' => $input['email'],
                        'password' => Hash::make($input['password']),
                        'points_positive' => 0,
                        'points_negative' => 0,
                        'points_neutral' => 0,
                        'name_user' => $datos['data']['name'],
                        'lastname_user' => $datos['data']['lastname'],
                        'estado' => $datos['data']['state'],
                        'municipio' => $datos['data']['municipality'],
                        'parroquia' => $datos['data']['parish'],
                        'nacionalidad' => 'Venezolana',
                    ])->assignRole('Inactivo');

                }

                else{
                    $msj = 'Su número de cédula no se encuentra en los registros, intentalo de nuevo o comunicate con un administrador';
                    return redirect('/dates')->with('info', $msj);
                }
            }

            else{
                return User::create([
                    'username' => $input['name'],
                    'telegram' => $input['telegram'],
                    'nacionalidad' => $input['nacionalidad'],
                    'status' => 'activo',
                    'balance' => 0,
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'points_positive' => 0,
                    'points_negative' => 0,
                    'points_neutral' => 0,
                    'nacionalidad' => 'Venezolana',
                ])->assignRole('Inactivo');

            }

            


        }

        else{

            $dni = str_replace('.', '', $input['dni']);

            if ($dni){

                $dni = str_replace('.', '', $input['dni']);

                return User::create([
                    'name' => $input['name'],
                    'username' => $input['name'],
                    'telegram' => $input['telegram'],
                    'nacionalidad' => $input['nacionalidad'],
                    //'dni' => $dni,
                    'status' => 'activo',
                    'balance' => 0,
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'points_positive' => 0,
                    'points_negative' => 0,
                    'points_neutral' => 0,
                    'nacionalidad' => 'Extranjera',                
                ])->assignRole('Inactivo');
            }

            else{

                return User::create([
                    'username' => $input['name'],
                    'telegram' => $input['telegram'],
                    'nacionalidad' => $input['nacionalidad'],
                    //'dni' => $dni,
                    'status' => 'activo',
                    'balance' => 0,
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'points_positive' => 0,
                    'points_negative' => 0,
                    'points_neutral' => 0,
                    'nacionalidad' => 'Extranjera',                
                ])->assignRole('Inactivo');

            }
        }
    }
}
