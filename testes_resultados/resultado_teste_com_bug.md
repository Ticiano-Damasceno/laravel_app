Execução 1:

   FAIL  Tests\Unit\PessoaObserverTest
  ✓ creating define status pendente                  0.01s  
  ⨯ creating normaliza o nome
  ✓ updating normaliza o nome

   PASS  Tests\Feature\Auth\AuthenticationTest
  ✓ login screen can be rendered                     0.23s  
  ✓ users can authenticate using the login screen    0.06s  
  ✓ users can not authenticate with invalid passwor… 0.22s  
  ✓ users can logout                                 0.01s  

   PASS  Tests\Feature\Auth\EmailVerificationTest
  ✓ email verification screen can be rendered        0.02s  
  ✓ email can be verified                            0.02s  
  ✓ email is not verified with invalid hash          0.01s  

   PASS  Tests\Feature\Auth\PasswordConfirmationTest
  ✓ confirm password screen can be rendered          0.02s  
  ✓ password can be confirmed                        0.02s  
  ✓ password is not confirmed with invalid password  0.22s  

   PASS  Tests\Feature\Auth\PasswordResetTest
  ✓ reset password link screen can be rendered       0.02s  
  ✓ reset password link can be requested             0.21s  
  ✓ reset password screen can be rendered            0.23s  
  ✓ password can be reset with valid token           0.22s  

   PASS  Tests\Feature\Auth\PasswordUpdateTest
  ✓ password can be updated                          0.02s  
  ✓ correct password must be provided to update pas… 0.02s  

   PASS  Tests\Feature\Auth\RegistrationTest
  ✓ registration screen can be rendered              0.02s  
  ✓ new users can register                           0.01s  

   PASS  Tests\Feature\PendenciasTest
  ✓ visualizador nao pode acessar pendencias         0.02s  
  ✓ admin pode acessar pendencias                    0.02s  
  ✓ usuario nao autenticado e redirecionado para lo… 0.02s  
  ✓ pessoa inicia com status pendente                0.02s  
  ✓ visualizador nao pode aprovar pessoa             0.01s  
  ✓ admin aprovar marca como processando e enfileir… 0.02s  
  ✓ admin pode rejeitar pessoa                       0.01s  

   PASS  Tests\Feature\ProfileTest
  ✓ profile page is displayed                        0.03s  
  ✓ profile information can be updated               0.02s  
  ✓ email verification status is unchanged when the… 0.01s  
  ✓ user can delete their account                    0.01s  
  ✓ correct password must be provided to delete acc… 0.01s  
  ────────────────────────────────────────────────────────  
   FAILED  Tests\Unit\PessoaObserverTest > creating norm…   
  Failed asserting that two strings are equal.
  -'José Da Silva'
  +'JosÉ Da Silva'
  

  at tests/Unit/PessoaObserverTest.php:28
     24▕         $pessoa->nome = 'joSÉ da SILVA';
     25▕ 
     26▕         (new PessoaObserver())->creating($pessoa);
     27▕ 
  ➜  28▕         $this->assertEquals('José Da Silva', $pessoa->nome);
     29▕     }
     30▕ 
     31▕     public function test_updating_normaliza_o_nome(): void
     32▕     {

  1   tests/Unit/PessoaObserverTest.php:28


  Tests:    1 failed, 32 passed (74 assertions)
  Duration: 1.96s


