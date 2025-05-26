<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar Película</title>
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
    <h2>Editar Película</h2>

    <form action="{{ route('admin.actualizar.pelicula', $pelicula->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $pelicula->titulo) }}" placeholder="Título" required>

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" placeholder="Descripción" required>{{ old('descripcion', $pelicula->descripcion) }}</textarea>

        <label for="duracion">Duración (minutos)</label>
        <input type="number" id="duracion" name="duracion" value="{{ old('duracion', $pelicula->duracion) }}" placeholder="Duración" required>

        <label for="anio_estreno">Año de estreno</label>
        <input type="number" id="anio_estreno" name="anio_estreno" value="{{ old('anio_estreno', $pelicula->anio_estreno) }}" placeholder="Año de estreno" required>

        <label for="url">URL (opcional)</label>
        <input type="url" id="url" name="url" value="{{ old('url', $pelicula->url) }}" placeholder="URL">

        <label>Géneros</label>
        <div class="checkbox-group">
            @foreach($generos as $genero)
                <label>
                    <input type="checkbox" name="genero_id[]" value="{{ $genero->id }}"
                    {{ in_array($genero->id, $pelicula->generos->pluck('id')->toArray()) ? 'checked' : '' }}>
                    {{ $genero->nombre }}
                </label>
            @endforeach
        </div>

        <label for="categoria_id">Categoría</label>
        <select id="categoria_id" name="categoria_id" required>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ $categoria->id == $pelicula->categoria_id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>

        <label for="portada">Portada (opcional)</label>
        <input type="file" id="portada" name="portada">

        <button type="submit">Actualizar Película</button>
    </form>
</div>
</body>
</html>
