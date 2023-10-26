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
        Schema::create('tb_keranjang', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id', false)->nullable();
            $table->string('nama');
            $table->string('gambar');
            $table->integer('harga');
            $table->integer('id_product', false);
            $table->integer('qty', false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_keranjang');
    }
};
