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
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('image')->nullable(); // Add the 'image' column to 'blogs' table
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_blogs', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
