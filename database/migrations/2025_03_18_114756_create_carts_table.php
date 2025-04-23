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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pro_id')->references('id')->on('products')->onDelete('restrict');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreignId('seller_id')->references('id')->on('users')->onDelete('restrict');
            $table->integer('quantity');
            $table->float('price');
            $table->foreignId('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->float('invoice_total');
            $table->integer('new_quantity');
            $table->float('new_total');
            $table->tinyInteger('changed');
            $table->tinyInteger('confirmed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
