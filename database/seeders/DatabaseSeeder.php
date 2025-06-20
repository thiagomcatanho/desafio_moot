<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $marcas = Marca::factory(10)->create();
        $categorias = Categoria::factory(5)->create();

        Produto::factory(50)->create([
            'marca_id' => fn() => $marcas->random()->id,
            'categoria_id' => fn() => $categorias->random()->id,
        ]);
    }
}
