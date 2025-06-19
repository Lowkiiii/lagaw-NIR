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
        Schema::create('itineraries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tourist_spot_id');
            $table->string('title');
            $table->datetime('visit_date');
            $table->time('visit_time')->nullable();
            $table->decimal('budget_limit', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tourist_spot_id')->references('id')->on('tourist_spots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itineraries', function (Blueprint $table) {
            $table->dropForeign('itineraries_user_id_foreign');
        });

        Schema::table('itineraries', function (Blueprint $table) {
            $table->dropForeign('itineraries_tourist_spot_id_foreign');
        });

        Schema::dropIfExists('itineraries');
    }
};
