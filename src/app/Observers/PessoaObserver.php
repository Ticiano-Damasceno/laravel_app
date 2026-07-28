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
        $pessoa->nome = ucwords(
            strtolower($pessoa->nome)
        );
        $pessoa->status = 'pendente';
    }

    public function updating(Pessoa $pessoa): void
    {
        $pessoa->nome = ucwords(
            strtolower($pessoa->nome)
        );
    }
}
