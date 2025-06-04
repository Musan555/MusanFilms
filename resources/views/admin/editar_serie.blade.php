<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Editar Serie</title>
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
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: none;
            font-size: 1em;
        }
        label {
            font-weight: bold;
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
        }
        button:hover {
            background-color: #155cc4;
        }
        .checkbox-group label {
            display: inline-block;
            margin-right: 10px;
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
    </style>
</head>
<body>
<div class="container">
    <h1>Editar Serie</h1>

    <form action="{{ route('admin.actualizar.serie', $serie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="titulo">Título</label>
        <input type="text" name="titulo" value="{{ old('titulo', $serie->titulo) }}" required>

        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" rows="4" required>{{ old('descripcion', $serie->descripcion) }}</textarea>

        <label for="fecha_lanzamiento">Año de Lanzamiento</label>
        <input type="number" name="fecha_lanzamiento" value="{{ old('fecha_lanzamiento', $serie->fecha_lanzamiento) }}" required>

        <label>Géneros</label>
        <div class="checkbox-group">
            @foreach($generos as $genero)
                <label>
                    <input type="checkbox" name="genero_id[]" value="{{ $genero->id }}"
                        {{ in_array($genero->id, old('genero_id', $serie->generos->pluck('id')->toArray())) ? 'checked' : '' }}>
                    {{ $genero->nombre }}
                </label>
            @endforeach
        </div>

        <label for="categoria_id">Categoría</label>
        <select name="categoria_id" required>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ old('categoria_id', $serie->categoria_id) == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>

        <label for="portada">Portada (opcional)</label>
        <input type="file" name="portada">

        <hr>

        <h3>📺 Temporadas</h3>
        <div id="temporadasContainer">
            @foreach($serie->temporadas as $tIndex => $temporada)
                @php $tKey = "temp-$tIndex"; @endphp
                <div class="temporada" data-id="{{ $tKey }}">
                    <label>Temporada</label>
                    <input type="number" name="temporadas[{{ $tKey }}][numero]" value="{{ $temporada->numero }}" required min="1">
                    <button type="button" onclick="eliminarTemporada('{{ $tKey }}')">Eliminar Temporada</button>
                    <div class="capitulos" id="capitulos-{{ $tKey }}">
                        @foreach($temporada->capitulos as $cIndex => $capitulo)
                            <div class="capitulo">
                                <label>Capítulo</label>
                                <input type="number" name="temporadas[{{ $tKey }}][capitulos][{{ $cIndex }}][numero]" value="{{ $capitulo->numero }}" required min="1">
                                <input type="text" name="temporadas[{{ $tKey }}][capitulos][{{ $cIndex }}][titulo]" value="{{ $capitulo->titulo }}" required>
                                <input type="url" name="temporadas[{{ $tKey }}][capitulos][{{ $cIndex }}][url]" value="{{ $capitulo->url }}" required>
                                <input type="number" name="temporadas[{{ $tKey }}][capitulos][{{ $cIndex }}][duracion]" value="{{ $capitulo->duracion }}" placeholder="Duración (min)">
                                <button type="button" onclick="this.parentElement.remove()">Eliminar Capítulo</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="agregarCapitulo('{{ $tKey }}')">+ Agregar Capítulo</button>
                </div>
            @endforeach
        </div>

        <button type="button" onclick="agregarTemporada()">+ Agregar Temporada</button>
        <br><br>
        <button type="submit">Actualizar Serie</button>
    </form>
</div>

<script>
    let contadorTemporadas = {{ $serie->temporadas->count() }};

    function agregarTemporada() {
        const id = `temp-${++contadorTemporadas}`;
        const html = `
            <div class="temporada" data-id="${id}">
                <label>Temporada</label>
                <input type="number" name="temporadas[${id}][numero]" value="${contadorTemporadas}" required min="1">
                <button type="button" onclick="eliminarTemporada('${id}')">Eliminar Temporada</button>
                <div class="capitulos" id="capitulos-${id}"></div>
                <button type="button" onclick="agregarCapitulo('${id}')">+ Agregar Capítulo</button>
            </div>
        `;
        document.getElementById('temporadasContainer').insertAdjacentHTML('beforeend', html);
    }

    function eliminarTemporada(id) {
        document.querySelector(`.temporada[data-id="${id}"]`).remove();
    }

    function agregarCapitulo(tempId) {
        const contenedor = document.getElementById(`capitulos-${tempId}`);
        const index = contenedor.children.length;
        const html = `
            <div class="capitulo">
                <label>Capítulo</label>
                <input type="number" name="temporadas[${tempId}][capitulos][${index}][numero]" value="${index + 1}" required min="1">
                <input type="text" name="temporadas[${tempId}][capitulos][${index}][titulo]" placeholder="Título del capítulo" required>
                <input type="url" name="temporadas[${tempId}][capitulos][${index}][url]" placeholder="URL del capítulo" required>
                <input type="number" name="temporadas[${tempId}][capitulos][${index}][duracion]" placeholder="Duración (min)">
                <button type="button" onclick="this.parentElement.remove()">Eliminar Capítulo</button>
            </div>
        `;
        contenedor.insertAdjacentHTML('beforeend', html);
    }
</script>
</body>
</html>

