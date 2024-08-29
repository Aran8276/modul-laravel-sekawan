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
        Schema::create('penulis', function (Blueprint $table) {
            $table->string('penulis_id', length: 16);
            $table->string('penulis_nama', length: 50);
            $table->string('penulis_tmptlahir', length: 15);
            $table->date('penulis_tgllahir');
            $table->timestamps();

            $table->primary('penulis_id',);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penulis');
    }
};
