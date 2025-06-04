<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Película - MusanFilms</title>
</head>
<body>
    <div class="container">
        <h1>Crear Película</h1>

        @if (session('success'))
            <div style="color: green; font-weight: bold;">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.guardar.pelicula') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="titulo">Título</label><br>
            <input type="text" name="titulo" required><br><br>

            <label for="descripcion">Descripción</label><br>
            <textarea name="descripcion" rows="4" required></textarea><br><br>

            <label for="duracion">Duración (minutos)</label><br>
            <input type="number" name="duracion" required><br><br>

            <label for="anio_estreno">Año de Estreno</label><br>
            <input type="number" name="anio_estreno" required><br><br>

            <label for="genero_id" class="form-label">Géneros</label><br>
            @foreach($generos as $genero)
                <label>
                    <input type="checkbox" name="genero_id[]" value="{{ $genero->id }}">
                    {{ $genero->nombre }}
                </label><br>
            @endforeach


            <label for="categoria_id">Categoría</label><br>
            <select name="categoria_id" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select><br><br>

            <label for="portada">Portada</label><br>
            <input type="file" name="portada" required><br><br>

            <label for="url">URL de reproducción</label><br>
            <input type="url" name="url"><br><br>
            
            <button type="submit">Guardar Película</button>
            <a href="{{ route('admin.panel') }}" style="margin-left: 10px;">
                <button type="button">Volver al Panel</button>
            </a>
        </form>
    </div>
</body>
</html>