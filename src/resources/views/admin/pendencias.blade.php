<x-page-layout title="Pendências">
    <x-alert />
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">
                        Pessoa
                    </th>

                    <th class="px-6 py-3 text-left">
                        Proprietário
                    </th>

                    <th class="px-6 py-3 text-left">
                        Status
                    </th>

                    <th class="px-6 py-3 text-left">
                        Ações
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($pessoas as $pessoa)

                <tr>
                    <td class="px-6 py-4">
                        {{ $pessoa->nome }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $pessoa->user->name }}
                    </td>

                    <td class="px-6 py-4">
                        @if($pessoa->status === 'pendente')
                        <span class="text-yellow-600 font-semibold">
                            Pendente
                        </span>
                        @elseif($pessoa->status === 'processando')
                        <span class="text-blue-600 font-semibold">
                            Processando
                        </span>
                        @elseif($pessoa->status === 'aprovado')
                        <span class="text-green-600 font-semibold">
                            Aprovado
                        </span>
                        @else
                        <span class="text-red-600 font-semibold">
                            Rejeitado
                        </span>
                        @endif
                    </td>
                    @if($pessoa->status === 'pendente')
                    <td class="px-6 py-4">
                        <div class="flex gap-2">

                            <form action="{{ route('pessoas.aprovar', $pessoa) }}" method="post">
                                @csrf
                                @method('PATCH')

                                <x-primary-button>
                                    Aprovar
                                </x-primary-button>
                            </form>

                            <form action="{{ route('pessoas.rejeitar', $pessoa) }}" method="post">
                                @csrf
                                @method('PATCH')

                                <x-danger-button>
                                    Rejeitar
                                </x-danger-button>
                            </form>

                        </div>
                    </td>
                    @endif
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>

</x-page-layout>