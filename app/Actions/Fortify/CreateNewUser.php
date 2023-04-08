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
            'name' => ['required', 'string', 'max:50','unique:users'],
            'telegram' => ['required','unique:users'],
            'nacionalidad' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        if($input['nacionalidad'] == 1){



                   /* return User::create([
                        'name' => $input['name'],
                        'username' => $input['name'],
                        'telegram' => $input['telegram'],
                        'status' => 'activo',
                        'balance' => 0,
                        'email' => $input['email'],
                        'password' => Hash::make($input['password']),
                        'points_positive' => 0,
                        'points_negative' => 0,
                        'points_neutral' => 0,
                        'nacionalidad' => 'Venezolana',
                    ])->assignRole('Inactivo');*/

                

        }

        else{


             /*   return User::create([
                    'username' => $input['name'],
                    'telegram' => $input['telegram'],
                    'status' => 'activo',
                    'balance' => 0,
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'points_positive' => 0,
                    'points_negative' => 0,
                    'points_neutral' => 0,
                    'nacionalidad' => 'Extranjera',                
                ])->assignRole('Inactivo');*/

        }
    }
}
