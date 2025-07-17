<?php

namespace Database\Seeders;

use App\Constants\UserTypeConstant;
use App\Models\Account\User;
use App\Models\Assessment\AnswerTextOption;
use App\Models\Assessment\Question;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder {
    public function run(): void {
        $subjects = RefSubject::all();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();

        foreach ($subjects as $subject) {
            $questions = Question::factory()->count(50)->create([
                'ref_subject_id' => $subject->id,
                'ref_subject_code' => $subject->code,
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
