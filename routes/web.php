<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GatosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos', [ProdutosController::class, 'index'])->name('produtos.index');

Route::get('/produtos/novo', [ProdutosController::class, 'create'])->name('produtos.create');

Route::get('/produtos/{produto}', [ProdutosController::class, 'show'])->name('produtos.show');

Route::get('/produtos/{produto}/editar', [ProdutosController::class, 'edit'])->name('produtos.edit');

Route::post('/produtos', [ProdutosController::class, 'store'])->name('produtos.store');

Route::put('/produtos/{produto}', [ProdutosController::class, 'update'])->name('produtos.update');

Route::delete('/produtos/{produto}', [ProdutosController::class, 'destroy'])->name('produtos.destroy');
