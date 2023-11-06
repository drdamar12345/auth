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
        Schema::create('tb_purchase_detail', function (Blueprint $table) {
            $table->id();
  	        $table->string('nama_product');
            $table->integer('id_product');
            $table->integer('store_id');
            $table->integer('purchase_id');
            $table->string('size');
            $table->integer('qty');
            $table->integer('harga');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
