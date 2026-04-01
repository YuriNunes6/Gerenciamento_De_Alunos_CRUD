@extends('layouts.app')

@section('title', 'Editar Aluno')

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
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 text-slate-600 hover:bg-slate-100 rounded-lg">
                Dashboard
            </a>
            <a href="{{ route('alunos.index') }}" class="flex items-center gap-3 p-3 bg-indigo-50 text-indigo-700 rounded-lg font-medium">
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

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        <header class="bg-white border-b border-slate-200 py-4 px-8 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-slate-800">Editar Aluno</h1>
        </header>

        <div class="p-8 max-w-3xl mx-auto">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
                <form action="{{ route('alunos.update', $aluno->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nome -->
                    <div>
                        <label for="nome" class="block text-sm font-medium text-slate-700 mb-1">Nome</label>
                        <input type="text" id="nome" name="nome" value="{{ old('nome', $aluno->nome) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $aluno->email) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    </div>

                    <!-- Curso -->
                    <div>
                        <label for="curso" class="block text-sm font-medium text-slate-700 mb-1">Curso</label>
                        <input type="text" id="curso" name="curso" value="{{ old('curso', $aluno->curso) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    </div>

                    <!-- Matrícula -->
                    <div>
                        <label for="matricula" class="block text-sm font-medium text-slate-700 mb-1">Matrícula</label>
                        <input type="text" id="matricula" name="matricula" value="{{ old('matricula', $aluno->matricula) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                    </div>

                    <div class="flex justify-end gap-3 mt-4">
                        <a href="{{ route('alunos.index') }}" class="px-6 py-3 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 transition">Cancelar</a>
                        <button type="submit" class="px-6 py-3 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection