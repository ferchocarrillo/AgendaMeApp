<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {


        User::create(
            [
                'name' => 'Fernando Carrillo',
                'email' => 'fercho.carrillo@hotmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('123456789'), // password
                'cedula' => '79760755',
                'address' => 'tv 85g # 24c 50',
                'phone' => '3187200092',
                'role' => 'admin',
            ]
        );
        User::create(
            [
                'name' => 'Paciente1',
                'email' => 'paciente@paciente.com',
                'email_verified_at' => now(),
                'password' => bcrypt('123456789'), // password
                'role' => 'paciente',
            ]
        );
        User::create(
            [
                'name' => 'Medico1',
                'email' => 'medico@medico.com',
                'email_verified_at' => now(),
                'password' => bcrypt('123456789'), // password
                'role' => 'doctor',
            ]
        );
        User::factory()
        ->count(50)
        ->state(['role'=> 'paciente'])
        ->create();
    }
}
