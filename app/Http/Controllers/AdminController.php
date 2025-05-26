<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Categoria;
use App\Models\Pelicula;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function panel()
    {
        $peliculas = Pelicula::with('categoria')->get();
        $series = Serie::with('categoria')->get();

        return view('admin.panel', compact('peliculas', 'series'));
    }
    
    public function crearPelicula()
    {
        $generos = Genero::all();
        $categorias = Categoria::all();
        return view('admin.crear_pelicula', compact('generos', 'categorias'));
    }

    public function guardarPelicula(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'duracion' => 'required|integer',
            'anio_estreno' => 'required|integer',
            'genero_id' => 'required|array',
            'genero_id.*' => 'exists:generos,id',
            'categoria_id' => 'required|exists:categorias,id',
            'portada' => 'required|image',
            'url' => 'nullable|url',
        ]);

        $path = $request->file('portada')->store('portadas', 'public');

        $pelicula = Pelicula::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'duracion' => $request->duracion,
            'anio_estreno' => $request->anio_estreno,
            'categoria_id' => $request->categoria_id,
            'portada' => $path,
            'url' => $request->url,
        ]);

        $pelicula->generos()->sync($request->genero_id);

        return redirect()->back()->with('success', 'Película creada con éxito');
    }

    public function crearSerie()
    {
        $generos = Genero::all();
        $categorias = Categoria::all();
        return view('admin.crear_serie', compact('generos', 'categorias'));
    }

    public function guardarSerie(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'temporadas' => 'required|integer',
            'capitulos_por_temporada' => 'required|integer',
            'fecha_lanzamiento' => 'required|integer',
            'genero_id' => 'required|array',
            'genero_id.*' => 'exists:generos,id',
            'categoria_id' => 'required|exists:categorias,id',
            'portada' => 'required|image',
            'url' => 'nullable|url',
        ]);

        $path = $request->file('portada')->store('portadas', 'public');

        $serie = Serie::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'temporadas' => $request->temporadas,
            'capitulos_por_temporada' => $request->capitulos_por_temporada,
            'fecha_lanzamiento' => $request->fecha_lanzamiento,
            'categoria_id' => $request->categoria_id,
            'portada' => $path,
            'url' => $request->url,
        ]);

        $serie->generos()->sync($request->genero_id);

        return redirect()->back()->with('success', 'Serie creada con éxito');
    }

    // Editar película
public function editarPelicula($id)
{
    $pelicula = Pelicula::with('generos')->findOrFail($id);
    $generos = Genero::all();
    $categorias = Categoria::all();

    return view('admin.editar_pelicula', compact('pelicula', 'generos', 'categorias'));
}

// Actualizar película
public function actualizarPelicula(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required',
        'descripcion' => 'required',
        'duracion' => 'required|integer',
        'anio_estreno' => 'required|integer',
        'genero_id' => 'required|array',
        'genero_id.*' => 'exists:generos,id',
        'categoria_id' => 'required|exists:categorias,id',
        'portada' => 'nullable|image',
        'url' => 'nullable|url',
    ]);

    $pelicula = Pelicula::findOrFail($id);

    if ($request->hasFile('portada')) {
        Storage::disk('public')->delete($pelicula->portada);
        $path = $request->file('portada')->store('portadas', 'public');
        $pelicula->portada = $path;
    }

    $pelicula->update([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'duracion' => $request->duracion,
        'anio_estreno' => $request->anio_estreno,
        'categoria_id' => $request->categoria_id,
        'url' => $request->url,
    ]);

    $pelicula->generos()->sync($request->genero_id);

    return redirect()->route('admin.panel')->with('success', 'Película actualizada');
}

// Eliminar película
public function eliminarPelicula($id)
{
    $pelicula = Pelicula::findOrFail($id);
    Storage::disk('public')->delete($pelicula->portada);
    $pelicula->generos()->detach();
    $pelicula->delete();

    return redirect()->route('admin.panel')->with('success', 'Película eliminada');
}

// Editar serie
public function editarSerie($id)
{
    $serie = Serie::with('generos')->findOrFail($id);
    $generos = Genero::all();
    $categorias = Categoria::all();

    return view('admin.editar_serie', compact('serie', 'generos', 'categorias'));
}

// Actualizar serie
public function actualizarSerie(Request $request, $id)
{
    $request->validate([
        'titulo' => 'required',
        'descripcion' => 'required',
        'temporadas' => 'required|integer',
        'capitulos_por_temporada' => 'required|integer',
        'fecha_lanzamiento' => 'required|integer',
        'genero_id' => 'required|array',
        'genero_id.*' => 'exists:generos,id',
        'categoria_id' => 'required|exists:categorias,id',
        'portada' => 'nullable|image',
        'url' => 'nullable|url',
    ]);

    $serie = Serie::findOrFail($id);

    if ($request->hasFile('portada')) {
        Storage::disk('public')->delete($serie->portada);
        $path = $request->file('portada')->store('portadas', 'public');
        $serie->portada = $path;
    }

    $serie->update([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'temporadas' => $request->temporadas,
        'capitulos_por_temporada' => $request->capitulos_por_temporada,
        'fecha_lanzamiento' => $request->fecha_lanzamiento,
        'categoria_id' => $request->categoria_id,
        'url' => $request->url,
    ]);

    $serie->generos()->sync($request->genero_id);

    return redirect()->route('admin.panel')->with('success', 'Serie actualizada');
}

// Eliminar serie
public function eliminarSerie($id)
{
    $serie = Serie::findOrFail($id);
    Storage::disk('public')->delete($serie->portada);
    $serie->generos()->detach();
    $serie->delete();

    return redirect()->route('admin.panel')->with('success', 'Serie eliminada');
}

}
