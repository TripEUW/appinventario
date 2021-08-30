<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{

    public function run()
    {
        for ($i=0; $i < 3; $i++) { 
            Marca::create([
                'nombre' => 'Marca' . $i
            ]);
        }
    }
}
