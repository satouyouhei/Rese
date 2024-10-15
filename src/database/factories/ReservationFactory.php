<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Carbon;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomDate = Carbon::now()->subWeek(2)->addDays(rand(0, 16))->toDateString();

        return [
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'shop_id' => 1,
            'date' => $randomDate,
            'time' => $this->faker->randomElement(['20:00', '20:30', '21:00', '21:30', '22:00']),
            'number' => $this->faker->numberBetween(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}