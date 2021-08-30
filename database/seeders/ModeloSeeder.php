<?php

namespace Database\Seeders;

use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Database\Seeder;

class ModeloSeeder extends Seeder
{

    public function run()
    {
        $aux = 0;
        for ($i = 1; $i < 4; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $aux++;
                Modelo::create([
                    'nombre' => 'Modelo' . $aux,
                    'marca_id' => $i
                ]);
            }
        }
    }
}
