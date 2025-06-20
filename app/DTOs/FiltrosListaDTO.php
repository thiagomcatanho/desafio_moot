<?php

namespace App\DTOs;

class FiltrosListaDTO
{
    public function __construct(
        public readonly string $nome = '',
        public readonly array $categorias = [],
        public readonly array $marcas = []
    ) {}
}
