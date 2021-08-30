<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 2; $i++) { 
            Categoria::create([
                'nombre' => 'Categoria' . $i
            ]);
        }
    }
}
