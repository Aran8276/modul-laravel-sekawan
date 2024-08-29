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
        Schema::create('rak', function (Blueprint $table) {
            $table->string('rak_id', length: 16);
            $table->string('rak_nama', length: 20);
            $table->string('rak_lokasi', length: 50);
            $table->integer('rak_kapasitas');
            $table->timestamps();

            $table->primary('rak_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rak');
    }
};
