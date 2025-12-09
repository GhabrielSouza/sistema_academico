@php
    $disciplinaWithError = old('disciplina_id_error');
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Disciplinas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Disciplinas</h2>
                        <p class="mt-1 text-sm text-gray-600">Gerencie as disciplinas do sistema</p>
                    </div>
                    <button x-data="" x-on:click="$dispatch('open-modal', 'create-disciplina')"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Nova Disciplina
                    </button>
                </div>

                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Disciplina
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Descrição
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Status
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Ações</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($disciplinas as $disciplina)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <div
                                                    class="h-10 w-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                                    <span class="text-white font-bold text-sm">
                                                        {{ substr($disciplina->nome, 0, 2) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">{{ $disciplina->nome }}</div>
                                                <div class="text-gray-500 text-xs">ID: {{ $disciplina->id }}</div>
                                                <div class="text-gray-500 text-xs">Criada em:
                                                    {{ $disciplina->created_at ? date('d/m/Y', strtotime($disciplina->created_at)) : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4 text-sm text-gray-500">
                                        <div class="max-w-xs">
                                            @if($disciplina->descricao)
                                                {{ $disciplina->descricao }}
                                            @else
                                                <span class="text-gray-400 italic">Sem descrição</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor"
                                                viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3"></circle>
                                            </svg>
                                            Ativa
                                        </span>
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <div class="flex justify-end space-x-3">
                                            <button class="text-indigo-600 hover:text-indigo-900" title="Editar" x-data=""
                                                x-on:click="$dispatch('open-modal', 'edit-disciplina-{{ $disciplina->id }}')">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <button class="text-red-600 hover:text-red-900" title="Excluir" x-data=""
                                                x-on:click="$dispatch('open-modal', 'delete-disciplina-{{ $disciplina->id }}')">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($disciplinas->isEmpty())
                        <div class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma disciplina cadastrada</h3>
                            <p class="mt-1 text-sm text-gray-500">Adicione sua primeira disciplina.</p>
                            <div class="mt-6">
                                <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'create-disciplina')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Nova Disciplina
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="bg-gray-50 px-4 py-3 border-t border-gray-200 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 flex justify-between sm:hidden">
                                    <a href="#"
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Anterior
                                    </a>
                                    <a href="#"
                                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Próxima
                                    </a>
                                </div>
                                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm text-gray-700">
                                            Mostrando
                                            <span class="font-medium">1</span>
                                            a
                                            <span class="font-medium">{{ count($disciplinas) }}</span>
                                            de
                                            <span class="font-medium">{{ count($disciplinas) }}</span>
                                            disciplinas
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-gray-500">
                                            Total:
                                            <span class="font-medium text-gray-900">{{ count($disciplinas) }}</span>
                                        </span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor"
                                                viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3"></circle>
                                            </svg>
                                            Ativas: {{ count($disciplinas) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- MODAIS (FORA DA TABELA) -->

    <!-- Modal de criação -->
    <x-modal name="create-disciplina" :show="$disciplinaWithError == $disciplina->id && $errors->criarDisciplina->any()" focusable>
        <form method="post" action="{{ route('disciplinas.store') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Cadastrar Disciplina') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="nome" value="{{ __('Nome') }}" />

                <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-3/4"
                    placeholder="{{ __('Digite o nome da disciplina') }}" value="{{ old('nome') }}" />

                <x-input-error :messages="$errors->criarDisciplina->get('nome')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="descricao" value="{{ __('Descrição') }}" />

                <textarea id="descricao" name="descricao" rows="3"
                    class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="{{ __('Digite a descrição da disciplina') }}">{{ old('descricao') }}</textarea>

                <x-input-error :messages="$errors->criarDisciplina->get('descricao')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button type="button" x-on:click="$dispatch('close');">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Salvar') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <!-- Modais dinâmicos para cada disciplina -->
    @foreach ($disciplinas as $disciplina)
        <!-- Modal de atualizar disciplina -->
        <x-modal name="edit-disciplina-{{ $disciplina->id }}" :show="$disciplinaWithError == $disciplina->id && $errors->atualizarDisciplina->any()" focusable>
            <form method="post" action="{{ route('disciplinas.update', $disciplina->id) }}" class="p-6">
                @csrf
                @method('put')

                <input type="hidden" name="disciplina_id_error" value="{{ $disciplina->id }}">


                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Editar Disciplina') }}
                </h2>

                <div class="mt-6">
                    <x-input-label for="nome" value="{{ __('Nome') }}" />

                    <x-text-input id="nome" name="nome" type="text" class="mt-1 block w-3/4"
                        placeholder="{{ __('Digite o nome da disciplina') }}"
                        value="{{ old('nome', $disciplina->nome) }}" />

                    <x-input-error :messages="$errors->atualizarDisciplina->get('nome')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="descricao" value="{{ __('Descrição') }}" />

                    <textarea id="descricao" name="descricao" rows="3"
                        class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="{{ __('Digite a descrição da disciplina') }}">{{ old('descricao', $disciplina->descricao) }}</textarea>

                    <x-input-error :messages="$errors->atualizarDisciplina->get('descricao')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button type="button" x-on:click="window.location.href = '{{ route('clear.session') }}';$dispatch('close');">
                        {{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        {{ __('Salvar') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

        <!-- Modal de excluir disciplina -->
        <x-modal name="delete-disciplina-{{ $disciplina->id }}" focusable>
            <form method="post" action="{{ route('disciplinas.destroy', $disciplina->id) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Tem certeza que deseja excluir esta disciplina?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Esta ação não pode ser desfeita. Todos os dados desta disciplina serão permanentemente removidos.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button type="button" x-on:click="$dispatch('close')">
                        {{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Excluir Disciplina') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endforeach
</x-app-layout>