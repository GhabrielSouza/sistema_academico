<?php

namespace App\Http\Controllers;

use App\Models\Notas;
use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\User;

class NotasController extends Controller
{
    public function index()
    {
        if (request()->user()->role === 'aluno') {
            $notas = Notas::with('turma')
                ->where('aluno_id', request()->user()->id)
                ->get();
            $alunos = User::where('id', request()->user()->id)->get();
            $turmas = Turma::all();
            return view('notas.notas', compact('notas', 'alunos', 'turmas'));
        }
        if (request()->user()->role === 'professor') {
            $turmasMinistradas = Turma::where('professor_id', request()->user()->id)->pluck('id');
            $notas = Notas::with('usuario', 'turma')
                ->whereIn('turma_id', $turmasMinistradas)
                ->get();
            $alunos = User::where('role', 'aluno')->get();
            $turmas = Turma::whereIn('id', $turmasMinistradas)->get();
            return view('notas.notas', compact('notas', 'alunos', 'turmas'));
        }
        $notas = Notas::with('usuario', 'turma')->get();
        $alunos = User::where('role', 'aluno')->get();
        $turmas = Turma::all();
        return view('notas.notas', compact('notas', 'alunos', 'turmas'));
    }

    public function create()
    {
        return view('notas.create');
    }

    public function store(Request $request)
    {
        if ($request->user()->role !== 'professor' && $request->user()->role !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

        $request->validateWithBag('criarNota',[
            'valor' => 'required|numeric|min:0|max:100',
            'turma_id' => 'required|exists:turmas,id',
            'aluno_id' => 'required|exists:users,id',
        ], [
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O campo valor deve ser um número.',
            'valor.min' => 'O campo valor deve ser no mínimo 0.',
            'valor.max' => 'O campo valor deve ser no máximo 100.',
            'turma_id.required' => 'O campo turma é obrigatório.',
            'turma_id.exists' => 'A turma selecionada não existe.',
            'aluno_id.required' => 'O campo aluno é obrigatório.',
            'aluno_id.exists' => 'O aluno selecionado não existe.',
        ]);

        Notas::create($request->all());

        return redirect()->back()->with('success', 'Nota criada com sucesso!');
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
        if ($request->user()->role !== 'professor' && $request->user()->role !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }
 
        $request->validateWithBag('atualizarNota',[
            'valor' => 'required|numeric',
            'turma_id' => 'required|exists:turmas,id',
            'aluno_id' => 'required|exists:users,id',
        ], [
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O campo valor deve ser um número.',
            'turma_id.required' => 'O campo turma é obrigatório.',
            'turma_id.exists' => 'A turma selecionada não existe.',
            'aluno_id.required' => 'O campo aluno é obrigatório.',
            'aluno_id.exists' => 'O aluno selecionado não existe.',
        ]);

        $nota = Notas::findOrFail($id);
        $nota->update($request->all());

        return redirect()->route('notas.index')->with('success', 'Nota atualizada com sucesso!');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->user()->role !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

        $nota = Notas::findOrFail($id);
        $nota->delete();

        return redirect()->route('notas.index')->with('success', 'Nota deletada com sucesso!');
    }
}
