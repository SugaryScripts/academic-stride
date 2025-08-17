<?php

namespace Database\Factories\MasterType;

use App\Models\MasterType\RefSubject;
use App\Models\MasterType\SubjectProficiencyH;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubjectProficiencyH>
 */
class SubjectProficiencyHFactory extends Factory
{
    protected $model = SubjectProficiencyH::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no' => fake()->numberBetween(1, 1000),
            'parameter' => fake()->word(),
            'ref_subject_id' => RefSubject::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
