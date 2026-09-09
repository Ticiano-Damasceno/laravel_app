<?php

namespace App\Observers;

use App\Models\Pessoa;
use Illuminate\Support\Facades\Log;

class PessoaObserver
{
    public function deleted(Pessoa $pessoa): void
    {
        Log::info("Pessoa excluída: {$pessoa->nome} (ID: {$pessoa->id}) por usuário ID {$pessoa->user_id}");
    }

    public function creating(Pessoa $pessoa): void
    {
        // Versão anterior com bug no teste PessoaObserverTest.php
        // $pessoa->nome = ucwords(
        //     strtolower($pessoa->nome)
        // ); 

        $pessoa->nome = mb_convert_case($pessoa->nome, MB_CASE_TITLE, 'UTF-8');
        $pessoa->status = 'pendente';
    }

    public function updating(Pessoa $pessoa): void
    {
        // Versão anterior com bug no teste PessoaObserverTest.php
        // $pessoa->nome = ucwords(
        //     strtolower($pessoa->nome)
        // );

        $pessoa->nome = mb_convert_case($pessoa->nome, MB_CASE_TITLE, 'UTF-8');
    }
}
