<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Encuestador']);
        $role3 = Role::create(['name' => 'Vendedor']);
        $role4 = Role::create(['name' => 'Inactivo']);
        $role5 = Role::create(['name' => 'Comprador']);
        $role6 = Role::create(['name' => 'Vendedor y comprador']);

        //JUMPERS

       Permission::create(['name' => 'cint.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'internals.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'kmil.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name' => 'kmilnoventaydos.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'kdosmilsesentaydos.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'kveintitres.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'ksietemilcuarentayuno',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'prodege.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'scube.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'spectrum.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'toluna.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);
        Permission::create(['name' => 'ssidkr.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name' => 'marketplace.index',
        'description' => 'Ver Cints'])->syncRoles([$role1,$role2,$role3]);

        Permission::create(['name' => 'marketplace_compras.index',
        'description' => 'Ver Compras'])->syncRoles([$role1,$role2,$role3]);

        
        //Administración

        Permission::create(['name' => 'administracion_principal', //id21
        'description' => 'administracion_principal'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.sales',
        'description' => 'Ver ventas'])->syncRoles([$role1,$role3]);

        Permission::create(['name' => 'admin.users',
        'description' => 'Administrar usuarios'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.roles',
        'description' => 'Administrar roles y permisos'])->syncRoles([$role1,$role3,$role6]);

        Permission::create(['name' => 'admin.marketplace.compras', //id18
        'description' => 'Ver y editar marketplace'])->syncRoles([$role1,$role5,$role6]);

        Permission::create(['name' => 'admin.marketplace.ventas', //id21
        'description' => 'Ver y editar marketplace'])->syncRoles([$role1,$role3]);

        Permission::create(['name' => ' admin.ganancias.index',
        'description' => 'Ver mis ganancias'])->syncRoles([$role1,$role3]);

        Permission::create(['name' => 'cuenta.inactiva',
        'description' => 'Informar cuenta inactiva'])->syncRoles([$role4]);

        
    }
}
