<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\EmiController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/debug-db', function () {
    return config('database.connections.mysql');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [LoanController::class, 'dashboard'])->name('dashboard'); // simple admin page
    Route::get('/loan-details', [LoanController::class, 'index'])->name('loans.index'); // show loan_details
    Route::get('/emi', [EmiController::class, 'index'])->name('emi.index');             // EMI screen w/ button
    Route::post('/emi/process', [EmiController::class, 'process'])->name('emi.process');// drop+rebuild+fill
});
