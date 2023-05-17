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
        Schema::table('file_galleries', function (Blueprint $table) {
            $table->foreignId('file_id')->constrained('files')->onDelete('restrict');
            $table->foreignId('gallery_id')->constrained('galleries')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_galleries', function (Blueprint $table) {
            //
        });
    }
};
