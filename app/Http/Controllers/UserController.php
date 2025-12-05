<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    // --- 1. LISTAR USUÁRIOS (INDEX) ---
    public function index()
    {
        // Busca todos os registros da tabela 'users'
        $users = User::all();

        // Envia a lista ($users) para a view 'users.index'
        return view('users.index', compact('users'));
    }

    // --- 2. MOSTRAR FORMULÁRIO DE CRIAÇÃO (CREATE) ---
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // 1. Segurança: Verifica se é admin
        if ($request->user()->role !== 'admin') {
            abort(403, 'Acesso não autorizado.');
        }

        // 2. Validação e Criação... (código simplificado para foco)
        $dados = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,professor,aluno',
        ]);

        User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'password' => bcrypt($dados['password']),
            'role' => $dados['role'],
        ]);

        return redirect()->back()->with('success', 'Criado!');
    }

    // --- 4. MOSTRAR FORMULÁRIO DE EDIÇÃO (EDIT) ---
    // O Laravel faz "Route Model Binding": Busca o usuário pelo ID automaticamente
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // --- 5. ATUALIZAR USUÁRIO (UPDATE) ---
    public function update(Request $request, User $user)
    {
        $dados = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:admin,professor,aluno',
        ]);

        // Atualiza os dados no banco
        $user->update($dados);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado!');
    }

    // --- 6. EXCLUIR USUÁRIO (DESTROY) ---
    public function destroy(User $user)
    {
        // === TRAVA DE SEGURANÇA ===
        // Impede que o administrador exclua a si mesmo
        if (auth()->user()->id === $user->id) {
            return back()->with('error', 'Você não pode excluir a si mesmo!');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído!');
    }
}
