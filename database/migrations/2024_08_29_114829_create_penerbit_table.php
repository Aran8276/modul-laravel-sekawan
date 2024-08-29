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
        Schema::create('penerbit', function (Blueprint $table) {
            $table->string('penerbit_id', length: 16);
            $table->string('penerbit_nama', length: 50);
            $table->string('penerbit_alamat', length: 50);
            $table->char('penerbit_notelp', length: 13);
            $table->string('penerbit_email', length: 50);
            $table->timestamps();

            $table->primary('penerbit_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerbit');
    }
};
