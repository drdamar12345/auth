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
        Schema::table('tb_uang_masuk', function (Blueprint $table) {
            $table->id();
            $table->integer('nominal');
            $table->string('tanggal_pemasukan');
            $table->integer('store_id');
            $table->integer('qty');
            $table->string('note');
            $table->string('name_customer');
            $table->string('name_product');
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
