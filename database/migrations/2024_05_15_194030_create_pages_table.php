<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('title_markdown')->nullable();
            $table->string('slug')->unique();
            $table->text('lead')->nullable();
            $table->integer('featured_image_id')->nullable();
            $table->string('layout')->default('default');
            $table->json('settings')->nullable();
            $table->json('details')->nullable();
            $table->json('blocks')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('pages')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('pageable_id')->nullable();
            $table->string('pageable_type')->nullable();
            $table->integer('menuable_id')->nullable();
            $table->string('menuable_type')->nullable();
            $table->integer('author_id')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->dateTime('unpublished_at')->nullable();
            $table->boolean('is_activated')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
