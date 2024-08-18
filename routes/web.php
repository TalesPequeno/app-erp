<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\EstoqueController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/company/access', [CompanyController::class, 'access'])->name('company.access');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('lojas', LojaController::class);

Route::get('cadastros/lojas', [CadastroController::class, 'createLoja'])->name('cadastros.lojas');
Route::get('cadastros/clientes', [CadastroController::class, 'clientes'])->name('cadastros.clientes');
Route::get('cadastros/produtos', [CadastroController::class, 'produtos'])->name('cadastros.produtos');
Route::get('cadastros/fornecedores', [CadastroController::class, 'fornecedores'])->name('cadastros.fornecedores');

Route::get('/get-estados/{pais_id}', [CadastroController::class, 'getEstados']);
Route::get('/get-cidades/{uf}', [CadastroController::class, 'getCidades']);

Route::resource('clientes', ClienteController::class);

Route::resource('produtos', ProdutoController::class);

Route::resource('fornecedores', FornecedorController::class);

Route::resource('estoques', EstoqueController::class);
