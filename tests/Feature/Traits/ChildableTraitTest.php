<?php

use Dgo\Cornerstone\Traits\Childable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TestItem extends Model
{
    use Childable, HasFactory;

    protected $fillable = ['slug', 'title', 'parent_id'];
}
beforeEach(function () {
    // Create the test_items table
    Schema::create('test_items', function (Blueprint $table) {
        $table->id();
        $table->string('slug');
        $table->string('title');
        $table->unsignedBigInteger('parent_id')->nullable();
        $table->timestamps();

        $table->foreign('parent_id')->references('id')->on('test_items')->onDelete('cascade');
    });
    // Create test items
    $this->parent = new TestItem(['slug' => 'parent', 'title' => 'Parent Item']);
    $this->parent->save();

    $this->child1 = new TestItem(['slug' => 'child-1', 'title' => 'Child 1 Item', 'parent_id' => $this->parent->id]);
    $this->child1->save();

    $this->child2 = new TestItem(['slug' => 'child-2', 'title' => 'Child 2 Item', 'parent_id' => $this->parent->id]);
    $this->child2->save();
});

afterEach(function () use (&$viewPath) {
    // Drop the test_items table
    Schema::dropIfExists('test_items');
});

it('can have a parent', function () {
    expect($this->child1->parent)->toBeInstanceOf(TestItem::class)
        ->and($this->child1->parent->id)->toEqual($this->parent->id);
});

it('can have children', function () {
    $children = $this->parent->children;

    expect($children)->toHaveCount(2)
        ->and($children->pluck('id')->toArray())->sequence(
            $this->child1->id,
            $this->child2->id
        );
});

it('lists children with specific fields', function () {
    $children = $this->parent->listChildren->toArray();

    expect($children)->toHaveCount(2);

    foreach ($children as $child) {
        expect($child)->toHaveKeys(['id', 'slug', 'title', 'parent_id', 'children']);
    }
});

it('can have nested child relationships', function () {
    $nestedChild1 = new TestItem(['slug' => 'nested-child-1', 'title' => 'Nested Child 1 Item', 'parent_id' => $this->child1->id]);
    $nestedChild1->save();
    $nestedChild2 = new TestItem(['slug' => 'nested-child-2', 'title' => 'Nested Child 2 Item', 'parent_id' => $nestedChild1->id]);
    $nestedChild2->save();
    $nestedChild3 = new TestItem(['slug' => 'nested-child-3', 'title' => 'Nested Child 3 Item', 'parent_id' => $nestedChild2->id]);
    $nestedChild3->save();
    expect($nestedChild1->parent->id)->toEqual($this->child1->id)
        ->and($nestedChild1->children[0]['id'])->toEqual($nestedChild2->id)
        ->and($nestedChild2->children[0]['id'])->toEqual($nestedChild3->id);
});

it('can retrieve all descendants of any depth', function () {
    $nestedChild1 = TestItem::create(['slug' => 'nested-child-1', 'title' => 'Nested Child 1 Item', 'parent_id' => $this->child1->id]);
    $nestedChild2 = TestItem::create(['slug' => 'nested-child-2', 'title' => 'Nested Child 2 Item', 'parent_id' => $nestedChild1->id]);
    $nestedChild3 = TestItem::create(['slug' => 'nested-child-3', 'title' => 'Nested Child 3 Item', 'parent_id' => $nestedChild2->id]);

    $parentItem = TestItem::find($this->child1->id);
    $allDescendants = $parentItem->getAllDescendants();

    // Check if the collection contains the correct descendants
    expect($allDescendants->contains('id', $nestedChild1->id))->toBeTrue()
        ->and($allDescendants->contains('id', $nestedChild2->id))->toBeTrue()
        ->and($allDescendants->contains('id', $nestedChild3->id))->toBeTrue();
});
