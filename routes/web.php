<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('/admin/auth')->name('admin.auth.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('login.post');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('tasks')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', App\Livewire\Tasks\Index::class)->name('tasks.index');
    Route::get('/create',[\App\Http\Controllers\TaskController::class,'create'] )->middleware(['auth'])->name('tasks.create');
    Route::get('/{task}/edit',App\Livewire\Tasks\Edit::class)->middleware(['auth'])->name('tasks.edit');
    Route::post('/store', [\App\Http\Controllers\TaskController::class,'store'])->middleware(['auth'])->name('tasks.store');
});

require __DIR__.'/auth.php';
