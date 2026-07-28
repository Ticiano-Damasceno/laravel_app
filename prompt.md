Olá. Estou estudando PHP com laravel. Aprendi o básico do php e já tenho conhecimento sobre lógica de programação, python, javascript, banco de dados e um pouco de arquitetura mvc.

Comecei a estudar laravel fazendo um simples sistema de CRUD. Eu instalei o Ubuntu no wsl do meu win11 e subi todos os arquivos do laravel lá. Além disso criei 2 container: laravel_app e laravel_db (com um container SQL server, mariaDB).

o crud está completo, porém acho que ainda falta aprender mais boas práticas do laravel. Quais arquivos eu preciso lhe enviar para você entender aonde eu parei e podermos continuar o aprendizado?

Gostaria que suas respostar fossem curtas e diretas mas explicando passo a passo cada item do php e do laravel e avançando bem devagar no assunto.


Catalogou arquivos essenciais do projeto Laravel para revisão pedagógica
Catalogou arquivos essenciais do projeto Laravel para revisão pedagógica
Olá, Ticiano! Que legal que já avançou para o Laravel com Docker.

Para eu entender onde você parou, envie (ou cole o conteúdo de):

Estrutura geral

app/Models/ — todos os models
app/Http/Controllers/ — todos os controllers
routes/web.php (e api.php se tiver)
Views
4. Pasta resources/views/ (pode ser só a listagem + 1 exemplo de view)

Banco de dados
5. database/migrations/ — todas as migrations do CRUD
6. .env (⚠️ apague usuário/senha do banco antes de enviar, só preciso ver a estrutura das variáveis)

Docker
7. docker-compose.yml
8. Dockerfile do laravel_app (se tiver um customizado)

Não precisa mandar tudo de uma vez — pode começar por Models + Controllers + 1 migration, que já dá pra eu avaliar a base da sua lógica CRUD e as boas práticas do Eloquent/MVC.

Pode mandar assim que tiver reunido?

Pessoa.php

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = [
        "nome","idade"
    ];
}
PessoaController.php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

class PessoaController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::orderBy('id')->get();

        return view(
            'pessoas.index',
            compact('pessoas')
        );
    }

    public function create()
    {
        return view('pessoas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:100',
            'idade' => 'required|integer|min:1|max:150',
        ]);

        Pessoa::create([
            'nome'=> $request->nome,
            'idade'=> $request->idade,
        ]);

        return redirect('/pessoas');
    }

    public function destroy($id)
    {
        $pessoa = Pessoa::findOrFail($id);

        $pessoa->delete();

        return redirect('/pessoas');
    }

    public function edit($id)
    {
        $pessoa = Pessoa::findOrFail($id);

        return view(
            'pessoas.edit',
            compact('pessoa')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:100',
            'idade'=> 'required|min:1|max:150',
        ]);

        $pessoa = Pessoa::findOrFail($id);

        $pessoa->update([
            'nome'=> $request->nome,
            'idade'=> $request->idade,
        ]);

        return redirect('/pessoas');
    }
}
root@d8e8df45a3ea:/var/www/html# php artisan migrate:status
  Migration name ...................................................................................... Batch / Status
  0001_01_01_000000_create_users_table ....................................................................... [1] Ran
  0001_01_01_000001_create_cache_table ....................................................................... [1] Ran
  0001_01_01_000002_create_jobs_table ........................................................................ [1] Ran
  2026_07_16_135428_create_pessoas_table ..................................................................... [1] Ran

Mostrar mais

Identified route model binding opportunity and validation inconsistency
Identified route model binding opportunity and validation inconsistency
Boa, Ticiano! Código limpo e organizado. Vi dois pontos pra evoluir. Vamos um de cada vez.

1. Route Model Binding (Laravel troca isso por você)
Hoje você faz assim em edit, update, destroy:

php
public function edit($id)
{
    $pessoa = Pessoa::findOrFail($id);
    ...
}
O Laravel pode injetar o model automaticamente, sem você buscar na mão:

php
public function edit(Pessoa $pessoa)
{
    return view('pessoas.edit', compact('pessoa'));
}
Como funciona: o Laravel olha o parâmetro da rota ({pessoa}), pega o valor da URL (ex: /pessoas/5/edit), busca Pessoa::findOrFail(5) sozinho e já entrega o objeto pronto. Se não achar, já lança 404 automaticamente — igual seu findOrFail fazia.

Isso exige que a rota use {pessoa} como nome do parâmetro (não {id}). Assim que você me mandar routes/web.php, ajusto com você.

2. Pequena inconsistência na validação
No store:

php
'idade' => 'required|integer|min:1|max:150',
No update:

php
'idade'=> 'required|min:1|max:150',  // faltou 'integer'
Corrija adicionando integer no update também, pra manter a mesma regra nos dois lugares.

Pode me mandar o routes/web.php agora? Com ele eu já aplico o Route Model Binding e te explico o próximo passo (Form Requests, pra tirar a validação repetida do controller).


Ponderou honestidade sobre limitações e próximos passos necessários
Ponderou honestidade sobre limitações e próximos passos necessários
Boa pergunta, e merece uma resposta honesta, não só motivacional.

O que esse cronograma te dá
Ao final dos 9 passos, você vai ter domínio sólido dos pilares técnicos individuais que o ESEIS precisa: relacionamentos, autenticação multi-perfil, autorização, migrations com constraints, automação sem worker persistente, filas, testes. Isso é a base real do projeto — nenhum desses passos é "enfeite".

O que ainda vai faltar (e é importante saber disso)
1. Desenho do sistema como um todo
Cronograma ensina peças isoladas. O ESEIS tem complexidade de integração: o HOLD de 120min precisa conversar com a trava de concorrência, que precisa conversar com a política de cancelamento, que precisa conversar com autorização por perfil. Isso exige você pensar em fluxo completo, não só em cada peça funcionando sozinha.

2. Decisões de arquitetura específicas do domínio
Coisas como: o que acontece se dois psicólogos tentam reservar a mesma sala no mesmo milissegundo? Como você testa isso de verdade (não só na teoria)? Como lida com fuso horário em agendamento? Isso não tem "aula pronta" — exige você aplicar o que aprendeu em um problema novo.

3. Volume
O ESEIS tem 4 perfis, múltiplas entidades relacionadas (Sala, Psicólogo, Agendamento, Unidade), regras de negócio específicas (penalidade de cancelamento, etc). O cronograma usa "Pessoa" como exemplo simples — replicar esse padrão pra 5-6 entidades reais vai tomar tempo e você vai errar coisas novas que não apareceram no CRUD de treino.

4. Coisas que nem estão no cronograma ainda
Ex: como popular dados de teste (seeders/factories), como lidar com upload de arquivo (se precisar), refinamento de UX real, deploy de fato na HomeHost (com todas as particularidades de shared hosting que só aparecem na prática).

Minha visão honesta
Terminando o cronograma, você vai estar capacitado tecnicamente a construir o ESEIS — não vai faltar conhecimento de Laravel. Mas o projeto em si vai ser um processo de aprendizado próprio, com decisões e bugs que não têm como prever agora. É normal e esperado — é assim que todo dev sênior aprendeu também.

Sugestão prática
Quando começarmos o ESEIS de verdade, sugiro fazermos como fizemos hoje: eu explico o conceito, você aplica, aparecem erros reais, resolvemos juntos. Esse ciclo é mais valioso do que qualquer cronograma teórico — foi exatamente isso que aconteceu hoje com Docker, autoload, Policy.

Faz sentido essa expectativa? Descanse bem — amanhã seguimos com middleware.

perfeito. até amanhã

Até amanhã, Ticiano! Bom descanso. 🙂

