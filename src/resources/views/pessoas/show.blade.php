<x-page-shell title="{{ $pessoa->nome }}">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <x-alert />
        <p class="text-gray-600">Idade: {{ $pessoa->idade }}</p>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="font-semibold text-gray-800 mb-4">Telefones</h3>

        <ul class="divide-y divide-gray-200 mb-6">
            @foreach ($pessoa->telefones as $telefone)
                <li class="flex items-center justify-between py-2">
                    <span class="text-gray-700">{{ $telefone->numero }}</span>

                    <div class="flex gap-4 items-center">
                        <x-link-button href="{{ route('telefones.edit', $telefone) }}">Editar</x-link-button>

                        <form action="{{ route('telefones.destroy', $telefone) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button onclick="return confirm('Deseja realmente excluir o telefone?')">
                                Excluir
                            </x-danger-button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <form action="{{ route('pessoas.telefones.store', $pessoa) }}" method="POST" class="flex gap-3">
            @csrf
            <input
                type="text"
                name="numero"
                placeholder="Novo telefone"
                class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
            <x-secondary-button type="submit">Adicionar</x-secondary-button>
        </form>
    </div>

    <x-link-button href="{{ route('pessoas.index') }}">Voltar</x-link-button>

</x-page-shell>