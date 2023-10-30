<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medico;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medico::create([
            'nombre' => 'Pedro Roca',
            'ci' => '01045677',
            'telefono' => '072255181',
            'email' => 'medico@gmail.com',
            'direccion' => 'centro',

        ]);

        Medico::create([
            'nombre' => 'Maria Ruflo',
            'ci' => '01045677',
            'telefono' => '072255181',
            'email' => 'maria@gmail.com',
            'direccion' => 'centro',

        ]);


    }
}
