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
        Schema::create('stockout', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stockinId');
            $table->integer('quantity');
            $table->datetime('dateUsed')->default(DB::raw('CURRENT_TIMESTAMP'));

            // 0 = Sold, 1 = Expired
            $table->tinyInteger('cause');

            $table->timestamps();

            $table->foreign('stockinId')->references('id')->on('stockin')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockout');
    }
};
