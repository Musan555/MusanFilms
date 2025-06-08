<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $pelicula->titulo }} - MusanFilms</title>
  <link rel="stylesheet" href="{{ asset('storage/css/repropeli.css') }}">

</head>
<body>

<a href="{{ route('home') }}" class="volver">‹ Volver</a>

<div class="container">
  <div class="poster">
    <img src="{{ $pelicula->portada ? asset('storage/' . $pelicula->portada) : 'https://via.placeholder.com/600x900' }}" alt="{{ $pelicula->titulo }}">
  </div>

  <div class="info">
    <h1>{{ $pelicula->titulo }}</h1>
    <p><strong>Sinopsis:</strong> {{ $pelicula->descripcion }}</p>

    <div class="tags">
      <span>Categoría: {{ $pelicula->categoria->nombre ?? 'Sin categoría' }}</span>
      <span>Duración: {{ $pelicula->duracion }} min</span>
      <span>Año: {{ $pelicula->anio_estreno }}</span>
    </div>

    <button class="play-btn" onclick="mostrarReproductor(this)">Reproducir</button>
  </div>
</div>

<div class="iframe-container" id="player-container">
  <iframe src="{{ $pelicula->url }}" allowfullscreen allow="autoplay; encrypted-media"></iframe>
</div>

<script>
  function mostrarReproductor(btn) {
    document.getElementById('player-container').style.display = 'block';
    btn.style.display = 'none';
    window.scrollTo({
      top: document.getElementById('player-container').offsetTop - 20,
      behavior: 'smooth'
    });
  }
</script>

</body>
</html>
