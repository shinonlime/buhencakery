<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->word(),
            'slug' => $this->faker->word(),
            'harga' => $this->faker->numberBetween(100000, 200000),
            'deskripsi' => $this->faker->sentence(10),
        ];
    }
}
