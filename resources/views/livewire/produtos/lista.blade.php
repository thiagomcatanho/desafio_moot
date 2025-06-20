<div class="p-6 space-y-6">

    <div class="bg-white shadow-lg rounded-xl p-6 space-y-6">

        <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
            🔍 Filtros de Pesquisa
        </h2>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Buscar produto</label>
            <input type="text" wire:model.defer="filtroNome" placeholder="Digite o nome do produto"
                class="w-full border border-gray-300 px-4 py-2 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-300 focus:outline-none transition" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-semibold text-gray-600 mb-2">Categorias</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($categorias as $categoria)
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" wire:model.defer="filtroCategorias" value="{{ $categoria->id }}"
                                class="rounded text-blue-600 focus:ring-blue-500">
                            {{ $categoria->nome }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <p class="text-sm font-semibold text-gray-600 mb-2">Marcas</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($marcas as $marca)
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" wire:model.defer="filtroMarcas" value="{{ $marca->id }}"
                                class="rounded text-blue-600 focus:ring-blue-500">
                            {{ $marca->nome }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 pt-2">
            <button wire:click="aplicarFiltros" wire:loading.remove wire:target="aplicarFiltros"
                class="px-4 py-2 text-sm font-medium bg-sky-600 hover:bg-sky-700 rounded-md text-white shadow transition">
                Aplicar filtros
            </button>

            <div wire:loading wire:target="aplicarFiltros" class="text-blue-600 text-sm">
                <svg class="animate-spin h-5 w-5 mr-2 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                </svg>
                Aplicando filtros...
            </div>

            <button wire:click="limparFiltros"
                class="px-4 py-2 text-sm font-medium bg-gray-500 hover:bg-gray-600 rounded-md text-white shadow transition">
                Limpar filtros
            </button>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-xl p-6" wire:loading.remove wire:target="aplicarFiltros">
        @if ($produtos->count())
            <div class="overflow-x-auto">
                <table class="w-full table-auto text-left text-sm text-gray-700 border-collapse">
                    <thead class="text-xs uppercase bg-gray-100 text-gray-600">
                        <tr>
                            <th class="px-4 py-2">Nome</th>
                            <th class="px-4 py-2">Marca</th>
                            <th class="px-4 py-2">Categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $produto->nome }}</td>
                                <td class="px-4 py-2">{{ $produto->marca->nome }}</td>
                                <td class="px-4 py-2">{{ $produto->categoria->nome }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $produtos->links() }}
            </div>
        @else
            <p class="text-center text-gray-500 py-6">Nenhum produto encontrado.</p>
        @endif

    </div>
</div>
