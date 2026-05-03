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
        Schema::create('trajets', function (Blueprint $table) {
            $table->id();
            $table->string('departure_city', 120);
            $table->string('arrival_city', 120);
            $table->date('date');
            $table->time('time');
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('seats_available');
            $table->timestamps();

            $table->index(['departure_city', 'arrival_city', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
