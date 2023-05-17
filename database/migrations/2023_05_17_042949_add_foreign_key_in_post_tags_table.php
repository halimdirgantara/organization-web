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
        Schema::table('post_tags', function (Blueprint $table) {
            $table->foreignId('tag_id')->constrained('tags')->onDelete('restrict');
            $table->foreignId('post_id')->constrained('posts')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_tags', function (Blueprint $table) {
            //
        });
    }
};
