<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function crearPelicula()
    {
        return view('admin.crear-pelicula'); // Crea esta vista con tu formulario para crear película
    }

    public function crearSerie()
    {
        return view('admin.crear-serie'); // Igual para la creación de serie
    }
}
