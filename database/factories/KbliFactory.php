<?php

namespace Database\Factories;

use App\Models\Kbli;
use Illuminate\Database\Eloquent\Factories\Factory;

class KbliFactory extends Factory
{
    protected $model = Kbli::class;

    public function definition()
    {
        return [
            'id_kbli' => $this->faker->numerify('#####'), // ID KBLI harus berupa angka 5 digit
            'jenis_kbli' => $this->faker->words(3, true), // Jenis KBLI berupa string acak
        ];
    }
}
