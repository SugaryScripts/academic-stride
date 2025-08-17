<?php

namespace Database\Seeders;

use App\Constants\QuestionTypeConstant;
use App\Constants\UserTypeConstant;
use App\Models\MasterType\RefMasterType;
use Illuminate\Database\Seeder;

class RefMasterTypeSeeder extends Seeder {
    public function run(): void {
        $questionTypes = [
            [
                'name' => 'Multiple Choice Text',
                'description' => 'Multiple choice questions with text options',
                'code' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'type' => QuestionTypeConstant::REF_MASTER_QUESTION_TYPE
            ],
            [
                'name' => 'Multiple Choice Image',
                'description' => 'Multiple choice questions with image options',
                'code' => 'MCI',
                'type' => QuestionTypeConstant::REF_MASTER_QUESTION_TYPE
            ],
            [
                'name' => 'Matching',
                'description' => 'Matching questions where students connect related items',
                'code' => 'MAT',
                'type' => QuestionTypeConstant::REF_MASTER_QUESTION_TYPE
            ],
            [
                'name' => 'Essay',
                'description' => 'Open-ended essay questions',
                'code' => QuestionTypeConstant::ESSAY,
                'type' => QuestionTypeConstant::REF_MASTER_QUESTION_TYPE
            ]
        ];

        $userTypes = [
            [
                'name' => 'Student',
                'description' => 'Users who take exams and participate in learning activities.',
                'code' => UserTypeConstant::STUDENT,
                'type' => UserTypeConstant::REF_MASTER_USER_TYPE
            ],
            [
                'name' => 'Educator',
                'description' => 'Users who create, manage, and grade exams, and instruct students.',
                'code' => UserTypeConstant::EDUCATOR,
                'type' => UserTypeConstant::REF_MASTER_USER_TYPE
            ],
            [
                'name' => 'Institution',
                'description' => 'Users who create, manage, and grade exams, and instruct students.',
                'code' => UserTypeConstant::INSTITUTION,
                'type' => UserTypeConstant::REF_MASTER_USER_TYPE
            ],
            [
                'name' => 'Analyser',
                'description' => 'Users who access and analyze performance data and reports.',
                'code' => UserTypeConstant::ANALYSER,
                'type' => UserTypeConstant::REF_MASTER_USER_TYPE
            ],
            [
                'name' => 'Admin',
                'description' => 'Users that can do all.',
                'code' => UserTypeConstant::ADMIN,
                'type' => UserTypeConstant::REF_MASTER_USER_TYPE
            ]
        ];

        foreach ($userTypes as $userType) {
            RefMasterType::create($userType);
        }

        foreach ($questionTypes as $questionType) {
            RefMasterType::create($questionType);
        }
    }
}
