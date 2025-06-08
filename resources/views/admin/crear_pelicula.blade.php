<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Crear Película - MusanFilms</title>
  <link rel="stylesheet" href="{{ asset('storage/css/cpeli.css') }}">
  
</head>
<body>
  <div class="container">
    <h1>Crear Película</h1>

    @if (session('success'))
      <div class="success-message">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.guardar.pelicula') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <label for="titulo">Título</label>
      <input type="text" id="titulo" name="titulo" required placeholder="Título de la película">

      <label for="descripcion">Descripción</label>
      <textarea id="descripcion" name="descripcion" rows="4" required placeholder="Descripción"></textarea>

      <label for="duracion">Duración (minutos)</label>
      <input type="number" id="duracion" name="duracion" min="1" required placeholder="Duración en minutos">

      <label for="anio_estreno">Año de Estreno</label>
      <input type="number" id="anio_estreno" name="anio_estreno" min="1888" required placeholder="Año de estreno">

      <label>Géneros</label>
      <div class="checkbox-group">
        @foreach($generos as $genero)
          <label>
            <input type="checkbox" name="genero_id[]" value="{{ $genero->id }}">
            {{ $genero->nombre }}
          </label>
        @endforeach
      </div>

      <label for="categoria_id">Categoría</label>
      <select id="categoria_id" name="categoria_id" required>
        @foreach($categorias as $categoria)
          <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
        @endforeach
      </select>

      <label for="portada">Portada</label>
      <input type="file" id="portada" name="portada" accept="image/*" required>

      <label for="url">URL de reproducción (opcional)</label>
      <input type="url" id="url" name="url" placeholder="URL de reproducción">

      <div class="btn-group">
        <button type="submit">Guardar Película</button>
        <a href="{{ route('admin.panel') }}" class="btn-back" role="button">Volver al Panel</a>
      </div>
    </form>
  </div>
</body>
</html>
