<?php

use Illuminate\Database\Schema\Blueprint;

class PublishTestModel extends \Illuminate\Database\Eloquent\Model
{
    use \Dgo\Cornerstone\Traits\IsPublishedScope;

    protected $fillable = ['is_activated', 'published_at', 'unpublished_at'];

    protected $casts = [
        'is_activated' => 'boolean',
        'published_at' => 'date',
        'unpublished_at' => 'date',
    ];

    protected $table = 'temporary';
}

beforeEach(function () {
    Schema::dropIfExists('temporary');
        Schema::create('temporary', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_activated')->nullable();
            $table->date('published_at')->nullable();
            $table->date('unpublished_at')->nullable();
            $table->timestamps();
        });
    $this->model = new PublishTestModel();
});

afterEach(function () {
    Schema::dropIfExists('temporary');
});

it('uses the IsPublishedScope and IsActivated traits', function () {
    // Check if the model uses the specific traits
    expect(in_array(\Dgo\Cornerstone\Traits\IsPublishedScope::class, class_uses_recursive($this->model)))->toBeTrue()
        ->and(in_array(\Dgo\Cornerstone\Traits\IsActivatedScope::class, class_uses_recursive($this->model)))->toBeTrue();
});

it('casts required fields correctly', function () {
    $this->model = new $this->model;
    expect($this->model->getCasts()['is_activated'])->toBe('boolean')
        ->and($this->model->getCasts()['published_at'])->toBe('date')
        ->and($this->model->getCasts()['unpublished_at'])->toBe('date');
});

it('retrieves only published or unpublished items', function () {
    // Create published records
    publishModel($this->model->create());
    publishModelUntil($this->model->create());

    // Create unpublished records
    publishModelFuture($this->model->create());
    unPublishModelNull($this->model->create());
    unPublishedModel($this->model->create());

    // Assert that only the first correct records are included
    expect($this->model::get())->toHaveCount(5)
       ->and($this->model::published()->get())->toHaveCount(2)
        ->and($this->model::unPublished()->get())->toHaveCount(3);
});

function publishModel($model) {
    $model->update([
        'published_at' => now()->subDay(),
        'unpublished_at' => null,
        'is_activated' => true
    ]);

    }

function publishModelUntil($model) {
    $model->update([
        'published_at' => now()->subDay(),
        'unpublished_at' => now()->addDay(),
        'is_activated' => true
    ]);

}

function publishModelFuture($model) {
    $model->update([
        'published_at' => now()->addDay(),
        'unpublished_at' => null,
        'is_activated' => true
    ]);

}

function unPublishModelNull($model) {
    $model->update([
        'published_at' => null,
        'unpublished_at' => null,
        'is_activated' => null
    ]);
    }

function unPublishedModel($model) {
    $model->update([
        'published_at' => now()->subDays(2),
        'unpublished_at' => now()->subDay(),
        'is_activated' => null
    ]);
}

