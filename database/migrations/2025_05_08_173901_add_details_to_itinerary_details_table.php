<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('itinerary_details', function (Blueprint $table) {
            $table->text('details')->after('itinerary_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('itinerary_details', function (Blueprint $table) {
            $table->dropColumn('details');
        });
    }
};
