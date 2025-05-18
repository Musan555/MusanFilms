<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');  // Campo para el nombre del usuario
            $table->string('email')->unique();  // Campo para el email, debe ser único
            $table->string('password');  // Campo para la contraseña
            $table->string('telefono')->nullable();  // Campo para el teléfono, puede ser nulo
            $table->string('role')->default('user');  // Campo para el rol, por defecto es 'user'
            $table->enum('suscripcion', ['semanal', 'anual']); // Campo para la suscripción, sin valor por defecto
            $table->timestamps();  // Los timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
