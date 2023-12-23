<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserTaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompletedTaskController;
use App\Http\Controllers\UserCompletedTaskController;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [SiteController::class, 'landing']);
    Route::get('/login', [SiteController::class, 'login'])->name('login');
    Route::get('/register', [SiteController::class, 'register']);
    Route::post('/register/new-user', [AuthController::class, 'createUser']);
    Route::post('/login', [AuthController::class, 'authenticate']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/home', [DashboardController::class, 'index']);

    Route::group(['middleware' => ['role:Administrator']], function() {
        // Users
        Route::get('/admin/users', [UserController::class, 'index']);
        Route::get('/admin/users/create', [UserController::class, 'create']);
        Route::post('/admin/users', [UserController::class, 'store']);
        Route::get('/admin/users/edit/{user}', [UserController::class, 'edit']);
        Route::patch('/admin/users/{user}', [UserController::class, 'update']);
        Route::delete('/admin/users/delete/{user}', [UserController::class, 'destroy']);
    });

    Route::group(['middleware' => ['role:Administrator|Manager']], function() {
        // Tasks
        Route::get('/tasks', [TaskController::class, 'index']);
        Route::get('/tasks/create', [TaskController::class, 'create']);
        Route::get('/tasks/edit/{task}', [TaskController::class, 'edit']);
        Route::get('/tasks/view-details/{task}', [TaskController::class, 'show']);
        Route::patch('/tasks/update/{task}', [TaskController::class, 'update']);
        Route::post('/tasks', [TaskController::class, 'store']);
        Route::post('/tasks/toggle-complete/{task}', [TaskController::class, 'toggleComplete']);
        Route::delete('/tasks/delete/{task}', [TaskController::class, 'destroy']);

        Route::get('/tasks/completed', [CompletedTaskController::class, 'index']);
        Route::delete('/tasks/completed/delete/{task}', [CompletedTaskController::class, 'destroy']);
    });

    Route::group(['middleware' => ['role:User']], function() {

        Route::get('/my-tasks', [UserTaskController::class, 'index']);
        Route::post('/my-tasks/toggle-complete/{task}', [UserTaskController::class, 'toggleComplete']);
        
        Route::get('/my-completed-tasks', [UserCompletedTaskController::class, 'index']);

    });
});

// require __DIR__.'/auth.php';
