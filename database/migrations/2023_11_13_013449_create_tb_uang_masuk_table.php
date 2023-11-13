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
        Schema::create('tb_uang_masuk', function (Blueprint $table) {
            $table->id();
            $table->integer('nominal');
            $table->string('tanggal_pemasukan');
            $table->integer('store_id');
            $table->timestamps();
            $table->integer('qty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_uang_masuk');
    }
};
