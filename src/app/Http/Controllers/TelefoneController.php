<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Telefone;
use Illuminate\Validation\Rule;


class TelefoneController extends Controller
{
    public function store(Request $request, Pessoa $pessoa)
    {
        $request->validate([
            'numero' => 'required|max:20|unique:telefones,numero',
            'tipo' => [
                'required',
                'in:celular,residencial,comercial',
                Rule::unique('telefones')->where('pessoa_id', $pessoa->id),
            ],
        ]);
        $pessoa->telefones()->create([
            'numero' => $request->numero,
            'tipo' => $request->tipo,
        ]);
        return redirect()->route('pessoas.show', $pessoa)->with('sucesso','Telefone adicionado com sucesso!');
    } 
    
    public function edit(Telefone $telefone)
    {
        return view('telefones.edit', compact('telefone'));
    }

    public function update(Request $request, Telefone $telefone)
    {
        $request->validate([
            'numero' => 'required|max:20|unique:telefones,numero,' . $telefone->id,
            'tipo' => [
                'required',
                'in:celular,residencial,comercial',
                Rule::unique('telefones')->where('pessoa_id', $telefone->pessoa_id)->ignore($telefone->id),
            ],
        ]);
        $telefone->update($request->only('numero', 'tipo'));
        return redirect()->route('pessoas.show', $telefone->pessoa)->with('sucesso','Telefone editado com sucesso!');
    }

    public function destroy(Request $request, Telefone $telefone)
    {
        $pessoa = $telefone->pessoa;
        $telefone->delete();
        return redirect()->route('pessoas.show', $pessoa)->with('sucesso','Telefone excluído com sucesso!');
    }
}
