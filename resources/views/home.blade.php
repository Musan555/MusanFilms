<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bienvenido a MusanFilms</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #0f0f0f;
            color: white;
        }

        .navbar {
            background-color: #1f75fe;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
        }

        .navbar a, .admin-btn, .username {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-left: 20px;
            background-color: #0f56c1;
            padding: 8px 15px;
            border-radius: 5px;
        }

        .navbar a:hover, .admin-btn:hover {
            background-color: #084aa8;
        }

        .content {
            padding: 40px;
        }

        .section-title {
            font-size: 1.8em;
            margin: 20px 0 10px 10px;
        }

        .carousel-container {
            position: relative;
        }

        .carrusel {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            padding: 10px;
            scroll-behavior: smooth;
        }

        .card {
            flex: 0 0 auto;
            width: 180px;
            background-color: #1e1e1e;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 270px;
            object-fit: cover;
            border-radius: 10px;
        }

        .card p {
            margin-top: 10px;
            font-size: 1em;
        }

        .carrusel::-webkit-scrollbar {
            display: none;
        }

        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0,0,0,0.5);
            border: none;
            color: white;
            font-size: 2rem;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .arrow.left {
            left: 0;
        }

        .arrow.right {
            right: 0;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>MusanFilms</h1>
        <div>
            @auth
                <span class="username">{{ Auth::user()->nombre }}</span>

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.panel') }}">Administración</a>
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
                <button class="arrow left" onclick="scrollCarousel({{ $index }}, -1)">‹</button>
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
                <button class="arrow right" onclick="scrollCarousel({{ $index }}, 1)">›</button>
            </div>
        @endforeach
    </div>

    <script>
        function scrollCarousel(index, direction) {
            const carrusel = document.getElementById('carrusel-' + index);
            const scrollAmount = 220; // ajusta si quieres más o menos deslizamiento
            carrusel.scrollBy({ left: scrollAmount * direction, behavior: 'smooth' });
        }
    </script>

</body>
</html>
