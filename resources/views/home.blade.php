<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Bienvenido a MusanFilms</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&family=Poppins:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('storage/css/home.css') }}">

</head>
<body>

<div class="navbar">
  <h1>MUSANFILMS</h1>
  <div class="nav-right">
    @auth
      <span class="username">{{ Auth::user()->nombre }}</span>

      @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.panel') }}" class="admin-btn">Administración</a>
      @endif

      <a href="{{ route('logout') }}"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Cerrar sesión
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
      </form>
    @endauth
  </div>
</div>

<div class="content">
  @foreach($generos as $index => $genero)
    <div class="section-title">{{ $genero->nombre }}</div>
    <div class="carousel-container">
      <button class="arrow left" onclick="scrollCarousel({{ $index }}, -1)"> </button>
      <div class="carrusel" id="carrusel-{{ $index }}">
        {{-- Películas --}}
        @foreach($genero->peliculas as $pelicula)
          <a href="{{ route('reproducir.pelicula', $pelicula->id) }}">
            <div class="card">
              <img src="{{ $pelicula->portada ? asset('storage/' . $pelicula->portada) : 'https://via.placeholder.com/180x270' }}" alt="{{ $pelicula->titulo }}">
              <p>{{ $pelicula->titulo }}</p>
            </div>
          </a>
        @endforeach

        {{-- Series --}}
        @foreach($genero->series as $serie)
          <a href="{{ route('reproducir.serie', $serie->id) }}">
            <div class="card">
              <img src="{{ $serie->portada ? asset('storage/' . $serie->portada) : 'https://via.placeholder.com/180x270' }}" alt="{{ $serie->titulo }}">
              <p>{{ $serie->titulo }}</p>
            </div>
          </a>
        @endforeach
      </div>
      <button class="arrow right" onclick="scrollCarousel({{ $index }}, 1)"> </button>
    </div>
  @endforeach
</div>

<script>
  function scrollCarousel(index, direction) {
    const carrusel = document.getElementById('carrusel-' + index);
    const scrollAmount = 220;
    carrusel.scrollBy({ left: scrollAmount * direction, behavior: 'smooth' });
  }
</script>

</body>
</html>
