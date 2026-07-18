<x-page-layout title="Lista de Pessoas">
    <x-alert />

    <x-link-button href="{{ route('pessoas.create') }}" class="mb-6">
        + Nova pessoa
        </x-primary-button>

        <ul class="divide-y divide-gray-200">
            @foreach ($pessoas as $pessoa)
                <li class="flex items-center justify-between py-3">
                    <span class="text-gray-800">
                        {{ $pessoa->nome }} ({{ $pessoa->idade }} anos)
                    </span>

                    <div class="flex gap-4 items-center">
                        <x-link-button href="{{ route('pessoas.show', $pessoa) }}">Ver detalhes</x-link-button>
                        @can('update', $pessoa)
                            <x-link-button href="{{ route('pessoas.edit', $pessoa) }}">Editar</x-link-button>
                        @endcan

                        @can('delete', $pessoa)
                            <form action="{{ route('pessoas.destroy', $pessoa) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-danger-button onclick="return confirm('Deseja realmente excluir?')">
                                    Excluir
                                </x-danger-button>
                            </form>
                        @endcan
                    </div>
                </li>
            @endforeach
        </ul>
</x-page-layout>