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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreignId('seller_id')->references('id')->on('users')->onDelete('restrict');
            $table->float('invoice_total')->nullable();
            $table->tinyInteger('confirm')->default(0);
            $table->tinyInteger('done')->default(0);
            $table->tinyInteger('prepare')->default(0);
            $table->float('real_total')->default(0);
            $table->foreignId('edit_cause')->nullable()->constrained('causes')->nullOnDelete();
            $table->string('notes')->default('لا توجد توصيات');
            $table->tinyInteger('requested')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
