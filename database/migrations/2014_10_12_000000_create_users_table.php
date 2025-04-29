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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->unique();
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken('remember_token');
            $table->string('shop');
            $table->string('province');
            $table->string('city');
            $table->string('address');
            $table->foreignId('role_id')->references('id')->on('roles')->onDelete('set null');            $table->string('code');
            $table->string('cover');
            $table->integer('min_limit');
            $table->tinyInteger('confirm_add')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
