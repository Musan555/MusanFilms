<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Serie;
use App\Models\Genero;

class HomeController extends Controller
{
    public function index()
    {
        // Traemos géneros con sus películas y series para organizar la vista
        $generos = Genero::with(['peliculas', 'series'])->get();

        return view('home', compact('generos'));
    }
}
