<?php

namespace Database\Factories\v1;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question' => $this->faker->unique()->text(),
            'answer' => $this->faker->text,
            'order' => $this->faker->unique()->randomNumber()
        ];
    }
}
