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
        Schema::create('tanks', function (Blueprint $table) {
            $table->id('tank_code');
            $table->unsignedBigInteger('concession_code');
            $table->unsignedBigInteger('well_code');
            $table->decimal('capacity', 10, 2);
            $table->decimal('longitude', 10, 6);
            $table->decimal('latitude', 10, 6);
            // $table->date('changing_date');
            $table->timestamps();

            $table->foreign('concession_code')->references('concession_id')->on('concessions');
            // Assuming well_code is a foreign key referencing the well table
            $table->foreign('well_code')->references('well_code')->on('wells');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanks');
    }
};
