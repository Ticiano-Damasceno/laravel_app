<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pessoa;
use App\Jobs\AprovarPessoaJob;

class PendenciasTest extends TestCase
{
    use RefreshDatabase;

    public function test_visualizador_nao_pode_acessar_pendencias(): void
    {
        $visualizador = User::factory()->create([
            'role' => 'visualizador',
        ]);

        $response = $this->actingAs($visualizador)
            ->get('/pendencias');

        $response->assertRedirect('/pessoas');
    }

    public function test_admin_pode_acessar_pendencias(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->get('/pendencias');

        $response->assertOk();
    }

    public function test_usuario_nao_autenticado_e_redirecionado_para_login(): void
    {
        $response = $this->get('/pendencias');

        $response->assertRedirect('/login');
    }

    public function test_pessoa_inicia_com_status_pendente(): void
    {
        $pessoa = Pessoa::factory()->create();

        $this->assertEquals('pendente', $pessoa->status);
    }

    public function test_visualizador_nao_pode_aprovar_pessoa(): void
    {
        $visualizador = User::factory()->create([
            'role' => 'visualizador',
        ]);
        $pessoa = Pessoa::factory()->create();

        $response = $this->actingAs($visualizador)
            ->patch(route('pessoas.aprovar', $pessoa));

        $response->assertRedirect('/pessoas');
        $this->assertEquals('pendente', $pessoa->fresh()->status);
    }

    public function test_admin_aprovar_marca_como_processando_e_enfileira_job(): void
    {
        Queue::fake();

        $admin = User::factory()->create([
            'role' => 'admin',
        ]);
        $pessoa = Pessoa::factory()->create();

        $this->actingAs($admin)
            ->patch(route('pessoas.aprovar', $pessoa));

        $this->assertEquals('processando', $pessoa->fresh()->status);
        Queue::assertPushed(AprovarPessoaJob::class);
    }

    public function test_admin_pode_rejeitar_pessoa(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);
        $pessoa = Pessoa::factory()->create();

        $this->actingAs($admin)
            ->patch(route('pessoas.rejeitar', $pessoa));

        $this->assertEquals('rejeitado', $pessoa->fresh()->status);
    }
}