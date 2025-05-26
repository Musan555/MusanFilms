<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Una categoría puede tener muchas películas
    public function peliculas()
    {
        return $this->hasMany(Pelicula::class);
    }

    // Una categoría puede tener muchas series
    public function series()
    {
        return $this->hasMany(Serie::class);
    }
}
