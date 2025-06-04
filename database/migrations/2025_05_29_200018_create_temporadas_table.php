<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporadasTable extends Migration
{
    public function up()
    {
        Schema::create('temporadas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serie_id')->constrained('series')->onDelete('cascade');
            $table->integer('numero')->unsigned(); // Número de la temporada (1, 2, 3...)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('temporadas');
    }
}

