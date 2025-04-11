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
            $table->foreignId('user_id');
            $table->foreignId('pro_id');
            $table->foreignId('seller_id');
            $table->integer('quantity');
            $table->float('price');
            $table->foreignId('invoice_id');
            $table->float('invoice_total');
            $table->integer('new_quantity');
            $table->float('new_total');
            $table->tinyInteger('changed');
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
