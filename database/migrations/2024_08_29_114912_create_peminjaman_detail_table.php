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
            $table->timestamps();

            $table->foreign('peminjaman_detail_buku_id')->references('buku_id')->on('buku')->onDelete('cascade')->onUpdate('cascade');
            $table->primary('peminjaman_detail_peminjaman_id');
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
