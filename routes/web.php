<?php

use Inertia\Inertia;
use App\Models\Wallet;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendAndRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {

    // $user = auth()->user;
    $wallet = Wallet::where('user_id', auth()->user()->id)
        ->select('id', 'balance', 'wallet_type')
        ->first();

    return Inertia::render('Dashboard', [
        'wallet' => $wallet
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User
    Route::get('/myaccount/transfer', [SendAndRequestController::class, 'send'])->name('transfer');
    Route::get('/myaccount/transfer/send', [SendAndRequestController::class, 'send'])->name('transfer.send');
    Route::get('/myaccount/transfer/request', [SendAndRequestController::class, 'request'])->name('transfer.request');
});

require __DIR__.'/auth.php';
