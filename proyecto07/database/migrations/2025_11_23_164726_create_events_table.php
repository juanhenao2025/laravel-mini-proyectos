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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // título del evento
            $table->text('description')->nullable(); // descripción opcional
            $table->dateTime('start_time'); // fecha y hora de inicio
            $table->dateTime('end_time');   // fecha y hora de fin
            $table->boolean('reminder')->default(false); // ¿tiene recordatorio?
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};