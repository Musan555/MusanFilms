<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Panel de Administración</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{ asset('storage/css/panel.css') }}">
 
</head>
<body>
  <div class="navbar">
    <h1>Panel de Administración</h1>
    <div>
      <a href="{{ route('home') }}" class="btn">Volver al inicio</a>
    </div>
  </div>

  <div class="content">
    <h2>¿Qué deseas gestionar?</h2>

    <a href="{{ route('admin.crear.pelicula') }}" class="btn">Crear Película</a>
    <a href="{{ route('admin.crear.serie') }}" class="btn">Crear Serie</a>

    <h2>Películas Existentes</h2>
    <table>
      <colgroup>
        <col style="width: 20%" />
        <col style="width: 40%" />
        <col style="width: 40%" />
      </colgroup>
      <thead>
        <tr>
          <th>Portada</th>
          <th>Título</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($peliculas as $pelicula)
        <tr>
          <td data-label="Portada">
            <img src="{{ asset('storage/' . $pelicula->portada) }}" alt="Portada" />
          </td>
          <td data-label="Título">{{ $pelicula->titulo }}</td>
          <td data-label="Acciones">
            <a href="{{ route('admin.editar.pelicula', $pelicula->id) }}" class="btn">Editar</a>
            <form action="{{ route('admin.eliminar.pelicula', $pelicula->id) }}" method="POST" style="display: inline;">
              @csrf @method('DELETE')
              <button class="btn btn-danger" onclick="return confirm('¿Eliminar película?')">Eliminar</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <h2>Series Existentes</h2>
    <table>
      <colgroup>
        <col style="width: 20%" />
        <col style="width: 40%" />
        <col style="width: 40%" />
      </colgroup>
      <thead>
        <tr>
          <th>Portada</th>
          <th>Título</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($series as $serie)
        <tr>
          <td data-label="Portada">
            <img src="{{ asset('storage/' . $serie->portada) }}" alt="Portada" />
          </td>
          <td data-label="Título">{{ $serie->titulo }}</td>
          <td data-label="Acciones">
            <a href="{{ route('admin.editar.serie', $serie->id) }}" class="btn">Editar</a>
            <form action="{{ route('admin.eliminar.serie', $serie->id) }}" method="POST" style="display: inline;">
              @csrf @method('DELETE')
              <button class="btn btn-danger" onclick="return confirm('¿Eliminar serie?')">Eliminar</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
