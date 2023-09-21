<?php

namespace Database\Seeders;

use App\Models\Procedimiento;
use Illuminate\Database\Seeder;

class ProcedimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        Procedimiento::create([
            'nombre' => 'NA',
            'precio' => 0.00
        ]);
        //2
        Procedimiento::create([
            'nombre' => 'Ortodoncia Normal',
            'precio' => 800
        ]);
        //3
        Procedimiento::create([
            'nombre' => 'Ortodoncia Descuento',
            'precio' => 500
        ]);

    }
}
