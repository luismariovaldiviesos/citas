<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Especialidad::create([
            'nombre' => 'ortodoncista'
        ]);

        Especialidad::create([
            'nombre' => 'Ortodoncia'
        ]);
        Especialidad::create([
            'nombre' => 'Cirugía e Implantología'
        ]);
        Especialidad::create([
            'nombre' => 'Endodoncia'
        ]);
        Especialidad::create([
            'nombre' => 'Periodoncia'
        ]);

        Especialidad::create([
            'nombre' => 'Odontopediatría'
        ]);
        Especialidad::create([
            'nombre' => 'Rehabilitación Oral.'
        ]);




    }
}
