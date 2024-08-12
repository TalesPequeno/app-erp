<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LojaController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/company/access', [CompanyController::class, 'access'])->name('company.access');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('lojas', LojaController::class);
Route::get('/lojas', [LojaController::class, 'index'])->name('lojas.index');
Route::get('/lojas/{id}', [LojaController::class, 'show'])->name('lojas.show');
Route::get('/lojas/{id}/edit', [LojaController::class, 'edit'])->name('lojas.edit');
Route::put('/lojas/{id}', [LojaController::class, 'update'])->name('lojas.update');
Route::delete('/lojas/{id}', [LojaController::class, 'destroy'])->name('lojas.destroy');

Route::get('cadastros/lojas', [CadastroController::class, 'createLoja'])->name('cadastros.lojas');
Route::get('cadastros/clientes', [CadastroController::class, 'clientes'])->name('cadastros.clientes');
Route::get('cadastros/produtos', [CadastroController::class, 'produtos'])->name('cadastros.produtos');
Route::get('cadastros/fornecedores', [CadastroController::class, 'fornecedores'])->name('cadastros.fornecedores');

Route::get('/get-estados/{pais_id}', [CadastroController::class, 'getEstados']);
Route::get('/get-cidades/{uf}', [CadastroController::class, 'getCidades']);

