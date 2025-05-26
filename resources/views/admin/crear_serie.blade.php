<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Serie - MusanFilms</title>
</head>
<body>
    <div class="container">
        <h1>Crear Serie</h1>

        @if (session('success'))
            <div style="color: green; font-weight: bold;">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.guardar.serie') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="titulo">Título</label><br>
            <input type="text" name="titulo" required><br><br>

            <label for="descripcion">Descripción</label><br>
            <textarea name="descripcion" rows="4" required></textarea><br><br>

            <label for="temporadas">Temporadas</label><br>
            <input type="number" name="temporadas" required><br><br>

            <label for="capitulos_por_temporada">Capítulos por Temporada</label><br>
            <input type="number" name="capitulos_por_temporada" required><br><br>

            <label for="fecha_lanzamiento">Año de Lanzamiento</label><br>
            <input type="number" name="fecha_lanzamiento" required><br><br>

            <label for="genero_id">Géneros</label><br>
            <select name="genero_id[]" multiple required>
                @foreach($generos as $genero)
                    <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                @endforeach
            </select><br><br>

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
            
            <button type="submit">Guardar Serie</button>
            <a href="{{ route('admin.panel') }}" style="margin-left: 10px;">
                <button type="button">Volver al Panel</button>
            </a>
        </form>
    </div>
</body>
</html>
