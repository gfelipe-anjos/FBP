<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SaidaController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Rotas protegidas por autenticação
Route::middleware(['auth:funcionario', 'verified'])->group(function () {
    Route::resource('funcionario', FuncionarioController::class);
    Route::resource('motorista', MotoristaController::class);
    Route::resource('entrada', EntradaController::class);
    Route::resource('saida', SaidaController::class);
    
    Route::get('/relatorio/saidas/pagamentos', [SaidaController::class, 'relatorioPagamentosPdf'])
        ->name('saidas.relatorio');
});

require __DIR__.'/auth.php';