<?php

namespace Database\Factories\MasterType;

use App\Models\MasterType\RefMasterType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefMasterTypeFactory extends Factory {
    protected $model = RefMasterType::class;

    public function definition(): array {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'code' => $this->faker->unique()->lexify('????'),
            'type' => 'question_type',
        ];
    }

    public function multipleChoiceText(): static
    {
        return $this->state([
            'name' => 'Multiple Choice Text',
            'code' => 'MCT',
            'type' => 'question_type',
        ]);
    }

    public function multipleChoiceImage(): static
    {
        return $this->state([
            'name' => 'Multiple Choice Image',
            'code' => 'MCI',
            'type' => 'question_type',
        ]);
    }

    public function matching(): static
    {
        return $this->state([
            'name' => 'Matching',
            'code' => 'MAT',
            'type' => 'question_type',
        ]);
    }

    public function essay(): static
    {
        return $this->state([
            'name' => 'Essay',
            'code' => 'ESY',
            'type' => 'question_type',
        ]);
    }
}
