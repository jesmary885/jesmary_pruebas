<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jesus Mata',
            'email' => 'adminjesus@admin.com',
            'password' => bcrypt('12345678'),
            'username' => 'Jesus Mata',
            'balance' => '10',
            'status' => 'activo',
            'plan' => '30'
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Erik Rojas',
            'email' => 'adminerik@admin.com',
            'password' => bcrypt('12345678'),
            'username' => 'Erik Rojas',
            'balance' => '10',
            'status' => 'activo',
            'plan' => '30'
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Norberto Guerra',
            'email' => 'adminnorberto@admin.com',
            'password' => bcrypt('12345678'),
            'username' => 'Norberto Guerra',
            'balance' => '10',
            'status' => 'activo',
            'plan' => '30'
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Angel Maza',
            'email' => 'adminangel@admin.com',
            'password' => bcrypt('12345678'),
            'username' => 'Angel Maza',
            'balance' => '10',
            'status' => 'activo',
            'plan' => '30'
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Jesmary Carneiro',
            'email' => 'adminjesmary@admin.com',
            'password' => bcrypt('12345678'),
            'username' => 'Jesmary Carneiro',
            'balance' => '10',
            'status' => 'activo',
            'plan' => '30'
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Usuario1',
            'email' => 'usuario1@usuario1.com',
            'password' => bcrypt('12345678'),
            'username' => 'Usuario1',
            'balance' => '10',
            'status' => 'activo',
            'plan' => '30'
        ])->assignRole('Encuestador');

        User::create([
            'name' => 'Usuario2',
            'email' => 'usuario2@usuario2.com',
            'password' => bcrypt('12345678'),
            'username' => 'Usuario2',
            'balance' => '10',
            'status' => 'activo',
            'plan' => '30'
        ])->assignRole('Encuestador');

        User::create([
            'name' => 'Usuario3',
            'email' => 'usuario3@usuario3.com',
            'password' => bcrypt('12345678'),
            'username' => 'Usuario3',
            'balance' => '10',
            'status' => 'activo',
            'plan' => '30'
        ])->assignRole('Vendedor');

        User::create([
            'name' => 'Usuario4',
            'email' => 'usuario4@usuario4.com',
            'password' => bcrypt('12345678'),
            'username' => 'Usuario4',
            'balance' => '10',
            'status' => 'activo',
            'plan' => '30'
        ])->assignRole('Vendedor');

    }
}
