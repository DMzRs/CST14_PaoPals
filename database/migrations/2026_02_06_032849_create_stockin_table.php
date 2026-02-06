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
        Schema::create('stockin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productId');
            $table->integer('quantity');
            $table->datetime('dateCreated')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('expirationDate');
            $table->integer('remainingStock');
            $table->enum('status', ['Available', 'Unavailable'])->default('Available');
            $table->timestamps();

            $table->foreign('productId')->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockin');
    }
};
