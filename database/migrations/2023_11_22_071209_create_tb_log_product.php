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
        Schema::create('tb_log_product', function (Blueprint $table) {
            $table->id();
            $table->string('name_admin');
            $table->integer('time');
            $table->integer('date');
            $table->integer('qty');
            $table->integer('total_price');
            $table->integer('store_id');
            $table->string('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_log_product');
    }
};
