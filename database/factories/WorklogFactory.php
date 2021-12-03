<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorklogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(70),
            'description' => $this->faker->text(200),
        ];
    }
}
