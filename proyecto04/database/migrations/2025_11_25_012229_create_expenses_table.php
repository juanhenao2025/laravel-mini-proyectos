<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('description');   // descripción del gasto
            $table->decimal('amount', 10, 2); // monto
            $table->enum('category', ['Alimentación', 'Transporte', 'Servicios', 'Otros']); // categorías
            $table->date('date');            // fecha del gasto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};