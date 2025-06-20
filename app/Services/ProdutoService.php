<?php

namespace App\Services;

use App\DTOs\FiltrosListaDTO;
use App\Repositories\ProdutoRepository;
use Illuminate\Support\Facades\Cache;

class ProdutoService
{
    public function __construct(
        protected ProdutoRepository $produtoRepository
    ) {}

    public function buscarComFiltros(FiltrosListaDTO $filtros, int $page = 1)
    {
        $cacheKey = $this->gerarCacheKey($filtros, $page);

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($filtros) {
            return $this->produtoRepository->buscar($filtros);
        });
    }

    private function gerarCacheKey(FiltrosListaDTO $filtros, int $page): string
    {
        return 'produtos_' . md5(json_encode([
            'nome' => $filtros->nome,
            'categorias' => $filtros->categorias,
            'marcas' => $filtros->marcas,
            'pagina' => $page,
        ]));
    }
}
