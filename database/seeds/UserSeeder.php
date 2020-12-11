<?php

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
        DB::table('users')->insert([
            'name' => 'Mocte',
            'email' => 'correo@gmail.com',
            'password' => Hash::make('password'),
            'rol' => 'Administrador',
            'nombre' => 'Alejandro',
            'apellidos' => 'Moctezuma Luna',
        ]);
    }
}
