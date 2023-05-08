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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->foreignId('organization_id');
            $table->foreignId('category_id')->nullable();
            $table->foreignId('post_id')->nullable();
            $table->foreignId('tag_id')->nullable();
            $table->foreignId('parent_id')->nullable();
            $table->integer('order');
            $table->string('menu_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
