<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {  
        $name = $this->faker->randomElement(['laravel','react','vue','php','angular']);
        return [
            'user_id' => User::all()->random()->id,
            'name' => $name,
            'slug' => Str::slug($name)
        ];
    }
}
