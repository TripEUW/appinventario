<?php

namespace Database\Seeders;

use App\Models\CentroTrabajo;
use Illuminate\Database\Seeder;

class CentroTrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 4; $i++) {
            CentroTrabajo::create([
                'nombre' => 'Centro' . $i,
                'direccion' => 'Direccion del Centro' . $i
            ]);
        }
    }
}
