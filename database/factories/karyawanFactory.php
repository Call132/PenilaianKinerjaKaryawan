<?php

namespace Database\Factories;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KaryawanFactory extends Factory
{
    protected $model = Karyawan::class;

    public function definition()
    {
        return [
            'department' => $this->faker->randomElement(['Front Office', 'Housekeeping', 'Engineering', 'Accounting', 'Sales', 'FBS', 'FBP', 'HC & Security']),
            'posisi' => $this->faker->word,
            'name' => $this->faker->name,
            'tanggal_lahir' => $this->faker->date,
            'no_hp' => $this->faker->phoneNumber,
            'joining_date' => $this->faker->date,
            'status' => $this->faker->randomElement(['Casual', 'Daily Worker', 'Karyawan Kontrak']),
        ];
    }
}
