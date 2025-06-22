# 🛒 Laravel Produtos - Filtros com Livewire e GraphQL

Este projeto é uma aplicação de catálogo de produtos desenvolvida com **Laravel 10**, **Livewire 3**, **Tailwind CSS**, **PostgreSQL** e **Docker**.  
A interface permite filtrar produtos por nome, categoria(s) e marca(s), com suporte à paginação reativa, cache de resultados e testes automatizados.

---

## 🚀 Tecnologias Utilizadas

- Laravel 10
- Livewire 3
- Tailwind CSS
- PostgreSQL
- Docker + Docker Compose
- PHPUnit

---

## ⚙️ Configuração do Ambiente

> Requisitos: Docker e Docker Compose instalados.

### 1. Clone o repositório

```bash
git clone https://github.com/thiagomcatanho/desafio_moot.git
cd desafio_moot
```

### 2. Copie o arquivo `.env` de exemplo

```bash
cp .env.example .env
```

E verifique se essas variáveis estão configuradas corretamente:

```env
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=postgres
DB_PASSWORD=secret
```

### 3. Suba os containers com Docker

```bash
docker-compose up -d --build
```

A aplicação estará disponível em `http://localhost:8080`.

### 4. Instale dependências

```bash
docker exec -it laravel_app composer install
docker exec -it laravel_app npm install && npm run dev
```

### 5. Rode as migrations e seeds

```bash
docker exec -it laravel_app php artisan migrate --seed
```

---

## 🧪 Executando os Testes

O projeto inclui testes de feature e unitários. Eles são executados usando **SQLite em memória**.

```bash
docker exec -it laravel_app php artisan test
```

## ✅ Funcionalidades

- Filtro por nome do produto
- Filtros múltiplos por categoria(s) e marca(s)
- Filtros persistentes com URL e Livewire
- Paginação reativa
- Carregamento com `wire:loading` no lugar da tabela
- Resultados em cache com `Illuminate\Support\Facades\Cache`
- Componentização com Livewire
- Testes automatizados

---
