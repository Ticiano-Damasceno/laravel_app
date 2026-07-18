<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use Illuminate\Http\Request;
use App\Models\Pessoa;

class PessoaController extends Controller
{
    public function index()
    {
        $this->authorize("viewAny", Pessoa::class);

        $pessoas = auth()->user()->role==='admin'
            ? Pessoa::orderBy('id')->get()
            : Pessoa::where('user_id', auth()->id())->orderBy('id')->get();
        ;

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
        return view('pessoas.create');
    }

    public function store(PessoaRequest $request)
    {
        $this->authorize('create', Pessoa::class);

        Pessoa::create([
            ...$request->only('nome', 'idade'),
            'user_id' => auth()->id(),
        ]);
        return redirect('/pessoas')->with('sucesso','Pessoa cadastrada com sucesso!');
    }

    public function destroy(Pessoa $pessoa)
    {
        $this->authorize('delete', $pessoa);
        $pessoa->delete();
        return redirect('/pessoas')->with('sucesso','Pessoa removida com sucesso!');;
    }

    public function edit(Pessoa $pessoa)
    {
        $this->authorize('update', $pessoa);
        return view('pessoas.edit',compact('pessoa'));
    }

    public function update(PessoaRequest $request, Pessoa $pessoa)
    {
        $this->authorize('update', $pessoa);

        $pessoa->update($request->only('nome', 'idade'));
        return redirect('/pessoas')->with('sucesso','Pessoa atualizada com sucesso!');;
    }
}
