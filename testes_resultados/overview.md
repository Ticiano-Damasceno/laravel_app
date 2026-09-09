A aplicação

Sistema de cadastro de pessoas em Laravel com Breeze, construído sobre dois papéis de usuário e um fluxo de aprovação.

Papéis. Todo registro pelo Breeze nasce como visualizador. O admin só existe via seeder — não há caminho pelo app, o que é uma decisão de segurança deliberada. O visualizador enxerga apenas as pessoas que são dele e que já foram aprovadas; o admin enxerga tudo.

Fluxo de estados. Uma pessoa nasce pendente, forçado pelo PessoaObserver no creating, independente do que venha na requisição. O admin aprova (processando → job assíncrono → aprovado) ou rejeita (rejeitado). O AprovarPessoaJob é o que torna a aprovação um processo em duas etapas em vez de uma atribuição direta.

Camadas de proteção. Três, sobrepostas: middleware admin nas rotas administrativas, Policy via $this->authorize() em todos os métodos do CRUD, e o observer sobrescrevendo status na criação. Foi essa redundância que fez o teste de autoaprovação passar sem precisar de correção.

Infraestrutura. Quatro serviços no compose: laravel (Apache/PHP), mariadb, scheduler e worker. Os dois últimos são invisíveis até faltarem — foi a ausência do worker que travou seu fluxo de aprovação hoje.

A suíte

34 testes, em três blocos.

Herdados do Breeze (18): autenticação, registro, verificação de e-mail, redefinição de senha, perfil. Vieram prontos e continuam passando — são cobertura de graça e evidência de que o pipeline exercita a aplicação inteira, não só o que a equipe escreveu.

Unitários (3, em tests/Unit/PessoaObserverTest.php): testam o observer isoladamente, sem banco e sem HTTP, usando o TestCase do PHPUnit puro. Caixa-branca legítima. Foi aqui que apareceu o bug de acentuação.

De feature (13, incluindo os de perfil): exercitam rota, middleware, controller e banco em conjunto. Cobrem autorização por papel em leitura e escrita, redirect de não autenticado, o despacho do job com Queue::fake() e a execução do job isolada.

O encaixe no trabalho

A trilha D avalia pipeline, logs e gate — não cobertura nem quantidade de testes. A suíte é meio, não fim. Isso significa que o que você tem já é suficiente para a trilha; o que falta é o ci.yml e as evidências.

Mas o percurso até aqui gerou material que vale mais que o mínimo exigido:

Para o rigor técnico (1,5 pt). A distinção entre unitário e feature está materializada em código, não apenas afirmada no texto. O Queue::fake() separando responsabilidade do controller e do job é uma decisão de projeto de teste que se defende.

Para a reflexão crítica (0,5 pt). Dois achados reais. O bug de acentuação — strtolower + ucwords deformando qualquer nome com acento, encontrado por teste unitário e invisível para todos os testes de feature. E o job parado — 33 testes verdes com um fluxo quebrado na prática, encontrado por uso manual. Juntos ilustram que suíte verde não é sistema correto, e que verificação estática e dinâmica se complementam.

Para a gestão de configuração, P2 (0,5 pt). O incidente do Vite manifest, a decisão de MariaDB em desenvolvimento e SQLite nos testes, o trustProxies com ressalva de produção, os serviços de fila e agendamento. Tudo isso é conteúdo concreto para a dupla 2, em vez de teoria genérica sobre versionamento.

O que ainda falta: o ci.yml com dois jobs e needs, o build de assets no workflow (a suíte do Breeze renderiza a tela de login e chama o Vite), o working-directory: ./src em todos os steps, e o par de prints — pipeline verde e pipeline vermelho com o deploy skipped.