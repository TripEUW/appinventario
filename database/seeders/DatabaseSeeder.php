<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Crear los roles y permisos en la bd
        $this->call(RoleSeeder::class);

        $this->call(CentroTrabajoSeeder::class);
          
        $this->call(UserSeeder::class);

        $this->call(CategorySeeder::class);
        
        $this->call(MarcaSeeder::class);

        $this->call(ModeloSeeder::class);

        $this->call(EquipoSeeder::class);

    }
}
