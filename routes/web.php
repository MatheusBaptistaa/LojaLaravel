<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\ProdutoController;

Route::group(['prefix'=>'produto'], function() {
    Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');
    Route::get('/inserir', [ProdutoController::class, 'inserir']);
    Route::post('/inserir', [ProdutoController::class, 'salvar_novo']);
    Route::put('/alterar{id}', [ProdutoController::class, 'atualizar'])->name('produto.atualizar');
    Route::get('/alterar{id}', [ProdutoController::class, 'alterar'])->name('produto.alterar');
    Route::delete('/excluir{id}', [ProdutoController::class, 'excluir'])->name('produto.excluir');
});

Route::group(['prefix'=>'marca'], function() {
    Route::get('/', [MarcaController::class, 'index']);

    Route::get('/novo',
            [MarcaController::class, 'inserir']);
    Route::post('/novo',
            [MarcaController::class, 'salvar_novo']);


    Route::get('/excluir',
            [MarcaController::class, 'excluir']);
    Route::get('/update/{id}',
            [MarcaController::class, 'alterar']);

    Route::post('/update',
            [MarcaController::class, 'salvar_update']);

});


Route::group(['prefix' => 'categoria'], function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('categoria.index');;
    Route::get('/inserir', [CategoriaController::class, 'inserir']);
    Route::post('/inserir', [CategoriaController::class, 'inserirSubmit'])->name('categoria.inserir.submit');
    Route::get('/alterar/{id}', [CategoriaController::class, 'alterar']);
    Route::put('/alterar/{id}', [CategoriaController::class, 'alterarCategoria'])->name('categoria.alterar');
    Route::delete('/excluir/{id}', [CategoriaController::class, 'excluir'])->name('categoria.excluir');
});

Route::group(['prefix' => 'cor'], function () {
    Route::get('/', [CorController::class, 'index'])->name('cor.index');;
    Route::get('/inserir', [CorController::class, 'inserir']);
    Route::post('/inserir', [CorController::class, 'inserirSubmit'])->name('cor.inserir.submit');
    Route::get('/alterar/{id}', [CorController::class, 'alterar']);
    Route::put('/alterar/{id}', [CorController::class, 'alterarCor'])->name('cor.alterar');
    Route::delete('/excluir/{id}', [CorController::class, 'excluir'])->name('cor.excluir');
});



Route::get('/', [MarcaController::class, 'index']);
