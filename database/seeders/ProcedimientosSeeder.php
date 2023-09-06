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
        Procedimiento::create([
            'nombre' => 'sin procedimiento',
            'precio' => 0.00
        ]);

    }
}
