<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Websetting>
 */
class WebsettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'icon' => $this->faker->imageUrl(50,50),
            'logo' => $this->faker->imageUrl(150,75),
            'meta_author' => $this->faker->name(),
            'meta_description' => $this->faker->text(),
            'meta_keywords' => $this->faker->text(),
            'terms' => $this->faker->text(500),
            'privacy_policy' => $this->faker->text(500),
            'about' => $this->faker->text(600),
            'gmaps_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16316.299764803098!2d110.69408296598058!3d-6.652918721895933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70dfa6e2b268db%3A0x1f3eca2c22114e15!2sJepara%20Garden%20Resort!5e0!3m2!1sen!2sid!4v1675271721407!5m2!1sen!2sid',
            'address' => $this->faker->address(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'office_phone' => $this->faker->phoneNumber(),
            'fb_url' => $this->faker->url(),
            'ig_url' => $this->faker->url(),
            'tiktok_url' => $this->faker->url(),
        ];
    }
}
