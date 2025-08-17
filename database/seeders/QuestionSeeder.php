<?php

namespace Database\Seeders;

use App\Constants\QuestionTypeConstant;
use App\Constants\UserTypeConstant;
use App\Models\Account\User;
use App\Models\Assessment\AnswerTextOption;
use App\Models\Assessment\Question;
use App\Models\MasterType\RefMasterType;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder {
    public function run(): void {
        $subjects = RefSubject::all();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();

        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();
        $essayType = RefMasterType::where('code', QuestionTypeConstant::ESSAY)->first();

        foreach ($subjects as $subject) {
            // Only create questions for child subjects (subjects without children)
            if ($subject->children()->count() > 0) {
                continue; // Skip parent subjects
            }
            
            $questionType = mt_rand(0,1) ? $multipleChoiceType : $essayType;

            $questions = Question::factory()->count(10)->create([
                'ref_subject_id' => $subject->id,
                'ref_subject_code' => $subject->code,
                'ref_question_type_code' => $questionType->code,
                'ref_question_type_id' => $questionType->id,
                'created_by' => $educators->random()->id,
            ]);

            foreach ($questions as $question) {
                // Create answer options (4 options per question)
                $correctAnswerIndex = rand(0, 3);
                for ($i = 0; $i < 4; $i++) {
                    AnswerTextOption::factory()->create([
                        'question_id' => $question->id,
                        'is_correct' => $i === $correctAnswerIndex,
                    ]);
                }
            }
        }
    }
}
