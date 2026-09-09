1. Identificação — Capa com disciplina, turma, trilha D e os seis nomes completos com matrícula. Dupla 3. Confira duas vezes: é o único item que zera nota individual. **DUPLA 3**

2. Trilha escolhida e justificativa — Vocês escolheram D porque já tinham a aplicação com suíte de testes funcionando e queriam exercitar automação de pipeline, que é a competência mais próxima da prática profissional em times que entregam continuamente. Dupla 3 escreve, mas você revisa.  **DUPLA 3**

3. Contexto e objeto — O sistema de cadastro de pessoas: papéis admin e visualizador, fluxo pendente → processando → aprovado/rejeitado, job assíncrono, comando agendado de rejeição automática. **Dupla 2**

4. Percursos mobilizados — P4 (automação e pipeline) e P2 (documentação, versionamento, gestão de configuração), que são os previstos para a trilha. Mas vocês tocaram P1 e P3 de fato: níveis de teste distintos, caixa-branca no observer, valor limite no comando de rejeição. Vale mencionar como transversal — o critério de cobertura dos percursos pede o previsto, e ir além não custa.  **DUPLA 3**

5. Planejamento e abordagem — Escopo, riscos, níveis, critérios e ambiente. É aqui que entra a decisão de MariaDB em desenvolvimento e SQLite em memória nos testes, com a justificativa. **Dupla 2**

6. Desenvolvimento da solução — O ci.yml explicado bloco a bloco: dois jobs, o needs como gate, working-directory: ./src, por que npm ci e não npm install, por que o build de assets é necessário. **Dupla 1**

7. Casos de teste — Aqui está a primeira armadilha. Formalizar 34 casos é inviável em 20 páginas. Selecionem entre seis e oito representativos, cobrindo variedade: um unitário do observer, um de autorização negada, um de autorização permitida, o de despacho com Queue::fake(), o do job isolado, e o de não autenticado. Digam explicitamente que a suíte tem 34 e que foram detalhados os mais representativos — omitir isso parece lacuna, declarar parece critério. **Dupla 1**

8. Evidências — Pipeline verde, PR vermelho com deploy skipped, log da falha, branch protection, saída do php artisan test local. Dupla 3 organiza, com legenda em cada print dizendo o que prova. **DUPLA 3**

9. Ferramentas e stack — PHP 8.3, Laravel, Breeze, PHPUnit, Docker Compose, GitHub Actions, Vite, MariaDB, SQLite. **Dupla 2**

10. Declaração de uso de IA — Segunda armadilha, e vale 2,0 pontos dos 5,0. Sejam específicos e honestos: que ferramenta, em que etapas, e o que a equipe fez com o resultado. No caso de vocês, a IA foi usada em diagnóstico de ambiente, revisão de testes e redação do workflow, com validação e execução feitas pela equipe. Declaração vaga é quase tão arriscada quanto nenhuma.  **DUPLA 3**

11. Considerações finais — O material forte. Os três achados: o bug de acentuação que só o teste unitário pegou, o job parado que 33 testes verdes não pegaram, e as divergências entre configuração declarada e ambiente real. **Dupla 1,2 e 3**

12. Referências — Documentação do Laravel, do PHPUnit, do GitHub Actions, e as normas IEEE 829 e ISO/IEC/IEEE 29119 se forem citadas no tópico 7.
