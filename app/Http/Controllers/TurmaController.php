<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::all();
        return view('turmas.turmas', compact('turmas'));
    }

    public function create()
    {
        return view('turmas.create');
    }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

        $dados = $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable',
            'id_disciplina' => 'required|exists:disciplinas,id',
            'id_professor' => 'required|exists:users,id',
        ]);

        Turma::create($dados);

        return redirect()->back()->with('success', 'Turma criada com sucesso!');
    }

    public function edit(Turma $turma)
    {
        return view('turmas.edit', compact('turma'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable',
        ]);

        $turma = Turma::findOrFail($id);

        $turma->nome = $request->input('nome');
        $turma->descricao = $request->input('descricao');
        $turma->id_disciplina = $request->input('id_disciplina');
        $turma->id_professor = $request->input('id_professor');
        $turma->save();

        return redirect()->route('turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->role !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

        $turma = Turma::findOrFail($id);
        $turma->delete();

        return redirect()->route('turmas.index')->with('success', 'Turma deletada com sucesso!');
    }
}
