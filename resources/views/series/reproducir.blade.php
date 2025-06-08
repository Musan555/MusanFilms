<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $serie->titulo }} - MusanFilms</title>
   <link rel="stylesheet" href="{{ asset('storage/css/reproserie.css') }}">
 
</head>
<body>

<a href="{{ route('home') }}" class="volver">‹ Volver</a>

<div class="container">
  <div class="poster">
    <img src="{{ $serie->portada ? asset('storage/' . $serie->portada) : 'https://via.placeholder.com/600x900' }}" alt="{{ $serie->titulo }}">
  </div>

  <div class="info">
    <h1>{{ $serie->titulo }}</h1>
    <p><strong>Sinopsis:</strong> {{ $serie->descripcion }}</p>

    <div class="tags">
      <span>Categoría: {{ $serie->categoria->nombre ?? 'Sin categoría' }}</span>
      <span>Año: {{ $serie->fecha_lanzamiento }}</span>
      <span>
        Temporadas: {{ $serie->temporadas->count() }} |
        Capítulos: 
        {{
          $serie->temporadas->reduce(function($carry, $temporada) {
            return $carry + $temporada->capitulos->count();
          }, 0)
        }}
      </span>
    </div>

    <div style="margin-top: 20px;">
      <select id="selectorCapitulo" onchange="seleccionarCapitulo(this)">
        <option disabled selected>Selecciona un capítulo</option>
        @foreach($serie->temporadas as $temporada)
          <optgroup label="Temporada {{ $temporada->numero }}">
            @foreach($temporada->capitulos as $capitulo)
              <option value="player-{{ $capitulo->id }}">
                Capítulo {{ $capitulo->numero }} - {{ $capitulo->titulo }}
              </option>
            @endforeach
          </optgroup>
        @endforeach
      </select>

      <button class="play-btn" onclick="reproducirSeleccionado()">Reproducir</button>
    </div>
  </div>
</div>

@foreach($serie->temporadas as $temporada)
  @foreach($temporada->capitulos as $capitulo)
    <div class="iframe-container" id="player-{{ $capitulo->id }}">
      <iframe src="{{ $capitulo->url }}" allowfullscreen allow="autoplay; encrypted-media"></iframe>
    </div>
  @endforeach
@endforeach

<script>
  let seleccionado = null;

  function seleccionarCapitulo(select) {
    seleccionado = select.value;
  }

  function reproducirSeleccionado() {
    if (seleccionado) {
      document.querySelectorAll('.iframe-container').forEach(el => el.style.display = 'none');
      const player = document.getElementById(seleccionado);
      if (player) {
        player.style.display = 'block';
        window.scrollTo({
          top: player.offsetTop - 20,
          behavior: 'smooth'
        });
      }
    } else {
      alert('Por favor, selecciona un capítulo');
    }
  }
</script>

</body>
</html>

