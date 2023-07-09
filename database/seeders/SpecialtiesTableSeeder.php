<?php

namespace Database\Seeders;

use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [

            'Cavitacion',
            'Carboxiteriapia',
            'Dermapen',
            'Lipolaser',
            'Terapia neural',
        ];

        foreach ($specialties as $specialtyName) {

            $specialty = Specialty::create(
                [
                    'specialtyName' => $specialtyName
                ]
            );
            $specialty->users()->saveMany(
                User::factory(4)->state(['role' => 'doctor'])->make()
            );
        }

        User::find(3)->specialties()->save($specialty);
    }
}
