<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BankController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [BankController::class, 'index'])->name('dashboard');
    Route::get('/deposit', [BankController::class, 'deposit'])->name('deposit');
    Route::get('/withdraw', [BankController::class, 'viewWithdraw'])->name('withdraw');
    Route::get('/transfer', [BankController::class, 'viewTransfer'])->name('transfer');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('deposit', [BankController::class, 'store'])->name('deposit');
    Route::post('withdraw', [BankController::class, 'withdraw'])->name('withdraw');
    Route::post('transfer', [BankController::class, 'transfer'])->name('transfer');
    Route::get('statement',  [BankController::class, 'statement'])->name('statement');
});

require __DIR__.'/auth.php';
