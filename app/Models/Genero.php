<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Un género puede tener muchas películas
    public function peliculas()
    {
        return $this->belongsToMany(Pelicula::class, 'genero_pelicula');
    }

    public function series()
    {
        return $this->belongsToMany(Serie::class, 'genero_serie');
    }
}