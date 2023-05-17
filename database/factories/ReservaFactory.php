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
        // $reserva = Carbon::parse($this->faker->dateTimeBetween('this week', '+6 days'));
        // $reserva_hora_1 = ($reserva->copy())->setTime(18, 0, 0);
        // $reserva_hora_2 = ($reserva->copy())->setTime(19, 30, 0);
        // $reserva_hora_3 = ($reserva->copy())->setTime(21, 0, 0);
        // $reserva_hora_4 = ($reserva->copy())->setTime(22, 30, 0);

        // // 90 minutos: 18:00 - 19:30 - 21:00 - 22:30
        // return [
        //     'res_mesa' => $this->faker->randomElement([$reserva_hora_1,$reserva_hora_2,$reserva_hora_3,$reserva_hora_4]),
        //     'user_id' => User::all()->random()->id,
        //     'mesa_id' => Mesa::all()->random()->id
        // ];

        $reservas = [];

        for ($i = 0; $i < 10; $i++) {
            $reserva = Carbon::parse($this->faker->dateTimeBetween('this week', '+10 days'));
            $reserva_hora_1 = ($reserva->copy())->setTime(18, 0, 0);
            $reserva_hora_2 = ($reserva->copy())->setTime(19, 30, 0);
            $reserva_hora_3 = ($reserva->copy())->setTime(21, 0, 0);
            $reserva_hora_4 = ($reserva->copy())->setTime(22, 30, 0);

            $mesasDisponiveis = Mesa::whereDoesntHave('reservas', function ($query) use ($reserva_hora_1, $reserva_hora_2, $reserva_hora_3, $reserva_hora_4) {
                $query->where('res_mesa', $reserva_hora_1)
                    ->orWhere('res_mesa', $reserva_hora_2)
                    ->orWhere('res_mesa', $reserva_hora_3)
                    ->orWhere('res_mesa', $reserva_hora_4);
            })->get();

            if ($mesasDisponiveis->isEmpty()) {
                continue; // Se não houver mesas disponíveis, pule essa reserva
            }

            $mesaSelecionada = $mesasDisponiveis->random();

            $reservas = [
                'res_mesa' => $this->faker->randomElement([$reserva_hora_1, $reserva_hora_2, $reserva_hora_3, $reserva_hora_4]),
                'user_id' => User::all()->random()->id,
                'mesa_id' => $mesaSelecionada->id
            ];
            break;
        }

        return $reservas;
    }
}
