<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\TelefoneController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

require __DIR__.'/auth.php';
