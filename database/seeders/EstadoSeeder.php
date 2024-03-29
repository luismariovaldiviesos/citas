<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;


class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
            'nombre' => 'PENDIENTE'
        ]);

        Estado::create([
            'nombre' => 'EN PROCESO'
        ]);
        Estado::create([
            'nombre' => 'FINALIZADO'
        ]);

    }
}
