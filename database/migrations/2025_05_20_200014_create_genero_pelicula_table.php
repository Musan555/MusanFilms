<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneroPeliculaTable extends Migration
{
    public function up()
    {
        Schema::create('genero_pelicula', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelicula_id')->constrained('peliculas')->onDelete('cascade');
            $table->foreignId('genero_id')->constrained('generos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('genero_pelicula');
    }
}

