<x-page-layout title="Gerenciar Pessoas">

    <x-alert />

    <form action="{{ route('gerenciar-pessoas.salvar') }}" method="POST">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Pessoa
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Proprietário
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($pessoas as $pessoa)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">
                                {{ $pessoa->nome }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select
                                name="usuarios[{{ $pessoa->id }}]" id=""
                                class="border-gray-300 rounded-md shadow-sm">
                                @foreach ($usuarios as $usuario)
                                <option
                                    value="{{ $usuario->id }}"
                                    @selected($usuario->id == $pessoa->user_id)
                                    >
                                    {{ $usuario->name }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ ucfirst($pessoa->status) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-end">
            <x-primary-button>
                Salvar
            </x-primary-button>
        </div>
    </form>
</x-page-layout>