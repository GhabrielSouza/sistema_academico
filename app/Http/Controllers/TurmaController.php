<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\User;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::all();
        $disciplinas = Disciplina::all();
        $professores = User::where('role', 'professor')->get();

        return view('turmas.turmas', compact('turmas', 'disciplinas', 'professores'));
    }

    public function create()
    {
        $disciplinas = Disciplina::all();
        $professores = User::where('role', 'professor')->get();

        return view('turmas.create', compact('disciplinas', 'professores'));
    }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

        $dados = $request->validateWithBag('criarTurma',[
            'nome' => 'required',
            'descricao' => 'nullable',
            'disciplina_id' => 'required|exists:disciplinas,id',
            'professor_id' => 'required|exists:users,id',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'disciplina_id.required' => 'O campo disciplina é obrigatório.',
            'disciplina_id.exists' => 'A disciplina selecionada não existe.',
            'professor_id.required' => 'O campo professor é obrigatório.',
            'professor_id.exists' => 'O professor selecionado não existe.',
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
        $request->validateWithBag('atualizarTurma',[
            'nome' => 'required',
            'disciplina_id' => 'required',
            'professor_id' => 'required'
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'disciplina_id.required' => 'O campo disciplina é obrigatório.',
            'professor_id.required' => 'O campo professor é obrigatório.',

        ]);

        $turma = Turma::findOrFail($id);

        $turma->nome = $request->input('nome');
        $turma->disciplina_id = $request->input('disciplina_id');
        $turma->professor_id = $request->input('professor_id');
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
