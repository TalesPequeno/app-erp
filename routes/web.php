<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/company/access', [CompanyController::class, 'access'])->name('company.access');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

