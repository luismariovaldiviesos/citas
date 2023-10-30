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
            'nombre' => 'Juan Perez',
            'ci' => '0104649841',
            'telefono' => '072255181',
            'email' => 'juan@gmail.com',
            'image' => '',
            'direccion' => 'centro',
            'enfermedad' => "",
            'medicamentos' => "",
            'alergias' => "",
        ]);

        Paciente::create([
            'nombre' => 'Pedro Paramo',
            'ci' => '0104649842',
            'telefono' => '072255181',
            'email' => 'pedro@gmail.com',
            'image' => '',
            'direccion' => 'centro',
            'enfermedad' => "",
            'medicamentos' => "",
            'alergias' => "",
        ]);

        Paciente::create([
            'nombre' => 'Julio Verne',
            'ci' => '0104649844',
            'telefono' => '072255181',
            'email' => 'julio@gmail.com',
            'image' => '',
            'direccion' => 'centro',
            'enfermedad' => "",
            'medicamentos' => "",
            'alergias' => "",
        ]);
    }
}
