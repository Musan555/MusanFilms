<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h2>Registro de Usuario</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('registro.post') }}">
        @csrf

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required><br><br>

        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="password_confirmation">Confirmar contraseña:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}"><br><br>

        <label for="suscripcion">Suscripción:</label>
        <select name="suscripcion" id="suscripcion" required>
            <option value="">Selecciona...</option>
            <option value="mensual">Mensual</option>
            <option value="anual">Anual</option>
        </select><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <p><a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión aquí</a></p>
</body>
</html>
