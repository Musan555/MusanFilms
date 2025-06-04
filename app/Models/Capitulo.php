<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;

    protected $fillable = ['temporada_id', 'numero', 'titulo', 'url', 'duracion'];

    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }
}

