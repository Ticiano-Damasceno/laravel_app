<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\TelefoneController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::redirect('/', '/pessoas');
    Route::resource('pessoas', PessoaController::class);
    Route::resource('pessoas.telefones', TelefoneController::class)
        ->shallow()
        ->only(['store', 'edit', 'update', 'destroy']);

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get(
            '/gerenciar-pessoas', 
            [PessoaController::class, 'gerenciar']
        )->name('gerenciar-pessoas');

    Route::post(
        '/gerenciar-pessoas',
        [PessoaController::class, 'salvarProprietarios']
    )->name('gerenciar-pessoas.salvar');

    Route::get(
        '/pendencias',
        [PessoaController::class,'pendencias']
    )->name('pessoas.pendencias');

    Route::patch('/gerenciar-pessoas/{pessoa}/aprovar',
        [PessoaController::class,'aprovar']
    )->name('pessoas.aprovar');

    Route::patch('/gerenciar-pessoas/{pessoa}/rejeitar',
        [PessoaController::class,'rejeitar']
    )->name('pessoas.rejeitar');

});

require __DIR__.'/auth.php';
