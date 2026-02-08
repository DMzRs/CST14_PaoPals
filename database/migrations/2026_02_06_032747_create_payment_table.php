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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderId');
            $table->unsignedBigInteger('userId');
            $table->datetime('paymentDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            // 0 = Cash, 1 = Card, 2 = Gcash
            $table->tinyInteger('paymentMethod');
            
            $table->decimal('paymentTotalCost', 10, 2);
            $table->timestamps();

            $table->foreign('orderId')->references('id')->on('order')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
