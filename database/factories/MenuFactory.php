<?php

namespace Dgo\Cornerstone\Database\Factories;

use Dgo\Cornerstone\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'is_activated' => $this->faker->boolean(),
        ];
    }
}
