<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->enum('status', ['ativo', 'desativado'])->default('ativo');
            $table->date('inicio_date')->default((new DateTime())->format('Y-m-d'));
            $table->date('fim_date')->default((new DateTime('+30 days'))->format('Y-m-d'));
            $table->string('plano')->default('Gold')->nullable(false);
            $table->integer('valorpormes')->nullable();
            $table->integer('valorporano')->nullable();
            $table->integer('meta')->default('5000');
            $table->integer('registro')->nullable();
            $table->string('origem')->nullable();
            $table->string('bonus')->default('NAO');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            Schema::dropIfExists('users');
           


        });
    }
};
