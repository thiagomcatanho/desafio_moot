<?php

namespace Tests\Feature;

use App\Livewire\Produtos\Lista;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ListaProdutoTest extends TestCase
{
    use RefreshDatabase;

    public function test_lista_carrega_com_sucesso()
    {
        Produto::factory()->count(5)->create();

        $this->get('/produtos')
            ->assertStatus(200)
            ->assertSee('Lista de Produtos');
    }

    public function test_filtro_por_nome()
    {
        Produto::factory()->create(['nome' => 'Café Especial']);
        Produto::factory()->create(['nome' => 'Leite']);

        Livewire::test(Lista::class)
            ->set('filtroNome', 'Café')
            ->call('aplicarFiltros')
            ->assertSee('Café Especial')
            ->assertDontSee('Leite');
    }

    public function test_filtro_por_categoria_e_marca()
    {
        $categoriaA = Categoria::factory()->create(['nome' => 'Bebidas']);
        $categoriaB = Categoria::factory()->create(['nome' => 'Alimentos']);

        $marcaA = Marca::factory()->create(['nome' => 'Nestlé']);
        $marcaB = Marca::factory()->create(['nome' => '3 Corações']);

        Produto::factory()->create([
            'nome' => 'Produto A',
            'categoria_id' => $categoriaA->id,
            'marca_id' => $marcaA->id,
        ]);

        Produto::factory()->create([
            'nome' => 'Produto B',
            'categoria_id' => $categoriaB->id,
            'marca_id' => $marcaB->id,
        ]);

        Livewire::test(Lista::class)
            ->set('filtroCategorias', [$categoriaA->id])
            ->set('filtroMarcas', [$marcaA->id])
            ->call('aplicarFiltros')
            ->assertSee('Produto A')
            ->assertDontSee('Produto B');
    }
}
