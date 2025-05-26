<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'temporadas',
        'capitulos_por_temporada',
        'genero_id',
        'categoria_id',
        'portada',
        'fecha_lanzamiento',
    ];

    public function generos()
    {
        return $this->belongsToMany(Genero::class, 'genero_serie');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
