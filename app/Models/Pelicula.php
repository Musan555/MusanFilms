<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'titulo',
        'descripcion',
        'duracion',
        'anio_estreno', 
        'categoria_id',
        'portada',
        'url',
    ];

    // Relación: una película pertenece a un género
    public function generos()
    {
        return $this->belongsToMany(Genero::class, 'genero_pelicula');
    }

    // Relación: una película pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
