<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');              // título de la receta
            $table->text('ingredients');          // lista de ingredientes
            $table->text('instructions');         // pasos de preparación
            $table->string('type')->nullable();   // tipo de comida (ej: desayuno, almuerzo, cena, postre)
            $table->string('author')->nullable(); // autor de la receta
            $table->timestamps();                 // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};