<?php

namespace Database\Factories\Assessment;

use App\Constants\EducationLevelConstant;
use App\Constants\UserTypeConstant;
use App\Models\Account\User;
use App\Models\Assessment\Exam;
use App\Models\MasterType\RefEducation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory {
    protected $model = Exam::class;

    public function definition(): array {
        $edu_codes = EducationLevelConstant::allCodes();
        $ref_education = RefEducation::whereIn('code', $edu_codes)
            ->inRandomOrder()
            ->first();
        if (!$ref_education) {
            $ref_education = RefEducation::inRandomOrder()->firstOrFail(); // Will throw error if table is empty
        }

        // Get a random user who is an 'Educator'
        $educator = User::where('user_type_code', UserTypeConstant::EDUCATOR) // Assuming 'EDU' is the code for Educators
            ->inRandomOrder()
            ->first();
        if (!$educator) {
            $educator = User::factory()->educator()->create();
        }
        return [
            'title' => $this->faker->sentence(3, true),
            'description' => $this->faker->optional(0.7)->paragraph(3),
            'total_questions' => $this->faker->numberBetween(20, 50),
            'duration_minutes' => $this->faker->randomElement([60, 90, 120, 180]),
            'ref_education_code' => $ref_education->code,
            'ref_education_id' => $ref_education->id,
            'created_by' => $educator->id,
            'is_active' => $this->faker->boolean(85),
        ];
    }

    public function active(): static {
        return $this->state(fn(array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function inactive(): static {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }
}
