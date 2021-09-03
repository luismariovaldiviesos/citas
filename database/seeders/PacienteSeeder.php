<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paciente::create([
            'nombre' => 'paciente 0',
            'ci' => '0104649841',
            'telefono' => '072255181',
            'email' => 'paciente0@gmail.com',
            'image' => '',
            'direccion' => 'centro',
            'enfermedad' => "",
            'medicamentos' => "",
            'alergias' => "",
        ]);

        Paciente::create([
            'nombre' => 'paciente 1',
            'ci' => '0104649842',
            'telefono' => '072255181',
            'email' => 'paciente1@gmail.com',
            'image' => '',
            'direccion' => 'centro',
            'enfermedad' => "",
            'medicamentos' => "",
            'alergias' => "",
        ]);

        Paciente::create([
            'nombre' => 'paciente 2',
            'ci' => '0104649844',
            'telefono' => '072255181',
            'email' => 'paciente2@gmail.com',
            'image' => '',
            'direccion' => 'centro',
            'enfermedad' => "",
            'medicamentos' => "",
            'alergias' => "",
        ]);
    }
}
