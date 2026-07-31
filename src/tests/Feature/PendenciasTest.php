<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pessoa;

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
    public function test_pessoa_inicia_com_status_pendente()
    {
        $pessoa = Pessoa::factory()->create();

        $this->assertEquals(
            'pendente',
            $pessoa->status
        );
    }
}
