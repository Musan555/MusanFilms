<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0f0f0f;
            color: white;
            margin: 0;
            padding: 0;
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
            font-size: 24px;
        }

        .content {
            padding: 40px;
            text-align: center;
        }

        .btn {
            display: inline-block;
            margin: 15px;
            padding: 15px 30px;
            background-color: #1f75fe;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #155cc4;
        }
    </style>
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
        <table style="width: 100%; margin-top: 30px; color: white; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #1f75fe;">
                    <th style="padding: 10px;">Portada</th>
                    <th style="padding: 10px;">Título</th>
                    <th style="padding: 10px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peliculas as $pelicula)
                    <tr style="border-bottom: 1px solid #444;">
                        <td style="padding: 10px;">
                            <img src="{{ asset('storage/' . $pelicula->portada) }}" alt="Portada" style="height: 100px; border-radius: 8px;">
                        </td>
                        <td style="padding: 10px;">{{ $pelicula->titulo }}</td>
                        <td style="padding: 10px;">
                            <a href="{{ route('admin.editar.pelicula', $pelicula->id) }}" class="btn">Editar</a>
                            <form action="{{ route('admin.eliminar.pelicula', $pelicula->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn" onclick="return confirm('¿Eliminar película?')" style="background-color: crimson;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 style="margin-top: 50px;">Series Existentes</h2>
        <table style="width: 100%; margin-top: 30px; color: white; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #1f75fe;">
                    <th style="padding: 10px;">Portada</th>
                    <th style="padding: 10px;">Título</th>
                    <th style="padding: 10px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($series as $serie)
                    <tr style="border-bottom: 1px solid #444;">
                        <td style="padding: 10px;">
                            <img src="{{ asset('storage/' . $serie->portada) }}" alt="Portada" style="height: 100px; border-radius: 8px;">
                        </td>
                        <td style="padding: 10px;">{{ $serie->titulo }}</td>
                        <td style="padding: 10px;">
                            <a href="{{ route('admin.editar.serie', $serie->id) }}" class="btn">Editar</a>
                            <form action="{{ route('admin.eliminar.serie', $serie->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn" onclick="return confirm('¿Eliminar serie?')" style="background-color: crimson;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>

</body>
</html>
