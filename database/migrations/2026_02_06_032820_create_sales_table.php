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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderId');
            $table->unsignedBigInteger('paymentId');
            $table->unsignedBigInteger('userId');
            $table->datetime('saleDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('totalRevenue', 10, 2);
            $table->timestamps();

            $table->foreign('orderId')->references('id')->on('order')->onDelete('cascade');
            $table->foreign('paymentId')->references('id')->on('payment')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
