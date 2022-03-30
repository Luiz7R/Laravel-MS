<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\User;
use Faker\Core\Number;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategorieFactory extends Factory
{
  /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categorie::class;

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
            'category_name' => $this->faker->sentence(4),
        ];
    }
}
