<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reserva;
use App\Models\Mesa;
use App\Models\User;
use Carbon\Carbon;

class ReservaFactory extends Factory
{
    protected $model = Reserva::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $reserva = Carbon::parse($this->faker->dateTimeBetween('this week', '+6 days'));
        $reserva_hora_1 = ($reserva->setTime(18, 0, 0))->toDateTimeString();
        $reserva_hora_2 = ($reserva->setTime(19, 30, 0))->toDateTimeString();
        $reserva_hora_3 = ($reserva->setTime(21, 0, 0))->toDateTimeString();
        $reserva_hora_4 = ($reserva->setTime(22, 30, 0))->toDateTimeString();

        // 90 minutos: 18:00 - 19:30 - 21:00 - 22:30
        return [
            'res_mesa' => $this->faker->randomElement([$reserva_hora_1,$reserva_hora_2,$reserva_hora_3,$reserva_hora_4]),
            'user_id' => User::all()->random()->id,
            'mesa_id' => Mesa::all()->random()->id
        ];
    }
}
