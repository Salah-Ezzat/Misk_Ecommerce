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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pro_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('stock');
            $table->float('price');
            $table->float('sale');
            $table->string('max_limit')->default('غير محدودة');
            $table->foreignId('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
