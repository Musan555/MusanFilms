<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasTable extends Migration
{
    public function up()
    {
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->integer('duracion'); // minutos
            
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('portada');
            $table->string('url')->nullable();
            $table->integer('anio_estreno');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peliculas');
    }
}

