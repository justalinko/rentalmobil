<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Armada>
 */
class ArmadaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'brand' => $this->faker->word(),
            'seat' => rand(4,9),
            'luggage' => rand(3,10),
            'transmission' => $this->faker->randomElement(['manual','automatic']),
            'fuel' => $this->faker->randomElement(['91 ron' , '92 ron','94 ron','diesel']),
            'price_hour' => rand(50000,200000),
            'price_day' => rand(200000,1000000),
            'price_otherlocation' => 100000,
            'price_withdriver' => 50000,
            'stock' => rand(2,7),
            'description' => $this->faker->text(),
            'images' => json_encode([$this->faker->imageUrl('650','480','car'),$this->faker->imageUrl('650','480','car'),$this->faker->imageUrl('650','480','car'),$this->faker->imageUrl('650','480','car')]),
            'thumbnail' => $this->faker->imageUrl('650','480','car')

        ];
    }
}
