<?php

namespace Database\Seeders;

use App\Models\Equipo;
use Illuminate\Database\Seeder;

class EquipoSeeder extends Seeder
{

    public function run()
    {
        $aux = 0;
        for ($i = 1; $i < 4; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $aux++;
                $rand = rand(100,300);
                Equipo::create([
                    'nombre' => 'Equipo' . $aux . '_#' . $rand,
                    'marca_id' => $i,
                    'modelo_id' => $aux,
                    'categoria_id' => rand(1,2),
                    'descripcion' => 'Descripcion para el equipo' . '_#' . $rand,
                    'fecha_compra' => now()
                ]);
            }
        }
    }
}
