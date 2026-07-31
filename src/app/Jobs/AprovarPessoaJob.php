<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use App\Models\Pessoa;
class AprovarPessoaJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Pessoa $pessoa)
    {
        
    }

    public function handle(): void
    {
        sleep(10);

        $this->pessoa->update([
            "status"=> 'aprovado'
        ]);

        Log::info(
            "Pessoa {$this->pessoa->nome} aprovada via Queue."
        );
    }
}
