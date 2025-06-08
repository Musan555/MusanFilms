<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Iniciar sesión - MusanFilms</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Tipografía -->
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="{{ asset('storage/css/login.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('{{ asset("storage/images/inicio.jpg") }}') no-repeat center center fixed;
            background-size: cover;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="title-up">MUSANFILMS</div>

    <div class="title">Iniciar sesión</div>

    <div class="form-container">
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            @if(session('error'))
                <p class="error-message">{{ session('error') }}</p>
            @endif

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required autofocus />

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required />

            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>


