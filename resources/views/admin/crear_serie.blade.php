<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Crear Serie</title>
    <style>
        body {
            background-color: #121212;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #222;
            padding: 30px;
            border-radius: 8px;
        }
        input[type="text"], input[type="number"], input[type="url"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: none;
            font-size: 1em;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        button {
            background-color: #1f75fe;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 10px;
        }
        button:hover {
            background-color: #155cc4;
        }
        .temporada {
            margin-top: 20px;
            padding: 15px;
            background: #333;
            border-radius: 5px;
        }
        .capitulo {
            margin-left: 20px;
            padding: 10px;
            background: #444;
            border-radius: 5px;
            margin-top: 10px;
        }
        .checkbox-group label {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Crear Serie</h1>

    @if (session('success'))
        <div style="color: green; font-weight: bold;">{{ session('success') }}</div>
    @endif

    <form id="crearSerieForm" action="{{ route('admin.guardar.serie') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="titulo">Título</label>
        <input type="text" name="titulo" required>

        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" rows="4" required></textarea>

        <label for="fecha_lanzamiento">Año de Lanzamiento</label>
        <input type="number" name="fecha_lanzamiento" required>

        <label for="genero_id">Géneros</label><br>
        <div class="checkbox-group">
            @foreach($generos as $genero)
                <label>
                    <input type="checkbox" name="genero_id[]" value="{{ $genero->id }}">
                    {{ $genero->nombre }}
                </label>
            @endforeach
        </div>

        <label for="categoria_id">Categoría</label>
        <select name="categoria_id" required>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>

        <label for="portada">Portada</label>
        <input type="file" name="portada" required>

        <hr>

        <h3>📺 Temporadas</h3>
        <div id="temporadasContainer"></div>
        <button type="button" onclick="agregarTemporada()">+ Agregar Temporada</button>

        <button type="submit">Guardar Serie</button>
        <a href="{{ route('admin.panel') }}">
            <button type="button">Volver al Panel</button>
        </a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let contadorTemporadas = 0;

    function agregarTemporada() {
        contadorTemporadas++;
        const tempId = `temp-${contadorTemporadas}`;
        const html = `
            <div class="temporada" data-id="${tempId}">
                <label>Temporada ${contadorTemporadas}</label>
                <input type="number" name="temporadas[${tempId}][numero]" value="${contadorTemporadas}" required min="1">
                <button type="button" onclick="eliminarTemporada('${tempId}')">Eliminar Temporada</button>
                <div class="capitulos" id="capitulos-${tempId}"></div>
                <button type="button" onclick="agregarCapitulo('${tempId}')">+ Agregar Capítulo</button>
            </div>
        `;
        $('#temporadasContainer').append(html);
    }

    function eliminarTemporada(id) {
        $(`.temporada[data-id="${id}"]`).remove();
    }

    function agregarCapitulo(tempId) {
        const index = $(`#capitulos-${tempId} .capitulo`).length + 1;
        const html = `
            <div class="capitulo">
                <label>Capítulo ${index}</label>
                <input type="number" name="temporadas[${tempId}][capitulos][${index}][numero]" value="${index}" required min="1" style="width: 60px;" placeholder="Nº">
                <input type="text" name="temporadas[${tempId}][capitulos][${index}][titulo]" placeholder="Título del capítulo" required>
                <input type="url" name="temporadas[${tempId}][capitulos][${index}][url]" placeholder="URL del capítulo" required>
                <input type="number" name="temporadas[${tempId}][capitulos][${index}][duracion]" placeholder="Duración (min)" min="0" style="width: 100px;">
                <button type="button" onclick="$(this).parent().remove()">Eliminar Capítulo</button>
            </div>
        `;
        $(`#capitulos-${tempId}`).append(html);
    }
</script>
</body>
</html>

