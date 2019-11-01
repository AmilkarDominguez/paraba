<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        $rol_admin = App\Role::create([
            'name' => 'ADMINISTRADOR',
            'description' => 'Rol Administrador.'
        ]);
        App\Role::create([
            'name' => 'ESTANDAR',
            'description' => 'Rol Estandar.'
        ]);

        $Admin = App\User::create([
            'name' => 'admin',
            'email'=> 'admin@admin.com',
            'state' => 'ACTIVO',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10), 
                  
        ]);
        $Admin->roles()->attach($rol_admin); 
    }
}
