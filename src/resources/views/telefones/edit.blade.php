<x-page-layout title="Editar Telefone">
    <form action="{{ route('telefones.update', $telefone) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <input
                type="text"
                name="numero"
                value="{{ old('numero', $telefone->numero) }}"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
            @error('numero')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
            <select name="tipo" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="celular" {{ old('tipo', $telefone->tipo) === 'celular' ? 'selected' : '' }}>Celular</option>
                <option value="residencial" {{ old('tipo', $telefone->tipo) === 'residencial' ? 'selected' : '' }}>Residencial</option>
                <option value="comercial" {{ old('tipo', $telefone->tipo) === 'comercial' ? 'selected' : '' }}>Comercial</option>
            </select>
            @error('tipo')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex gap-3">
            <x-secondary-button type="submit">Atualizar</x-secondary-button>
            <x-link-button href="{{ route('pessoas.show', $telefone->pessoa) }}">Cancelar</x-link-button>
        </div>
    </form>
</x-page-layout>