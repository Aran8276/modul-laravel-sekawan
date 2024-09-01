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
        Schema::create('peminjaman_detail', function (Blueprint $table) {
            $table->string('peminjaman_detail_peminjaman_id', length: 16);
            $table->string('peminjaman_detail_buku_id', length: 16);

            $table->foreign('peminjaman_detail_peminjaman_id')->references('peminjaman_id')->on('peminjaman')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('peminjaman_detail_buku_id')->references('buku_id')->on('buku')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_detail');
    }
};
