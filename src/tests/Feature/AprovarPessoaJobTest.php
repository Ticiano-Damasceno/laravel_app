<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Pessoa;
use App\Jobs\AprovarPessoaJob;

class AprovarPessoaJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_aprova_pessoa_em_processamento(): void
    {
        $pessoa = Pessoa::factory()->create(['status' => 'processando']);

        (new AprovarPessoaJob($pessoa))->handle();

        $this->assertEquals('aprovado', $pessoa->fresh()->status);
    }
}