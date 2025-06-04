<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Categoria;
use App\Models\Pelicula;
use App\Models\Serie;
use App\Models\Temporada;
use App\Models\Capitulo;
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
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_lanzamiento' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'portada' => 'required|image',
            'genero_id' => 'required|array',
            'genero_id.*' => 'exists:generos,id',
            'temporadas' => 'array',
        ]);

        // Guardar portada
        $portadaPath = $request->file('portada')->store('portadas', 'public');

        // Crear la serie
        $serie = Serie::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_lanzamiento' => $request->fecha_lanzamiento,
            'categoria_id' => $request->categoria_id,
            'portada' => $portadaPath,
        ]);

        // Asociar géneros
        $serie->generos()->sync($request->genero_id);

        // Guardar temporadas y capítulos (normalizando índices)
        if ($request->has('temporadas')) {
            $temporadas = array_values($request->temporadas);
            foreach ($temporadas as $tempData) {
                $temporada = $serie->temporadas()->create([
                    'numero' => $tempData['numero'] ?? 1,
                ]);

                if (isset($tempData['capitulos']) && is_array($tempData['capitulos'])) {
                    $capitulos = array_values($tempData['capitulos']);
                    foreach ($capitulos as $cap) {
                        $temporada->capitulos()->create([
                            'numero' => $cap['numero'] ?? 1,
                            'titulo' => $cap['titulo'],
                            'url' => $cap['url'],
                            'duracion' => $cap['duracion'] ?? 0,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.crear.serie')->with('success', 'Serie, temporadas y capítulos creados con éxito');
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
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'fecha_lanzamiento' => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
        'portada' => 'nullable|image',
        'genero_id' => 'required|array',
        'genero_id.*' => 'exists:generos,id',
        'temporadas' => 'nullable|array',
    ]);

    $serie = Serie::findOrFail($id);

    // Portada
    if ($request->hasFile('portada')) {
        Storage::disk('public')->delete($serie->portada);
        $path = $request->file('portada')->store('portadas', 'public');
        $serie->portada = $path;
    }

    // Datos principales
    $serie->update([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'fecha_lanzamiento' => $request->fecha_lanzamiento,
        'categoria_id' => $request->categoria_id,
    ]);

    // Géneros
    $serie->generos()->sync($request->genero_id);

    // Eliminar temporadas y capítulos antiguos
    $serie->temporadas()->each(function($temp) {
        $temp->capitulos()->delete();
        $temp->delete();
    });

    // Nuevas temporadas y capítulos
    if ($request->filled('temporadas')) {
        foreach (array_values($request->temporadas) as $tempData) {
            $temporada = $serie->temporadas()->create([
                'numero' => $tempData['numero'] ?? 1,
            ]);

            if (!empty($tempData['capitulos']) && is_array($tempData['capitulos'])) {
                foreach (array_values($tempData['capitulos']) as $i => $cap) {
                    $temporada->capitulos()->create([
                        'numero' => $cap['numero'] ?? $i + 1,
                        'titulo' => $cap['titulo'],
                        'url' => $cap['url'],
                        'duracion' => $cap['duracion'] ?? 0,
                    ]);
                }
            }
        }
    }

    return redirect()->route('admin.panel')->with('success', 'Serie actualizada con éxito');
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
