<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        
        return [
            'armada_id' => rand(1,50),
            'booking_code' => $this->faker->unique()->randomNumber(8),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'service_type' => $this->faker->randomElement(['with_driver' , 'without_driver']),
            'pickup_type' => $this->faker->randomElement(['office' , 'other_location']),
            'pickup_address' => $this->faker->address(),
            'dropoff_type' => $this->faker->randomElement(['office' , 'other_location']),
            'dropoff_adress' => $this->faker->address(),
            'start_date' => $this->faker->date('d-m-Y'),
            'end_date' => $this->faker->date('d-m-Y'),
            'start_time' => $this->faker->time('H:i'),
            'end_time' => $this->faker->time('H:i'),
            'total_price' => $this->faker->numberBetween(100000, 1000000),
            'note' => $this->faker->text(),
            'payment_method' => $this->faker->randomElement(['bank_transfer' , 'cash']),
            'status' => $this->faker->randomElement(['waiting_payment' ,'waiting_confirmation' ,'waiting_pickup' , 'confirmed' , 'cancelled' , 'finished']),
        ];
    }
}
