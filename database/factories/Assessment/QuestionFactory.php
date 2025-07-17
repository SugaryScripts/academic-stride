<?php

namespace Database\Factories\Assessment;

use App\Constants\QuestionTypeConstant;
use App\Models\Account\User;
use App\Models\Assessment\Question;
use App\Models\MasterType\RefMasterType;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory {
    protected $model = Question::class;

    public function definition(): array {
        $ref_subject = RefSubject::inRandomOrder()->first();
        if (!$ref_subject) {
            $ref_subject = RefSubject::factory()->create();
        }

        // TODO: question type essay
        $qstn_type = RefMasterType::where('type', QuestionTypeConstant::REF_MASTER_QUESTION_TYPE)
            ->inRandomOrder()
            ->first();
        return [
            'question_text' => $this->faker->paragraph(2) . '?',
            'ref_subject_code' => $ref_subject->code,
            'ref_subject_id' => $ref_subject->id,
            'ref_question_type_code' => QuestionTypeConstant::REF_MASTER_QUESTION_TYPE,
            'ref_question_type_id' => RefMasterType::where('type', QuestionTypeConstant::REF_MASTER_QUESTION_TYPE)
                ->where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)
                ->firstOrFail()->value('id'),
            'is_active' => $this->faker->boolean(90),
            'created_by' => User::factory(),
        ];
    }

    public function multipleChoice(): static {
        return $this->state(fn(array $attributes) => [
            'ref_question_type_code' => 'MC',
        ]);
    }

    public function trueFalse(): static {
        return $this->state(fn(array $attributes) => [
            'ref_question_type_code' => 'TF',
        ]);
    }

    public function active(): static {
        return $this->state(fn(array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function forSubject(RefSubject $subject): static {
        return $this->state(fn(array $attributes) => [
            'ref_subject_id' => $subject->id,
            'ref_subject_code' => $subject->code,
        ]);
    }
}
