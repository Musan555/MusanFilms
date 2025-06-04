<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    use HasFactory;

    protected $fillable = ['serie_id', 'numero'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function capitulos()
    {
        return $this->hasMany(Capitulo::class);
    }
}
