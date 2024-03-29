<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tratamiento;

class TratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Tratamiento::create([
            'nombre' => 'blanqueamiento',
            'precio' => 20.00,
            'procedimiento_id' => 1
        ]);

        Tratamiento::create([
            'nombre' => 'calza',
            'precio' => 30.00,
            'procedimiento_id' => 1
        ]);

        Tratamiento::create([
            'nombre' => 'extraccion',
            'precio' => 15.00,
            'procedimiento_id' => 1
        ]);

        Tratamiento::create([
            'nombre' => 'diagnostico',
            'precio' => 20.00,
            'procedimiento_id' => 1
        ]);
        Tratamiento::create([
            'nombre' => 'Activacion normal',
            'precio' => 20.00,
            'procedimiento_id' => 2
        ]);
        Tratamiento::create([
            'nombre' => 'Activacion descuento',
            'precio' => 10.00,
            'procedimiento_id' => 3
        ]);

    }
}
