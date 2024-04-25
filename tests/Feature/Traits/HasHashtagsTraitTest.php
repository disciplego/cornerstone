<?php

use Dgo\Cornerstone\Traits\HasHashtags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HashModel extends Model
{
    use HasHashtags;

    protected $fillable = ['hashtags'];

    protected $casts = [
        'hashtags' => 'array',
    ];

}

beforeEach(function () {
    Schema::create('hash_models', function (Blueprint $table) {
        $table->id();
        $table->json('hashtags')->nullable();
        $table->timestamps();
    });
});

it('uses the HasHashtags trait', function () {
    $model = new HashModel();
    expect(in_array(HasHashtags::class, class_uses_recursive($model)))->toBeTrue();
});

it('casts hashtags as array', function () {
    expect((new HashModel())->getCasts()['hashtags'])->toBe('array');
});

it('can set hashtags', function () {
    $model = new HashModel();
    $model->hashtags = ['#tag1', '#tag2'];
    expect($model->hashtags)->toBeArray()
        ->and($model->hashtags)->sequence('#tag1', '#tag2');
});

it('can get hashtags', function () {
    $model = new HashModel();
    $model->hashtags = ['#tag1', '#tag2'];
    expect($model->hashtags)->toBeArray()
        ->and($model->hashtags)->sequence('#tag1', '#tag2');
});

it('can get hashtags as string', function () {
    $model = new HashModel();
    $model->hashtags = ['#tag1', '#tag2'];
    expect($model->compileHashtagsToString())->toBeString()
        ->toBe('#tag1 #tag2');
});

it('does not add duplicate hashtags', function () {

    $duplicateTag = '#duplicateTag';
    $model = new HashModel();
    $model->addHashtag($duplicateTag);
    $model->addHashtag($duplicateTag);

    expect($model->hashtags)->toBeArray()->toHaveCount(1)
        ->and($model->hashtags)->sequence($duplicateTag);
});

it('handles empty or null hashtags', function () {

    $model = new HashModel();
    $model->addHashtag('');
    $model->addHashtag(null);
    $model->addHashtag('#validTag');

    expect($model->hashtags)->toBeArray()->toHaveCount(1)
        ->toEqual(['#validTag']);
});

it('adds # to valid string if it does not exist', function () {

    $model = new HashModel();
    $model->addHashtag('');
    $model->addHashtag('validTag');
    $model->addHashtag('#tag1');

    expect($model->hashtags)->toBeArray()->toHaveCount(2)
        ->toEqual(['#validTag', '#tag1']);
});

it('can remove hashtags', function () {

    $model = new HashModel();
    $model->addHashtag('#tag1');
    $model->addHashtag('tag2');
    $model->addHashtag('#tag3');
    $model->removeHashtag('#tag2');

    expect($model->hashtags)->toBeArray()->toHaveCount(2)
        ->toEqual(['#tag1', '#tag3']);
});
