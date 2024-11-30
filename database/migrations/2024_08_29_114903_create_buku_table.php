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
        Schema::create('buku', function (Blueprint $table) {
            $table->string('buku_id');
            $table->string('buku_judul');
            $table->char('buku_isbn');
            $table->char('buku_thnterbit');
            $table->timestamps();
            $table->string('buku_penulis_id');
            $table->string('buku_kategori_id');
            $table->string('buku_penerbit_id');
            $table->string('buku_rak_id');
            $table->string('buku_urlgambar')->nullable();

            $table->foreign('buku_penulis_id')->references('penulis_id')->on('penulis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('buku_kategori_id')->references('kategori_id')->on('kategori')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('buku_penerbit_id')->references('penerbit_id')->on('penerbit')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('buku_rak_id')->references('rak_id')->on('rak')->onDelete('cascade')->onUpdate('cascade');

            $table->primary('buku_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
