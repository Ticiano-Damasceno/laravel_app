<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Pessoa;

#[Signature('app:rejeitar-pendencias-command')]
#[Description('Command description')]
class RejeitarPendenciasCommand extends Command
{
    public function handle()
    {
        $quantidade = Pessoa::where('status', 'pendente')
            ->where('created_at','<=', now()->subMinute())
            ->update([
                'status'=> 'rejeitado',
            ]);

        $this->info(
            "{$quantidade} pessoa(s) rejeitada(s)."
        );
        return self::SUCCESS;
    }
}
