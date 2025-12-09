<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;

class DisciplinaController extends Controller
{
    public function index()
    {
        $disciplinas = Disciplina::all();
        return view('disciplinas.disciplinas', compact('disciplinas'));
    }

    public function create()
    {
        return view('disciplinas.create');
    }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

        $dados = $request->validateWithBag('criarDisciplina',[
            'nome' => 'required|string|max:255|unique:disciplinas,nome',
            'descricao' => 'nullable|string|max:1000',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'nome.unique' => 'Já existe uma disciplina com esse nome.',
            'descricao.string' => 'O campo descrição deve ser uma string.',
            'descricao.max' => 'O campo descrição deve ter no máximo 1000 caracteres.',
        ]);

        Disciplina::create($dados);

        return redirect()->back()->with('success', 'Disciplina criada com sucesso!');
    }

    public function edit(Disciplina $disciplina)
    {
        return view('disciplinas.edit', compact('disciplina'));
    }

    public function update(Request $request, $id)
    {
        $request->validateWithBag('atualizarDisciplina',[
            'nome' => 'required',
            'descricao' => 'nullable',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
        ]);

        $disciplina = Disciplina::findOrFail($id);

        $disciplina->nome = $request->input('nome');
        $disciplina->descricao = $request->input('descricao');
        $disciplina->save();

        return redirect()->route('disciplinas.index')->with('success', 'Disciplina atualizada com sucesso!');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->role !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

        $disciplina = Disciplina::findOrFail($id);
        $disciplina->delete();

        return redirect()->route('disciplinas.index')->with('success', 'Disciplina deletada com sucesso!');
    }
}
