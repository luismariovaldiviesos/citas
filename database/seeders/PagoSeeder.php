<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pago;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pago::create([
            'nombre' => 'PAGADO'
        ]);

        Pago::create([
            'nombre' => 'PENDIENTE'
        ]);

    }
}
