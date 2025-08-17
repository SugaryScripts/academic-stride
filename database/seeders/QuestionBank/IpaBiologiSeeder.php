<?php

namespace Database\Seeders\QuestionBank;

use App\Constants\QuestionTypeConstant;
use App\Constants\SubjectConstant;
use App\Constants\UserTypeConstant;
use App\Models\Account\User;
use App\Models\MasterType\RefMasterType;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Seeder;

class IpaBiologiSeeder extends Seeder {
    public function run(): void {
        $subject = RefSubject::where('code', SubjectConstant::INDONESIAN)->firstOrFail();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();

        $questions = [
            [

            ]
        ];
    }
}
