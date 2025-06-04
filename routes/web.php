<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;  
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SerieController;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/inicio');
})->name('logout');

// Rutas públicas
Route::get('/inicio', [LoginController::class, 'showWelcome'])->name('inicio');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/registro', [LoginController::class, 'showRegisterForm'])->name('registro');
Route::post('/registro', [LoginController::class, 'registro'])->name('registro.post');

// Ruta principal para usuarios autenticados
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Reproducción y detalle
    Route::get('/pelicula/{id}', [PeliculaController::class, 'reproducir'])->name('reproducir.pelicula');
    Route::get('/serie/{id}', [SerieController::class, 'reproducir'])->name('reproducir.serie');

    // Panel principal
    Route::get('/admin', [AdminController::class, 'panel'])->name('admin.panel');

    // Crear películas
    Route::get('/admin/crear-pelicula', [AdminController::class, 'crearPelicula'])->name('admin.crear.pelicula');
    Route::post('/admin/peliculas/guardar', [AdminController::class, 'guardarPelicula'])->name('admin.guardar.pelicula');

    // Crear series
    Route::get('/admin/crear-serie', [AdminController::class, 'crearSerie'])->name('admin.crear.serie');
    Route::post('/admin/series/guardar', [AdminController::class, 'guardarSerie'])->name('admin.guardar.serie');

    // Editar y eliminar películas
    Route::get('/admin/peliculas/{id}/editar', [AdminController::class, 'editarPelicula'])->name('admin.editar.pelicula');
    Route::put('/admin/peliculas/{id}', [AdminController::class, 'actualizarPelicula'])->name('admin.actualizar.pelicula');
    Route::delete('/admin/peliculas/{id}', [AdminController::class, 'eliminarPelicula'])->name('admin.eliminar.pelicula');

    // Editar y eliminar series
    Route::get('/admin/series/{id}/editar', [AdminController::class, 'editarSerie'])->name('admin.editar.serie');
    Route::put('/admin/series/{id}', [AdminController::class, 'actualizarSerie'])->name('admin.actualizar.serie');
    Route::delete('/admin/series/{id}', [AdminController::class, 'eliminarSerie'])->name('admin.eliminar.serie');


});
