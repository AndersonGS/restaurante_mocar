<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mesa;

class MesaFactory extends Factory
{
    protected $model = Mesa::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lugares' => $this->faker->randomElement([2,4,6]),
            'foto' => $this->faker->imageUrl(400,400)
        ];
    }
}
