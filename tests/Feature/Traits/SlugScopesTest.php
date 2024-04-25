<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SlugTestModel extends \Illuminate\Database\Eloquent\Model
{
    use \Dgo\Cornerstone\Traits\HasSlugScope;

    protected $fillable = ['slug'];

    protected $table = 'temporary';
}

beforeEach(function () {
    Schema::dropIfExists('temporary');
        Schema::create('temporary', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->timestamps();
        });
});

afterEach(function () {
    Schema::dropIfExists('temporary');
});

it('retrieves model by slug', function () {
    // Create two models
    SlugTestModel::create(['slug' => 'first-slug']);
    SlugTestModel::create(['slug' => 'second-slug']);

    // Use the slug scope to query for the first model
    $result = SlugTestModel::whereSlug('first-slug')->get();

    // Validate it only retrieves the correct model
    expect($result)->toHaveCount(1)
        ->and($result->first()->slug)->toBe('first-slug');
});

it('does not retrieve model with different slug', function () {
    // Create a model
    SlugTestModel::create(['slug' => 'first-slug']);

    // Use the slug scope to query for a model that does not exist
    $result = SlugTestModel::whereSlug('non-existent-slug')->get();

    // Validate no model is retrieved
    expect($result)->toBeEmpty();
});

