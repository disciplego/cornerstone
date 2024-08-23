<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('abbreviation')->nullable();
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->string('route')->nullable();
            $table->boolean('target')->nullable();
            $table->string('help_text')->nullable();
            $table->date('published_at')->nullable();
            $table->string('unpublished_at')->nullable();
            $table->integer('menu_id')->nullable();
            $table->string('menuable_type')->nullable();
            $table->boolean('is_activated')->nullable();
            $table->foreignId('parent_id')->nullable();
            $table->integer('order_column')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
