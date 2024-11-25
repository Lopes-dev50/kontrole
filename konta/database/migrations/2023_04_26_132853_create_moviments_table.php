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
        Schema::create('moviments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('data');
            $table->string('etiqueta');
            $table->string('motivo');
            $table->string('dia', 2);
            $table->integer('valor');
            $table->string('tipo', 1); // 'E' para entrada ou 'S' para saída
            $table->string('pago', 1); // 'N' não pagar ou 'S' sim pago
            $table->dateTime('sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moviments');
    }
};
