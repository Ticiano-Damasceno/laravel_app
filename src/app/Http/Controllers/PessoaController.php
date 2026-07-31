<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pessoa;
use App\Models\User;
use App\Jobs\AprovarPessoaJob;

class PessoaController extends Controller
{
    public function index()
    {
        $this->authorize("viewAny", Pessoa::class);

        $pessoas = Auth::user()->role === 'admin'
            ? Pessoa::orderBy('id')->get()
            : Pessoa::where('user_id', Auth::id())->where('status','aprovado')->orderBy('id')->get();

        return view(
            'pessoas.index',
            compact('pessoas')
        );
    }

    public function show(Pessoa $pessoa)
    {
        $this->authorize('view', $pessoa);
        return view('pessoas.show', compact('pessoa'));
    }

    public function create()
    {
        $this->authorize('create', Pessoa::class);
        $usuarios = User::where('role','visualizador')->get();
        return view('pessoas.create', compact('usuarios'));
    }

    public function store(PessoaRequest $request)
    {
        $this->authorize('create', Pessoa::class);

        $user_id = Auth::id();
        if (Auth::user()->role === 'admin') {
            $user_id = $request->user_id;
        }

        Pessoa::create([
            ...$request->only('nome', 'idade'),
            'user_id' => $user_id,
        ]);
        return redirect('/pessoas')->with('sucesso', 'Pessoa cadastrada com sucesso!');
    }

    public function destroy(Pessoa $pessoa)
    {
        $this->authorize('delete', $pessoa);
        $pessoa->delete();
        return redirect('/pessoas')->with('sucesso', 'Pessoa removida com sucesso!');
    }

    public function edit(Pessoa $pessoa)
    {
        $this->authorize('update', $pessoa);
        return view('pessoas.edit', compact('pessoa'));
    }

    public function update(PessoaRequest $request, Pessoa $pessoa)
    {
        $this->authorize('update', $pessoa);

        $pessoa->update($request->only('nome', 'idade'));
        return redirect('/pessoas')->with('sucesso', 'Pessoa atualizada com sucesso!');
    }

    public function gerenciar()
    {
        $pessoas = Pessoa::with('user')
            ->orderBy('nome')
            ->get();

        $usuarios = User::where('role', 'visualizador')
            ->orderBy('name')
            ->get();

        return view('admin.gerenciar-pessoas', compact('pessoas', 'usuarios'));
    }

    public function salvarProprietarios(Request $request)
    {
        $request->validate([
            'usuarios' => ['required', 'array'],
        ]);

        foreach ($request->usuarios as $pessoaId => $userId) {
            $pessoa = Pessoa::find($pessoaId);

            if ($pessoa && $pessoa->user_id != $userId) {
                $pessoa->update([
                    'user_id' => $userId
                ]);
            }
        }

        return redirect()
            ->route('gerenciar-pessoas')
            ->with('sucesso', 'Proprietários atualizados com sucesso.');
    }

    public function pendencias()
    {
        $pessoas = Pessoa::with('user')
            ->whereIn('status',['pendente','processando'])
            ->orderBy('nome')
            ->get();

        return view('admin.pendencias', compact('pessoas'));
    }

    public function aprovar(Pessoa $pessoa)
    {
        $pessoa->update([
            'status'=> 'processando',
        ]);

        AprovarPessoaJob::dispatch($pessoa);

        return redirect()
            ->route('pessoas.pendencias')
            ->with('sucesso', 'Processo de aprovação iniciado...');
    }

    public function rejeitar(Pessoa $pessoa)
    {
        $pessoa->update(['status' => 'rejeitado']);

        return redirect()
            ->route('pessoas.pendencias')
            ->with('sucesso', 'Pessoa rejeitada com sucesso.');
    }
}
