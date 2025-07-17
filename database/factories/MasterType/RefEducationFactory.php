<?php

namespace Database\Factories\MasterType;

use App\Models\MasterType\RefEducation;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefEducationFactory extends Factory {
    protected $model = RefEducation::class;

    public function definition(): array {
        return [
            'name' => $this->faker->randomElement(['SD', 'SMP', 'SMA']),
            'code' => $this->faker->unique()->lexify('????'),
            'description' => $this->faker->sentence(),
        ];
    }

    public function sd(): static {
        return $this->state([
            'name' => 'SD',
            'code' => 'SD',
            'description' => 'Sekolah Dasar',
        ]);
    }

    public function smp(): static {
        return $this->state([
            'name' => 'SMP',
            'code' => 'SMP',
            'description' => 'Sekolah Menengah Pertama',
        ]);
    }

    public function sma(): static {
        return $this->state([
            'name' => 'SMA',
            'code' => 'SMA',
            'description' => 'Sekolah Menengah Atas',
        ]);
    }
}
