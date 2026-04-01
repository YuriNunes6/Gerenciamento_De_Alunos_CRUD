@extends('layouts.app')

@section('title', 'Alunos')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col">
        <div class="p-6">
            <div class="font-bold text-xl text-indigo-600">
                🎓 Sistema de Alunos
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 p-3 text-slate-600 hover:bg-slate-100 rounded-lg">
                Dashboard
            </a>

            <a href="{{ route('alunos.index') }}"
               class="flex items-center gap-3 p-3 bg-indigo-50 text-indigo-700 rounded-lg font-medium">
                Alunos
            </a>
        </nav>

        <div class="p-4 border-t border-slate-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left p-3 text-red-500 hover:bg-red-50 rounded-lg">
                    Sair
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <main class="flex-1 overflow-y-auto p-8">

        <!-- Topo -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-slate-800">Alunos</h1>

            <a href="{{ route('alunos.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm">
                Novo Aluno
            </a>
        </div>

        <!-- Busca -->
        <form method="GET" action="{{ route('alunos.index') }}" class="mb-4">
            <input type="text" name="search" placeholder="Buscar por nome..."
                   value="{{ request('search') }}"
                   class="w-full md:w-1/3 px-4 py-2 border rounded-lg">
        </form>

        <!-- Tabela -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-4">Nome</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Curso</th>
                        <th class="px-6 py-4">Matrícula</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($alunos as $aluno)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium text-slate-700">
                            {{ $aluno->nome }}
                        </td>

                        <td class="px-6 py-4 text-slate-500 text-sm">
                            {{ $aluno->email }}
                        </td>

                        <td class="px-6 py-4 text-slate-500 text-sm">
                            {{ $aluno->curso }}
                        </td>

                        <td class="px-6 py-4 text-slate-500 text-sm">
                            {{ $aluno->matricula }}
                        </td>

                        <td class="px-6 py-4 text-right space-x-2">

                            <!-- Editar -->
                            <a href="{{ route('alunos.edit', $aluno->id) }}"
                               class="text-slate-400 hover:text-indigo-600">
                                ✏️
                            </a>

                            <!-- Excluir -->
                            <form action="{{ route('alunos.destroy', $aluno->id) }}"
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-slate-400 hover:text-red-600">
                                    🗑️
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5"
                            class="px-6 py-4 text-center text-slate-400">
                            Nenhum aluno cadastrado.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</div>
@endsection