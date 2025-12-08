<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Notas</h2>
                        <p class="mt-1 text-sm text-gray-600">Gerencie as notas dos alunos</p>
                    </div>
                    @if(Auth::user()->role !== 'aluno')
                        <button x-data="" x-on:click="$dispatch('open-modal', 'confirm-user-create')"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Nova Nota
                        </button>
                    @endif
                </div>

                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Aluno
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Turma
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Nota
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Ações</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($notas as $nota)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                    <span class="text-indigo-800 font-bold text-sm">
                                                        {{ substr($nota->usuario->name, 0, 2) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">{{ $nota->usuario->name }}</div>
                                                <div class="text-gray-500 text-xs">ID: {{ $nota->usuario->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <div
                                                class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                                <span class="text-blue-800 text-xs font-bold">
                                                    {{ substr($nota->turma->nome, 0, 2) }}
                                                </span>
                                            </div>
                                            <div class="font-medium text-gray-900">{{ $nota->turma->nome }}</div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        <div class="flex items-center">
                                            <div class="mr-3">
                                                @if($nota->valor >= 70)
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                        {{ $nota->valor }}
                                                    </span>
                                                @elseif($nota->valor >= 50)
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                        {{ $nota->valor }}
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                        {{ $nota->valor }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="text-gray-500 text-xs">
                                                @if($nota->valor >= 70)
                                                    <span class="flex items-center">
                                                        <svg class="mr-1 h-3 w-3 text-green-500" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Aprovado
                                                    </span>
                                                @elseif($nota->valor >= 50)
                                                    <span class="flex items-center">
                                                        <svg class="mr-1 h-3 w-3 text-yellow-500" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Recuperação
                                                    </span>
                                                @else
                                                    <span class="flex items-center">
                                                        <svg class="mr-1 h-3 w-3 text-red-500" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Reprovado
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <div class="flex justify-end space-x-3">
                                            @if(Auth::user()->role !== 'aluno')
                                                <button class="text-indigo-600 hover:text-indigo-900" title="Editar" x-data=""
                                                    x-on:click="$dispatch('open-modal', 'confirm-user-update-{{ $nota->id }}')">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            @endif
                                            @if (Auth::user()->role !== 'aluno' && Auth::user()->role !== 'professor')
                                                <button class="text-red-600 hover:text-red-900" title="Excluir" x-data=""
                                                    x-on:click="$dispatch('open-modal', 'delete-modal-{{ $nota->id }}')">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($notas->isEmpty())
                        <div class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma nota cadastrada</h3>
                            @if(Auth::user()->role !== 'aluno')
                            <p class="mt-1 text-sm text-gray-500">Comece registrando a primeira nota.</p>
                            @endif
                            <div class="mt-6">
                                @if(Auth::user()->role !== 'aluno')
                                    <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'confirm-user-create')"
                                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Nova Nota
                                    </button>
                                @endif
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
                                            <span class="font-medium">{{ count($notas) }}</span>
                                            de
                                            <span class="font-medium">{{ count($notas) }}</span>
                                            resultados
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor"
                                                viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3"></circle>
                                            </svg>
                                            Aprovado: {{ $notas->where('valor', '>=', 70)->count() }}
                                        </span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor"
                                                viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3"></circle>
                                            </svg>
                                            Recuperação: {{ $notas->whereBetween('valor', [50, 69.99])->count() }}
                                        </span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3"></circle>
                                            </svg>
                                            Reprovado: {{ $notas->where('valor', '<', 50)->count() }}
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

    <!-- MODAIS (DEVEM ESTAR FORA DA TABELA) -->

    <!-- Modal de criação -->
    <x-modal name="confirm-user-create" :show="$errors->any()" focusable>
        <form method="post" action="{{ route('notas.store') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Inserir Notas') }}
            </h2>

            <div class="mt-6">
                <x-input-label for="valor" value="{{ __('Nota') }}" />

                <x-text-input id="valor" name="valor" type="number" min="0" max="100" step="0.01"
                    class="mt-1 block w-3/4" placeholder="{{ __('Valor') }}" value="{{ old('valor') }}" />

                <x-input-error :messages="$errors->get('valor')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="aluno_id" value="{{ __('Aluno') }}" />

                <select name="aluno_id" id="aluno_id"
                    class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">{{ __('Selecione um aluno') }}</option>
                    @foreach ($alunos as $aluno)
                        <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>
                            {{ $aluno->name }}
                        </option>
                    @endforeach
                </select>

                <x-input-error :messages="$errors->get('aluno_id')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="turma_id" value="{{ __('Turma') }}" />

                <select name="turma_id" id="turma_id"
                    class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">{{ __('Selecione uma turma') }}</option>
                    @foreach ($turmas as $turma)
                        <option value="{{ $turma->id }}" {{ old('turma_id') == $turma->id ? 'selected' : '' }}>
                            {{ $turma->nome }}
                        </option>
                    @endforeach
                </select>

                <x-input-error :messages="$errors->get('turma_id')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Salvar') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <!-- Modais dinâmicos para cada nota (fora da tabela) -->
    @foreach ($notas as $nota)
        <!-- Modal de atualizar nota -->
        <x-modal name="confirm-user-update-{{ $nota->id }}" :show="$errors->any()" focusable>
            <form method="post" action="{{ route('notas.update', $nota->id) }}" class="p-6">
                @csrf
                @method('put')
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Atualizar Nota') }}
                </h2>

                <div class="mt-6">
                    <x-input-label for="valor" value="{{ __('Nota') }}" />

                    <x-text-input id="valor" name="valor" type="number" min="0" max="100"
                        step="0.01" class="mt-1 block w-3/4" placeholder="{{ __('Valor') }}"
                        value="{{ old('valor', $nota->valor) }}" />

                    <x-input-error :messages="$errors->get('valor')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="aluno_id" value="{{ __('Aluno') }}" />

                    <select name="aluno_id" id="aluno_id"
                        class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">{{ __('Selecione um aluno') }}</option>
                        @foreach ($alunos as $aluno)
                            <option value="{{ $aluno->id }}" {{ old('aluno_id', $nota->aluno_id) == $aluno->id ? 'selected' : '' }}>
                                {{ $aluno->name }}
                            </option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('aluno_id')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-input-label for="turma_id" value="{{ __('Turma') }}" />

                    <select name="turma_id" id="turma_id"
                        class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">{{ __('Selecione uma turma') }}</option>
                        @foreach ($turmas as $turma)
                            <option value="{{ $turma->id }}" {{ old('turma_id', $nota->turma_id) == $turma->id ? 'selected' : '' }}>
                                {{ $turma->nome }}
                            </option>
                        @endforeach
                    </select>

                    <x-input-error :messages="$errors->get('turma_id')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button type="button" x-on:click="$dispatch('close')">
                        {{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-primary-button class="ms-3">
                        {{ __('Salvar') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

        <!-- Modal de excluir -->
        <x-modal name="delete-modal-{{ $nota->id }}" :show="$errors->any()" focusable>
            <form method="post" action="{{ route('notas.destroy', $nota->id) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Tem certeza que deseja excluir esta nota?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Esta ação não pode ser desfeita. Todos os dados desta nota serão permanentemente removidos.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button type="button" x-on:click="$dispatch('close')">
                        {{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Excluir Nota') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endforeach
</x-app-layout>
