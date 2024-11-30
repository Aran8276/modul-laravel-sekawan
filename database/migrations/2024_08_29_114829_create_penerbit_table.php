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
            $table->string('penerbit_id');
            $table->string('penerbit_nama');
            $table->string('penerbit_alamat');
            $table->char('penerbit_notelp');
            $table->string('penerbit_email');
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
