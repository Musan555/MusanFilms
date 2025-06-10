<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Registro - MusanFilms</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Tipografía -->
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('storage/css/registro.css') }}">

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
    <div class="title">Registro Usuarios</div>

    <div class="form-container">
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('registro.post') }}" id="registroForm" autocomplete="off">
            @csrf

            <label for="nombre">Nombre completo:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required autofocus />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required />

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" maxlength="9" value="{{ old('telefono') }}" required />   

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required />

            <label for="password_confirmation">Confirmar contraseña:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required />

            <label>Tipo de suscripción:</label>
            <div style="display:flex; gap:10px; margin-bottom:15px;">
                <button type="button" class="subs-btn" data-value="mensual">Mensual</button>
                <button type="button" class="subs-btn" data-value="anual">Anual</button>
            </div>
            <input type="hidden" name="suscripcion" id="suscripcion" />
            <div id="precioSeleccionado" style="margin-bottom: 15px; font-weight: 700; font-size: 1.1em;"></div>

            <button type="submit" id="btnSubmit">Registrarse</button>
        </form>

        <div class="login-link">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>.
        </div>
    </div>

    <!-- Modal Pago -->
    <div id="modalPago">
        <div class="modal-content">
            <h3>Pago Seguro</h3>
            <p class="price">Precio: <span id="precioPago"></span></p>

            <label for="tarjeta">Número de tarjeta:</label>
            <input type="text" id="tarjeta" maxlength="19" placeholder="1234 5678 9012 3456" autocomplete="off" />

            <div class="card-inputs">
                <input type="text" id="fecha" maxlength="5" placeholder="MM/AA" autocomplete="off" />
                <input type="text" id="codigo" maxlength="3" placeholder="CVV" autocomplete="off" />
            </div>

            <div class="payment-icons">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Visa.svg/1200px-Visa.svg.png" alt="Visa" />
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" />
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/PayPal_logo.svg" alt="PayPal" />
            </div>

            <div class="buttons-container">
                <button id="cancelarPago" type="button">Cancelar</button>
                <button id="confirmarPago" type="button">Confirmar</button>
            </div>
        </div>
    </div>

<script>
    const subsButtons = document.querySelectorAll('.subs-btn');
    const suscripcionInput = document.getElementById('suscripcion');
    const precioSeleccionado = document.getElementById('precioSeleccionado');
    const modalPago = document.getElementById('modalPago');
    const btnSubmit = document.getElementById('btnSubmit');
    const precioPago = document.getElementById('precioPago');
    const cancelarPagoBtn = document.getElementById('cancelarPago');
    const confirmarPagoBtn = document.getElementById('confirmarPago');

    let precioActual = 0;

    // Manejo de selección de suscripción
    subsButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const value = btn.getAttribute('data-value');
            suscripcionInput.value = value;
            subsButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            if (value === 'mensual') {
                precioActual = 19;
                precioSeleccionado.textContent = 'Precio: 19€';
            } else {
                precioActual = 60;
                precioSeleccionado.textContent = 'Precio: 60€';
            }
        });
    });

    // Mostrar modal al hacer clic en "Registrarse"
    btnSubmit.addEventListener('click', (e) => {
        e.preventDefault();
        if (!suscripcionInput.value) {
            alert('Por favor selecciona un tipo de suscripción.');
            return;
        }
        precioPago.textContent = precioActual + '€';
        modalPago.style.display = 'flex';
    });

    // Cancelar cierra el modal
    cancelarPagoBtn.addEventListener('click', () => {
        modalPago.style.display = 'none';
    });

    // Confirmar simula pago y envía el formulario
    confirmarPagoBtn.addEventListener('click', () => {
        alert('Pago simulado. Registro exitoso.');
        document.getElementById('registroForm').submit();
    });

    // Formatear fecha MM/AA automáticamente
    const inputFecha = document.getElementById('fecha');
    inputFecha.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '').substring(0, 4);
        if (value.length >= 3) {
            value = value.substring(0, 2) + '/' + value.substring(2);
        }
        e.target.value = value;
    });
</script>

</body>
</html>
