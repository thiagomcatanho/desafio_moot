<?php

namespace App\Livewire\Produtos;

use App\DTOs\FiltrosListaDTO;
use App\Models\Categoria;
use App\Models\Marca;
use App\Services\ProdutoService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Lista de Produtos')]
class Lista extends Component
{
    use WithPagination;

    #[Url(as: 'nomeProduto')]
    public string $nomeProduto = '';

    #[Url(as: 'categoriasSelecionadas')]
    public array $categoriasSelecionadas = [];

    #[Url(as: 'marcasSelecionadas')]
    public array $marcasSelecionadas = [];

    public string $filtroNome = '';
    public array $filtroCategorias = [];
    public array $filtroMarcas = [];

    public function mount(): void
    {
        $this->filtroNome = $this->nomeProduto;
        $this->filtroCategorias = $this->categoriasSelecionadas;
        $this->filtroMarcas = $this->marcasSelecionadas;
    }

    public function aplicarFiltros(): void
    {
        $this->nomeProduto = $this->filtroNome;
        $this->categoriasSelecionadas = $this->filtroCategorias;
        $this->marcasSelecionadas = $this->filtroMarcas;

        $this->resetPage();
    }

    public function limparFiltros(): void
    {
        $this->reset([
            'filtroNome',
            'filtroCategorias',
            'filtroMarcas',
            'nomeProduto',
            'categoriasSelecionadas',
            'marcasSelecionadas',
        ]);

        $this->resetPage();
    }

    public function render(ProdutoService $produtoService)
    {
        $filtros = new FiltrosListaDTO(
            nome: $this->filtroNome,
            categorias: $this->filtroCategorias,
            marcas: $this->filtroMarcas
        );

        return view('livewire.produtos.lista', [
            'produtos' => $produtoService->buscarComFiltros($filtros, $this->getPage()),
            'categorias' => Categoria::all(),
            'marcas' => Marca::all(),
        ]);
    }
}
