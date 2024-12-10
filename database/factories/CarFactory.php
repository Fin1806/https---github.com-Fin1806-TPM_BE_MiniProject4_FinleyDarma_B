<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\car;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\car>
 */
class CarFactory extends Factory
{
    protected $model = car ::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'Cars'=> $this->faker->word,
            'Brand'=> $this->faker->word,
            'Car_Type'=> $this->faker->randomElement(['SUV','MPV','Sedan', 'SportsCar']),
            'Fuel_Type'=> $this->faker->randomElement(['Electric', 'Gasoline', 'hybrid']),
            'price_id' => $this->faker->randomElement(['1','2','3','4'])

        ];
    }
}
