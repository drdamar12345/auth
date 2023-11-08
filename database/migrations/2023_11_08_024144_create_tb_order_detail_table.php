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
        Schema::create('tb_order_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('store_id');
            $table->integer('size');
            $table->integer('harga');
            $table->string('status');
            $table->string('name_customer');
            $table->string('tanggal_pemesanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_order_detail');
    }
};
