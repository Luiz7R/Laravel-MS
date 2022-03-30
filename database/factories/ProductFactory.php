<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
  /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => function() {
                return User::factory()->create()->id;
            },
            'name' => $this->faker->sentence(4),
            'price' => $this->faker->numberBetween(1500, 6000),
            'category_id' => function() {
                return Categorie::factory()->create()->id;
            },
        ];
    }
}
