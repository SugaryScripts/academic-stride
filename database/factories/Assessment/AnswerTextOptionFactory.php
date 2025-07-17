<?php

namespace Database\Factories\Assessment;

use App\Models\Assessment\AnswerTextOption;
use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerTextOptionFactory extends Factory {
    protected $model = AnswerTextOption::class;

    public function definition(): array {
        return [
            'question_id' => Question::factory(),
            'answer' => $this->faker->sentence(4),
            'is_correct' => false,
        ];
    }

    public function correct(): static {
        return $this->state(fn(array $attributes) => [
            'is_correct' => true,
        ]);
    }

    public function incorrect(): static {
        return $this->state(fn(array $attributes) => [
            'is_correct' => false,
        ]);
    }

    public function forQuestion(Question $question): static {
        return $this->state(fn(array $attributes) => [
            'question_id' => $question->id,
        ]);
    }
}
