<?php

namespace Database\Factories;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ShippingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shipping::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'shipping_address' => $this->faker->sentence(3,false),
            'delivery_time' => Str::random(5).','.'Dhaka'.'Bangladesh',
            'delivery_charge' => $this->faker->numberBetween(40,150),
            'status' => $this->faker->randomElement(['active','inactive'])
        ];
    }
}
