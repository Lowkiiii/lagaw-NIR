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
        Schema::table('tourist_spots', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('img_url'); // adjust 'after' as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tourist_spots', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });
    }
};
