<?php

namespace Database\Factories\Attempt;

use App\Models\Account\User;
use App\Models\Assessment\Exam;
use App\Models\Attempt\SessionExam;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionExamFactory extends Factory {
    protected $model = SessionExam::class;

    public function definition(): array {
        $startedAt = $this->faker->dateTimeBetween('-1 month', 'now');
        $totalQuestions = $this->faker->numberBetween(20, 50);
        $correctAnswers = $this->faker->numberBetween(0, $totalQuestions);
        $percentageScore = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;

        return [
            'exam_id' => Exam::factory(),
            'user_id' => User::factory(),
            'started_at' => null,
            //'finished_at' => $this->faker->optional(0.8)->dateTimeBetween($startedAt, 'now'),
            'finished_at' => null,
            'total_score' => $correctAnswers * 5, // assuming 5 points per correct answer
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'percentage_score' => round($percentageScore, 2),
            'status' => $this->faker->randomElement(['in_progress', 'completed', 'abandoned', 'new']),
        ];
    }

    public function completed(): static {
        return $this->state(fn(array $attributes) => [
            'status' => 'completed',
            'finished_at' => $this->faker->dateTimeBetween($attributes['started_at'], 'now'),
        ]);
    }

    public function inProgress(): static {
        return $this->state(fn(array $attributes) => [
            'status' => 'in_progress',
            'finished_at' => null,
        ]);
    }

    public function new_(): static {
        return $this->state(fn(array $attributes) => [
            'status' => 'new',
            'finished_at' => null,
            'total_score' => 0,
            'correct_answers' => 0,
            'percentage_score' => 0,
        ]);
    }

    public function abandoned(): static {
        return $this->state(fn(array $attributes) => [
            'status' => 'abandoned',
            'finished_at' => null,
        ]);
    }
}
