<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->integer('temporadas')->unsigned();
            $table->integer('capitulos_por_temporada')->unsigned();
            
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->string('portada');
            $table->string('url')->nullable();
            $table->date('fecha_lanzamiento');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('series');
    }
}
