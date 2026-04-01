@extends('layouts.app')

@section('title', 'Cadastrar Aluno')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 hidden md:flex flex-col">
        <div class="p-6">
            <div class="flex items-center gap-2 font-bold text-xl text-indigo-600">
                🎓 Sistema de Alunos
            </div>
        </div>
        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 text-slate-600 hover:bg-slate-100 rounded-lg transition">
                Dashboard
            </a>
            <a href="{{ route('alunos.index') }}" class="flex items-center gap-3 p-3 bg-indigo-50 text-indigo-700 rounded-lg font-medium">
                Alunos
            </a>
        </nav>
        <div class="p-4 border-t border-slate-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="flex items-center gap-3 p-3 text-red-500 hover:bg-red-50 w-full rounded-lg transition">
                    Sair
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <main class="flex-1 overflow-y-auto">
        <header class="bg-white border-b border-slate-200 py-4 px-8 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-slate-800">Cadastrar Novo Aluno</h1>
            <div class="h-8 w-8 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center font-bold">
                {{ auth()->user()->name[0] ?? 'U' }}
            </div>
        </header>

        <div class="p-8">
            <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
                
                <form action="{{ route('alunos.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nome -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nome</label>
                        <input type="text" name="nome" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-indigo-500"
                            value="{{ old('nome') }}">
                        @error('nome')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Telefone -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Telefone</label>
                        <input type="text" name="telefone"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200"
                            value="{{ old('telefone') }}">
                        @error('telefone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Data de Nascimento -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Data de Nascimento</label>
                        <input type="date" name="data_nascimento"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200"
                            value="{{ old('data_nascimento') }}">
                        @error('data_nascimento')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Curso -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Curso</label>
                        <input type="text" name="curso" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200"
                            value="{{ old('curso') }}">
                        @error('curso')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Matrícula -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Matrícula</label>
                        <input type="text" name="matricula" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200"
                            value="{{ old('matricula') }}">
                        @error('matricula')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botões -->
                    <div class="flex justify-end">
                        <a href="{{ route('alunos.index') }}"
                           class="px-6 py-3 border rounded-xl text-slate-600 mr-3">
                           Cancelar
                        </a>

                        <button type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
                            Cadastrar Aluno
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </main>
</div>
@endsection