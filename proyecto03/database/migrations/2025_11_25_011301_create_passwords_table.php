<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('passwords', function (Blueprint $table) {
            $table->id();
            $table->string('value');              // contraseña generada
            $table->integer('length');            // longitud usada
            $table->boolean('include_upper');     // incluir mayúsculas
            $table->boolean('include_numbers');   // incluir números
            $table->boolean('include_symbols');   // incluir símbolos
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('passwords');
    }
};