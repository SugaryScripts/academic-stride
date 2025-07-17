<?php

namespace Database\Factories\Assessment;

use App\Models\Assessment\Exam;
use App\Models\Assessment\ExamSubjectConfiguration;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamSubjectConfigurationFactory extends Factory {
    protected $model = ExamSubjectConfiguration::class;

    public function definition(): array {
        return [
            'exam_id' => Exam::factory(),
            'subject_id' => RefSubject::factory(),
            'question_count' => $this->faker->numberBetween(5, 20),
            'notes' => $this->faker->optional(0.5)->sentence(),
        ];
    }

    public function forExam(Exam $exam): static {
        return $this->state(fn(array $attributes) => [
            'exam_id' => $exam->id,
        ]);
    }

    public function forSubject(RefSubject $subject): static {
        return $this->state(fn(array $attributes) => [
            'subject_id' => $subject->id,
        ]);
    }
}
