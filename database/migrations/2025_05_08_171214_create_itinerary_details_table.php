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
        Schema::create('itinerary_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('itinerary_id');
            $table->timestamps();

            $table->foreign('itinerary_id')->references('id')->on('itineraries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itinerary_details', function (Blueprint $table) {
            $table->dropForeign('itinerary_details_itinerary_id_foreign');
        });

        Schema::dropIfExists('itinerary_details');
    }
};
