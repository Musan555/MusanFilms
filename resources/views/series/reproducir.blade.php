<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $serie->titulo }} - MusanFilms</title>
    <style>
        body {
            background-color: #0f0f0f;
            color: white;
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
        }
        img {
            max-width: 100%;
            border-radius: 10px;
        }
        .info {
            margin-top: 15px;
        }
        .temporada {
            margin-top: 30px;
            padding: 15px;
            background: #292929;
            border-radius: 8px;
        }
        .capitulo {
            margin-top: 10px;
            padding: 10px;
            background: #3a3a3a;
            border-radius: 6px;
            cursor: pointer;
        }
        .capitulo:hover {
            background-color: #1f75fe;
        }
        .iframe-container {
            margin-top: 10px;
            display: none;
        }
        iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 10px;
        }
        a.back-btn {
            background: #1f75fe;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" class="back-btn">‹ Volver</a>
    <div class="container">
        <h1>{{ $serie->titulo }}</h1>
        <img src="{{ $serie->portada ? asset('storage/' . $serie->portada) : 'https://via.placeholder.com/600x900' }}" alt="{{ $serie->titulo }}">

        <div class="info">
            <p><strong>Descripción:</strong> {{ $serie->descripcion }}</p>
            <p><strong>Año de lanzamiento:</strong> {{ $serie->fecha_lanzamiento }}</p>
            <p><strong>Categoría:</strong> {{ $serie->categoria->nombre ?? 'Sin categoría' }}</p>
            <p><strong>Géneros:</strong> 
                @foreach($serie->generos as $genero)
                    {{ $genero->nombre }}@if(!$loop->last), @endif
                @endforeach
            </p>
        </div>

        <h2>Temporadas y Capítulos</h2>

        @foreach($serie->temporadas as $temporada)
            <div class="temporada">
                <h3>Temporada {{ $temporada->numero }}</h3>
                @foreach($temporada->capitulos as $capitulo)
                    <div class="capitulo" onclick="mostrarReproductor('player-{{ $capitulo->id }}')">
                        Capítulo {{ $capitulo->numero }} - {{ $capitulo->titulo }}
                        <div class="iframe-container" id="player-{{ $capitulo->id }}">
                            <iframe src="{{ $capitulo->url }}" allowfullscreen allow="autoplay; encrypted-media"></iframe>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <script>
        function mostrarReproductor(id) {
            // Ocultar todos los reproductores
            document.querySelectorAll('.iframe-container').forEach(el => {
                el.style.display = 'none';
            });
            // Mostrar el reproductor seleccionado
            const player = document.getElementById(id);
            if(player) {
                player.style.display = 'block';
                // Opcional: hacer scroll al reproductor
                player.scrollIntoView({behavior: 'smooth'});
            }
        }
    </script>
</body>
</html>
