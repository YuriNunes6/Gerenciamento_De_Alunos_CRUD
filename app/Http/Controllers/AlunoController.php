<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;

class AlunoController extends Controller
{
    /**
     * Listar todos os alunos do usuário logado.
     */
    public function index(Request $request)
    {
        $query = auth()->user()->alunos();

        if ($request->filled('search')) {
            $query->where('nome', 'like', '%' . $request->search . '%');
        }

        $alunos = $query->orderBy('nome')->get();

        return view('alunos.index', compact('alunos'));
    }

    /**
     * Formulário para criar um novo aluno.
     */
    public function create()
    {
        return view('alunos.create');
    }

    /**
     * Salvar novo aluno no banco.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos,email',
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
            'curso' => 'required|string|max:255',
            'matricula' => 'required|string|unique:alunos,matricula',
        ]);

        Aluno::create([
            'user_id' => auth()->id(),
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
            'curso' => $request->curso,
            'matricula' => $request->matricula,
        ]);

        return redirect()->route('alunos.index')
        ->with('success', 'Aluno cadastrado com sucesso!');
    }

    /**
     * Exibir detalhes de um aluno específico.
     */
    public function show(string $id)
    {
        $aluno = auth()->user()->alunos()->findOrFail($id);
        return view('alunos.show', compact('aluno'));
    }

    /**
     * Formulário para editar aluno.
     */
    public function edit(string $id)
    {
        $aluno = auth()->user()->alunos()->findOrFail($id);
        return view('alunos.edit', compact('aluno'));
    }

    /**
     * Atualizar aluno no banco.
     */
    public function update(Request $request, string $id)
    {
        $aluno = auth()->user()->alunos()->findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos,email,' . $aluno->id,
            'telefone' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
            'curso' => 'required|string|max:255',
            'matricula' => 'required|string|unique:alunos,matricula,' . $aluno->id,
        ]);

        $aluno->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'data_nascimento' => $request->data_nascimento,
            'curso' => $request->curso,
            'matricula' => $request->matricula,
        ]);

        return redirect()->route('alunos.index')
            ->with('success', 'Aluno atualizado com sucesso!');
    }

    /**
     * Excluir aluno do banco.
     */
    public function destroy(string $id)
    {
        $aluno = auth()->user()->alunos()->findOrFail($id);
        $aluno->delete();

        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso!');
    }
}