<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar Serie</title>
    <style>
        body {
            background-color: #121212;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: #222;
            padding: 30px;
            border-radius: 8px;
        }
        input[type="text"], input[type="number"], input[type="url"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: none;
            font-size: 1em;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        button {
            background-color: #1f75fe;
            color: white;
            font-weight: bold;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #155cc4;
        }
        .checkbox-group label {
            font-weight: normal;
            display: inline-block;
            margin-right: 15px;
        }
        .checkbox-group input[type="checkbox"] {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Editar Serie</h2>

    <form action="{{ route('admin.actualizar.serie', $serie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $serie->titulo) }}" placeholder="Título" required>

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" placeholder="Descripción" required>{{ old('descripcion', $serie->descripcion) }}</textarea>

        <label for="temporadas">Temporadas</label>
        <input type="number" id="temporadas" name="temporadas" value="{{ old('temporadas', $serie->temporadas) }}" placeholder="Temporadas" required>

        <label for="capitulos_por_temporada">Capítulos por temporada</label>
        <input type="number" id="capitulos_por_temporada" name="capitulos_por_temporada" value="{{ old('capitulos_por_temporada', $serie->capitulos_por_temporada) }}" placeholder="Capítulos por temporada" required>

        <label for="fecha_lanzamiento">Año de lanzamiento</label>
        <input type="number" id="fecha_lanzamiento" name="fecha_lanzamiento" value="{{ old('fecha_lanzamiento', $serie->fecha_lanzamiento) }}" placeholder="Año de lanzamiento" required>

        <label for="url">URL (opcional)</label>
        <input type="url" id="url" name="url" value="{{ old('url', $serie->url) }}" placeholder="URL">

        <label>Géneros</label>
        <div class="checkbox-group">
            @foreach($generos as $genero)
                <label>
                    <input type="checkbox" name="genero_id[]" value="{{ $genero->id }}"
                    {{ in_array($genero->id, $serie->generos->pluck('id')->toArray()) ? 'checked' : '' }}>
                    {{ $genero->nombre }}
                </label>
            @endforeach
        </div>

        <label for="categoria_id">Categoría</label>
        <select id="categoria_id" name="categoria_id" required>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ $categoria->id == $serie->categoria_id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>

        <label for="portada">Portada (opcional)</label>
        <input type="file" id="portada" name="portada">

        <button type="submit">Actualizar Serie</button>
    </form>
</div>
</body>
</html>
