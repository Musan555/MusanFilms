<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/inicio');
})->name('logout');

Route::get('/inicio', [LoginController::class, 'showWelcome'])->name('inicio');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/registro', [LoginController::class, 'showRegisterForm'])->name('registro'); // Cambiar a 'registro'
Route::post('/registro', [LoginController::class, 'registro'])->name('registro.post');  // Cambiar a 'registro'
Route::get('/home', [LoginController::class, 'showHome'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/crear-pelicula', [AdminController::class, 'crearPelicula'])->name('admin.crear.pelicula');
    Route::get('/admin/crear-serie', [AdminController::class, 'crearSerie'])->name('admin.crear.serie');
});