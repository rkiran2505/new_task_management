<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');

// Task-related routes
// Route::middleware(['auth'])->group(function () {
//     Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
//     Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
//     Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
// });

Route::middleware(['auth'])->group(function () {
    // View all tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    
    // Create task
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    
    // Edit task - Show edit form
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    
    // Update task - Handle form submission
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});