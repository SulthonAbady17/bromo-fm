<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Romans\Filter\IntToRoman;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roman = new IntToRoman;
        $order = fake()->numberBetween(1, 100);
        $month = $roman->filter(fake()->numberBetween(1, 12));
        $year = fake()->year();

        $reference_number = "002/{$order}/{$month}/BROMO FM/{$year}";

        return [
            'reference_number' => $reference_number,
            'name' => fake()->name(),
            'birthplace' => fake()->city(),
            'birthdate' => fake()->date(),
            'gender' => fake()->randomElement(['male', 'female']),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'citizen' => fake()->randomElement(['WNI', 'WNA']),
            'profession' => fake()->word(),
            'police_station' => fake()->sentence(),
            'reference_police_number' => fake()->word(),
            'report_date_time' => fake()->dateTime(),
            'content' => fake()->paragraph(),
            'user_id' => User::all()->random()->id,
        ];
    }
}
