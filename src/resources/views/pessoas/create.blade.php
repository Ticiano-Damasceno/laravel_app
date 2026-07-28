<x-page-layout title="Inserir Pessoa">
    <form action="{{ route('pessoas.store') }}" method="POST" class="space-y-4">
        @csrf
        <x-forms.pessoa-form :usuarios="$usuarios" />

        <div class="flex gap-3 pt-4">
            <x-secondary-button type="submit">Salvar</x-secondary-button>
            <x-link-button href="{{ route('pessoas.index') }}">Voltar</x-link-button>
        </div>
    </form>
</x-page-layout>