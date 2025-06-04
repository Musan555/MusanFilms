<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function reproducir($id)
    {
        $pelicula = Pelicula::findOrFail($id);
        return view('peliculas.reproducir', compact('pelicula'));
    }
}
