<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Pessoa;
use App\Observers\PessoaObserver;

class PessoaObserverTest extends TestCase
{
    public function test_creating_define_status_pendente(): void
    {
        $pessoa = new Pessoa();
        $pessoa->nome = 'José da Silva';

        (new PessoaObserver())->creating($pessoa);

        $this->assertEquals('pendente', $pessoa->status);
    }

    public function test_creating_normaliza_o_nome(): void
    {
        $pessoa = new Pessoa();
        $pessoa->nome = 'joSÉ da SILVA';

        (new PessoaObserver())->creating($pessoa);

        $this->assertEquals('José Da Silva', $pessoa->nome);
    }

    public function test_updating_normaliza_o_nome(): void
    {
        $pessoa = new Pessoa();
        $pessoa->nome = 'MARIA de souza';

        (new PessoaObserver())->updating($pessoa);

        $this->assertEquals('Maria De Souza', $pessoa->nome);
    }
}