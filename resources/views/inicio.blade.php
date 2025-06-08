<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bienvenido a MusanFilms</title>

  <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('storage/css/inicio.css') }}">
 
</head>
<body>

  <div class="title">MUSANFILMS</div>

  <div class="container">
    <div class="image-wrapper">
      <img src="{{ asset('storage/images/inicio.jpg') }}" alt="Imagen de portada escritorio" class="desktop-img" />
      <img src="{{ asset('storage/images/inicio-movil.jpg') }}" alt="Imagen de portada móvil" class="mobile-img" />
      <div class="overlay"></div>

      <div class="buttons">
        <a href="{{ route('registro') }}" class="btn register">Registrarse</a>
        <a href="{{ route('login') }}" class="btn login">Iniciar sesión</a>
      </div>
    </div>
  </div>

</body>
</html>
