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
        Schema::create('well_productions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('well_id');
            $table->unsignedDecimal('monthly_production', 10, 2);
            $table->date('month');
            $table->timestamps();

            $table->foreign('well_id')->references('well_code')->on('wells')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('well_productions');
    }
};
