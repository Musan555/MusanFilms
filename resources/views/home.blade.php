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

        .navbar a, .admin-btn {
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
            font-size: 2em;
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #1e1e1e;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
        }

        .card img {
            max-width: 100%;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>MusanFilms</h1>
        <div>
            @auth
                @if(Auth::user() && Auth::user()->role === 'admin')
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
        <div class="section-title">Películas destacadas</div>
        <div class="grid">
            <div class="card">
                <img src="https://via.placeholder.com/200x300" alt="Pelicula" />
                <p>Nombre de la Película</p>
            </div>
            <div class="card">
                <img src="https://via.placeholder.com/200x300" alt="Pelicula" />
                <p>Otra Película</p>
            </div>
        </div>
    </div>

</body>
</html>

