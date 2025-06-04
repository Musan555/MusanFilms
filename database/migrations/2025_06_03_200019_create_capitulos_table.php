<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapitulosTable extends Migration
{
    public function up()
    {
        Schema::create('capitulos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('temporada_id')->constrained('temporadas')->onDelete('cascade');
            $table->integer('numero')->unsigned(); // Número del capítulo dentro de la temporada
            $table->string('titulo');
            $table->string('url'); // URL para reproducir el capítulo
            $table->integer('duracion')->unsigned()->nullable(); // duración en minutos, opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('capitulos');
    }
}

