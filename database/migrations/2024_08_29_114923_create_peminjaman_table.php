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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->string('peminjaman_id', length: 16);
            $table->string('peminjaman_user_id', length: 16)->index();
            $table->date('peminjaman_tglpinjam');
            $table->date('peminjaman_tglkembali');
            $table->boolean('peminjaman_statuskembali')->default(false);
            $table->string('peminjaman_note', length: 100)->nullable();
            $table->integer('peminjaman_denda')->nullable();
            $table->timestamps();

            $table->primary('peminjaman_id');
            $table->foreign('peminjaman_id')->references('peminjaman_detail_peminjaman_id')->on('peminjaman_detail')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    //foreign key

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
