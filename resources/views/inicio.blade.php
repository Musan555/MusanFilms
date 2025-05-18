<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a MusanFilms</title>
    <style>
        /* Estilos básicos */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('https://via.placeholder.com/1920x1080'); /* Imagen de fondo */
            background-size: cover;
            background-position: center;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            background: rgba(0, 0, 0, 0.7);  /* Fondo oscuro con opacidad */
            padding: 50px;
            border-radius: 10px;
        }

        h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #1f75fe;  /* Azul en lugar de rojo */
            color: white;
            padding: 15px 40px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px;
            display: inline-block;
        }

        .btn:hover {
            background-color: #0f56c1;  /* Un azul más oscuro al pasar el ratón */
        }

        .info {
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Bienvenido a MusanFilms</h1>
        <p class="info">Disfruta de una amplia variedad de contenido en nuestra plataforma. Inicia sesión o regístrate para comenzar.</p>

        <div>
            <a href="{{ route('login') }}" class="btn">Iniciar sesión</a>
            <a href="{{ route('registro') }}" class="btn">Registrarse</a>
        </div>
    </div>

</body>
</html>
