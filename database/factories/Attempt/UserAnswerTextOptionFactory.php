<?php

namespace Database\Factories\Attempt;

use App\Models\Account\User;
use App\Models\Assessment\AnswerTextOption;
use App\Models\Attempt\SessionQuestion;
use App\Models\Attempt\UserAnswerTextOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAnswerTextOptionFactory extends Factory {
    protected $model = UserAnswerTextOption::class;

    public function definition(): array {
        return [
            'session_question_id' => SessionQuestion::factory(),
            'user_id' => User::factory(),
            'selected_answer_id' => AnswerTextOption::factory(),
            'is_correct' => $this->faker->boolean(60), // 60% chance of correct answer
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

    public function forSessionQuestion(SessionQuestion $sessionQuestion): static {
        return $this->state(fn(array $attributes) => [
            'session_question_id' => $sessionQuestion->id,
        ]);
    }

    public function forUser(User $user): static {
        return $this->state(fn(array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}
