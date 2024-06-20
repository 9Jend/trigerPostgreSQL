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
        Schema::create('busket_product', function (Blueprint $table) {
            $table->id();
            $table->integer('count');
            $table->unsignedBigInteger('busket_id');
            $table->index('busket_id');
            $table->foreign('busket_id')
                ->references('id')
                ->on('buskets')
                ->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->index('product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('busket_product');
    }
};
