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
        Schema::create('itinerary_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intinerary_id');
            $table->string('title');
            $table->datetime('visit_date');
            $table->time('visit_time')->nullable();
            $table->decimal('budget_limit', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('intinerary_id')->references('id')->on('itineraries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itinerary_items', function (Blueprint $table) {
            $table->dropForeign('itinerary_items_user_id_foreign');
        });

        Schema::dropIfExists('itinerary_items');
    }
};
