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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('body');
            $table->foreignId('feature_image');
            $table->foreignId('category_id');
            $table->string('post_type');
            $table->string('status');
            $table->foreignId('created_by');
            $table->foreignId('updated_by');
            $table->foreignId('organization_id');
            $table->integer('views');
            $table->boolean('is_headline');
            $table->boolean('is_main_side');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
