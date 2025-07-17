<?php

namespace Database\Factories\Attempt;

use App\Models\Assessment\Question;
use App\Models\Attempt\SessionExam;
use App\Models\Attempt\SessionQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class SessionQuestionFactory extends Factory {
    protected $model = SessionQuestion::class;

    public function definition(): array {
        return [
            'session_exam_id' => SessionExam::factory(),
            'question_id' => Question::factory(),
            'question_order' => $this->faker->numberBetween(1, 50),
        ];
    }

    public function forSession(SessionExam $session): static {
        return $this->state(fn(array $attributes) => [
            'session_exam_id' => $session->id,
        ]);
    }

    public function forQuestion(Question $question): static {
        return $this->state(fn(array $attributes) => [
            'question_id' => $question->id,
        ]);
    }

    public function withOrder(int $order): static {
        return $this->state(fn(array $attributes) => [
            'question_order' => $order,
        ]);
    }
}
