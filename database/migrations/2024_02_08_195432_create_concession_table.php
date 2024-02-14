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
        Schema::create('concessions', function (Blueprint $table) {
            $table->id('concession_id');
            $table->string('concession_name');
            $table->polygon('geometry');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE concessions ADD SPATIAL INDEX(geometry)');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concession');
    }
};
