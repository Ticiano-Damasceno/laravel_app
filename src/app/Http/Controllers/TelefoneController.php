<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Telefone;

class TelefoneController extends Controller
{
    public function store(Request $request, Pessoa $pessoa)
    {
        $request->validate(['numero' => 'required|max:20']);
        $pessoa->telefones()->create($request->only('numero'));
        return redirect()->route('pessoas.show', $pessoa)->with('sucesso','Telefone adicionado com sucesso!');
    } 
    
    public function edit(Telefone $telefone)
    {
        return view('telefones.edit', compact('telefone'));
    }

    public function update(Request $request, Telefone $telefone)
    {
        $request->validate(['numero'=> 'required|max:20']);
        $telefone->update($request->only('numero'));
        return redirect()->route('pessoas.show', $telefone->pessoa)->with('sucesso','Telefone editado com sucesso!');
    }

    public function destroy(Request $request, Telefone $telefone)
    {
        $pessoa = $telefone->pessoa;
        $telefone->delete();
        return redirect()->route('pessoas.show', $pessoa)->with('sucesso','Telefone excluído com sucesso!');
    }
}
