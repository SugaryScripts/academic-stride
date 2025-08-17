<?php

namespace Database\Factories\MasterType;

use App\Models\Assessment\Question;
use App\Models\MasterType\SubjectProficiencyD;
use App\Models\MasterType\SubjectProficiencyH;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubjectProficiencyD>
 */
class SubjectProficiencyDFactory extends Factory {
    protected $model = SubjectProficiencyD::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'question_id' => Question::inRandomOrder()->first()?->id ?? 1,
            'subject_proficiency_h_id' => SubjectProficiencyH::inRandomOrder()->first()?->id ?? SubjectProficiencyH::factory(),
        ];
    }
}
