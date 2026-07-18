<x-page-layout title="Editar pessoa - {{ $pessoa->nome }}">
    <form action="{{ route('pessoas.update', $pessoa) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <x-forms.pessoa-form :pessoa="$pessoa" />

        <div class="flex gap-3 pt-4">
            <x-secondary-button type="submit">Atualizar</x-secondary-button>
            <x-link-button href="{{ route('pessoas.index') }}">Voltar</x-link-button>
        </div>
    </form>
</x-page-layout>