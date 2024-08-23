<?php

namespace Dgo\Cornerstone\Database\Factories;

use Dgo\Cornerstone\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MenuItemFactory extends Factory
{
    protected $model = MenuItem::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'title' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'abbreviation' => $this->faker->word(),
            'icon' => $this->faker->word(),
            'url' => $this->faker->url(),
            'route' => $this->faker->word(),
            'target' => $this->faker->boolean(),
            'help_text' => $this->faker->text(),
            'published_at' => Carbon::now(),
            'unpublished_at' => $this->faker->word(),
            'menuable_id' => $this->faker->randomNumber(),
            'menuable_type' => $this->faker->word(),
            'is_activated' => $this->faker->boolean(),
            'parent_id' => $this->faker->randomNumber(),
            'order_column' => $this->faker->randomNumber(),
        ];
    }
}
