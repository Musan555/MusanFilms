<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $pelicula->titulo }} - MusanFilms</title>
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
        button.play-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1.1rem;
            background-color: #1f75fe;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button.play-btn:hover {
            background-color: #084aa8;
        }
        .iframe-container {
            margin-top: 20px;
            display: none;
        }
        iframe {
            width: 100%;
            height: 450px;
            border: none;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <a href="{{ route('home') }}" style="background: #1f75fe; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none;">‹ Volver</a>
    <div class="container">
        <h1>{{ $pelicula->titulo }}</h1>
        <img src="{{ $pelicula->portada ? asset('storage/' . $pelicula->portada) : 'https://via.placeholder.com/600x900' }}" alt="{{ $pelicula->titulo }}">

        <div class="info">
            <p><strong>Descripción:</strong> {{ $pelicula->descripcion }}</p>
            <p><strong>Duración:</strong> {{ $pelicula->duracion }} minutos</p>
            <p><strong>Año de estreno:</strong> {{ $pelicula->anio_estreno }}</p>
            <p><strong>Categoría:</strong> {{ $pelicula->categoria->nombre ?? 'Sin categoría' }}</p>
        </div>

        <button class="play-btn" onclick="mostrarReproductor()">Reproducir</button>

        <div class="iframe-container" id="player-container">
            <iframe src="{{ $pelicula->url }}" allowfullscreen allow="autoplay; encrypted-media"></iframe>
        </div>
    </div>

    <script>
        function mostrarReproductor() {
            const container = document.getElementById('player-container');
            container.style.display = 'block';
            // Opcional: hacer que el botón desaparezca al pulsarlo
            event.target.style.display = 'none';
        }
    </script>
</body>
</html>
