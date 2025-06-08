<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Editar Película</title>
  <link rel="stylesheet" href="{{ asset('storage/css/epeli.css') }}">
  
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
      <input type="number" id="duracion" name="duracion" value="{{ old('duracion', $pelicula->duracion) }}" placeholder="Duración" required min="1">

      <label for="anio_estreno">Año de estreno</label>
      <input type="number" id="anio_estreno" name="anio_estreno" value="{{ old('anio_estreno', $pelicula->anio_estreno) }}" placeholder="Año de estreno" required min="1888">

      <label for="url">URL (opcional)</label>
      <input type="url" id="url" name="url" value="{{ old('url', $pelicula->url) }}" placeholder="URL">

      <label>Géneros</label>
      <div class="checkbox-group">
        @foreach($generos as $genero)
          <label>
            <input type="checkbox" name="genero_id[]" value="{{ $genero->id }}"
              {{ in_array($genero->id, old('genero_id', $pelicula->generos->pluck('id')->toArray())) ? 'checked' : '' }}>
            {{ $genero->nombre }}
          </label>
        @endforeach
      </div>

      <label for="categoria_id">Categoría</label>
      <select id="categoria_id" name="categoria_id" required>
        @foreach($categorias as $categoria)
          <option value="{{ $categoria->id }}" {{ old('categoria_id', $pelicula->categoria_id) == $categoria->id ? 'selected' : '' }}>
            {{ $categoria->nombre }}
          </option>
        @endforeach
      </select>

      <label for="portada">Portada (opcional)</label>
      <input type="file" id="portada" name="portada" accept="image/*">

      <button type="submit">Actualizar Película</button>
    </form>
  </div>
</body>
</html>
