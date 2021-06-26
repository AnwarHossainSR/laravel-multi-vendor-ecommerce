<?php

namespace Database\Factories;

use App\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3,false),
            'slug' => $this->faker->unique()->slug,
            'photo' => $this->faker->imageUrl(1519,1021),
            'description' => $this->faker->text(),
            'status' => $this->faker->randomElement(['active','inactive']),
            'condition' => $this->faker->randomElement(['banner','promo'])
        ];
    }
}
