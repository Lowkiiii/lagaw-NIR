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
        Schema::create('predefined_itineraries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tourist_spot_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('visit_date')->nullable();
            $table->time('visit_time')->nullable();
            $table->decimal('budget_limit', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('tourist_spot_id')->references('id')->on('tourist_spots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('predefined_itineraries', function (Blueprint $table) {
            $table->dropForeign('predefined_itineraries_tourist_spot_id_foreign');
        });

        Schema::dropIfExists('predefined_itineraries');
    }
};
