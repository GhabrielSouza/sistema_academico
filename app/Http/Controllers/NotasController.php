<?php

namespace App\Http\Controllers;

use App\Models\Notas;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function index()
    {
        $notas = Notas::all();
        return view('notas.notas', compact('notas'));
    }

    public function create()
    {
        return view('notas.create');
    }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'professor') {
            abort(403, 'Acesso não autorizado.');
        }

        $request->validate([
            'valor' => 'required|numeric',
            'turma_id' => 'required|exists:turmas,id',
            'aluno_id' => 'required|exists:alunos,id',
        ]);

        Notas::create($request->all());
    }

    public function show($id)
    {
        return view('notas.show', compact('id'));
    }
    public function edit($id)
    {
        return view('notas.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        if ($request->user()->role !== 'professor') {
            abort(403, 'Acesso não autorizado.');
        }

        $request->validate([
            'valor' => 'required|numeric',
        ]);

        $nota = Notas::findOrFail($id);
        $nota->update($request->all());

        return redirect()->route('notas.index')->with('success', 'Nota atualizada com sucesso!');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->role !== 'professor') {
            abort(403, 'Acesso não autorizado.');
        }

        $nota = Notas::findOrFail($id);
        $nota->delete();

        return redirect()->route('notas.index')->with('success', 'Nota deletada com sucesso!');
    }
}
