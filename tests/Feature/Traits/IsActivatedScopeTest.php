<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActiveTestModel extends \Illuminate\Database\Eloquent\Model
{
    use \Dgo\Cornerstone\Traits\IsActivatedScope;

    protected $fillable = ['is_activated'];

    protected $casts = [
        'is_activated' => 'boolean',
        ];

    protected $table = 'temporary';
}

beforeEach(function () {
    Schema::dropIfExists('temporary');
        Schema::create('temporary', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_activated')->nullable();
            $table->timestamps();
        });
    $this->model = new ActiveTestModel();
});

afterEach(function () {
    Schema::dropIfExists('temporary');
});

it('uses the IsActivatedScope trait', function () {
    // Check if the model uses the specific trait
    expect(in_array(\Dgo\Cornerstone\Traits\IsActivatedScope::class, class_uses_recursive($this->model)))->toBeTrue();
});

it('casts is_activated as boolean', function () {

    expect((new $this->model)->getCasts()['is_activated'] )->toBe('boolean');
});

it('retrieves only activated or non-activated models', function () {

    // Count activated records 2 of 3
    activateModel($this->model->create());
    $this->model->create(['is_activated' => false]);
    $toDeactivate = activateModel($this->model->create());
    expect($this->model::get())->toHaveCount(3)
        ->and($this->model::activated()->get())->toHaveCount(2);

    // Count deactivated records
    deactivateModelNull($this->model->create());
    deactivateModelEmpty($this->model->create());
    deactivateModel($toDeactivate);
    expect($this->model::get())->toHaveCount(5)
        ->and($this->model::activated()->get())->toHaveCount(1)
        ->and($this->model::deactivated()->get())->toHaveCount(4);

});

function activateModel($model) {
    $model->update([
        'is_activated' => true,
    ]);
    return $model;
}

function deactivateModel($model) {
    $model->update([
        'is_activated' => false,
    ]);
}

function deactivateModelNull($model) {
    $model->update([
        'is_activated' => null,
    ]);
}

function deactivateModelEmpty($model) {
    $model->update([
        'is_activated' => '',
    ]);
}