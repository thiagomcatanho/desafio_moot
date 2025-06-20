<?php

namespace App\Repositories;

use App\DTOs\FiltrosListaDTO;
use App\Models\Produto;

class ProdutoRepository
{
    public function buscar(FiltrosListaDTO $filtros, int $porPagina = 10)
    {
        return Produto::query()
            ->with(['marca', 'categoria'])
            ->when($filtros->nome, fn($q) =>
                $q->whereRaw('lower(nome) LIKE ?', ["%" . strtolower($filtros->nome) . "%"]))
            ->when($filtros->categorias, fn($q) =>
                $q->whereIn('categoria_id', $filtros->categorias))
            ->when($filtros->marcas, fn($q) =>
                $q->whereIn('marca_id', $filtros->marcas))
            ->paginate($porPagina);
    }
}
