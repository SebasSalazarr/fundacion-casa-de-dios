<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donaciones', function (Blueprint $table) {
            $table->id();
            $table->string('referencia')->unique();
            $table->unsignedInteger('monto'); // En pesos colombianos.
            $table->string('estado')->default('PENDIENTE')->index();
            $table->string('metodo')->nullable();
            $table->string('correo')->nullable();
            $table->string('transaccion_wompi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donaciones');
    }
};
