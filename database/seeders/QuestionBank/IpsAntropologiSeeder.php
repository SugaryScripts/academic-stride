<?php

namespace Database\Seeders\QuestionBank;

use App\Constants\QuestionTypeConstant;
use App\Constants\SubjectConstant;
use App\Constants\UserTypeConstant;
use App\Models\Account\User;
use App\Models\Assessment\AnswerTextOption;
use App\Models\Assessment\Question;
use App\Models\MasterType\RefMasterType;
use App\Models\MasterType\RefSubject;
use App\Models\MasterType\SubjectProficiencyD;
use App\Models\MasterType\SubjectProficiencyH;
use Illuminate\Database\Seeder;

class IpsAntropologiSeeder extends Seeder
{
    public function run(): void
    {
        $SUBJ = "IPS-ANTRGI";

        $subject = RefSubject::where('code', SubjectConstant::ANTHROPOLOGY)->firstOrFail();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();

        $questions = [
            ["Dalam penelitian etnografi, penting bagi peneliti untuk memilih informan yang memiliki keterlibatan langsung dengan budaya yang sedang dipelajari. Mengapa keterlibatan langsung ini menjadi krusial?", "1"],
            ["Antropologi terapan memiliki peran penting dalam menyelesaikan masalah sosial. Jika dihadapkan pada masalah kemiskinan struktural, bagaimana cara antropologi terapan berperan?", "1"],
            ["Manakah yang merupakan objek kajian paling sesuai untuk ilmu antropologi?", "1"],
            ["Dari skenario berikut, manakah yang paling mungkin menyebabkan ketegangan dalam masyarakat akibat perubahan budaya?", "2"],
            ["Penggunaan Bahasa Jawa krama inggil dalam situasi tertentu bertujuan untuk...", "2"],
            ["Berikan contoh penerapan konsep relativisme budaya dalam kehidupan sehari-hari...", "2"]
        ];

        $answers = [
            ["Memilih informan berpengalaman tapi tidak aktif", "Memastikan informan aktif dalam praktik budaya", "Memilih berdasarkan pendidikan formal", "Memastikan informan paham akademis"],
            ["Mengembangkan program bantuan pangan", "Menganalisis ekonomi global", "Merancang kebijakan berbasis etnografi", "Mendorong tinggalkan tradisi lokal"],
            ["Perkembangan ekonomi digital", "Hubungan perdagangan negara Asia", "Sistem kekerabatan masyarakat adat", "Evolusi teknologi Revolusi Industri"],
            ["Penggunaan aplikasi transportasi", "Pengenalan teknologi pendidikan", "Kampanye pariwisata lokal", "Perubahan sistem ekonomi agraris ke industri"],
            ["Menunjukkan rasa hormat", "Tidak menggunakan bahasa asing", "Menghapus perbedaan status", "Melestarikan bahasa Jawa"],
            ["Menghapus identitas budaya lokal", "Menghormati praktik budaya lain", "Menyamakan ragam bahasa", "Memaksa ikuti budaya mayoritas"]
        ];

        $answer_keys = [
            [0,1,0,0], // B
            [0,0,1,0], // C
            [0,0,1,0], // C
            [0,0,0,1], // D
            [1,0,0,0], // A
            [0,1,0,0]  // B
        ];

        $proficiencies = [
            ["1", "pengantar antropologi dan penerapannya dalam kehidupan sehari-hari"],
            ["2", "antropologi sebagai sarana menjaga kebinekaan dan integrasi bangsa"]
        ];

        // proficiencies
        $this->command->info("Creating $SUBJ proficiencies...");
        foreach ($proficiencies as $proficiency) {
            SubjectProficiencyH::factory()->create([
                'no' => $proficiency[0],
                'parameter' => $proficiency[1],
                'ref_subject_id' => $subject->id,
            ]);
        }

        foreach ($questions as $question_index => $question) {
            $this->command->info("Creating $SUBJ questions $subject->id, it's proficiency $question[1], and answers with keys...");
            $created_question = Question::create([
                'question_text' => $question[0],
                'ref_subject_id' => $subject->id,
                'ref_subject_code' => $subject->code,
                'ref_question_type_code' => $multipleChoiceType->code,
                'ref_question_type_id' => $multipleChoiceType->id,
                'is_active' => true,
                'created_by' => $educators->random()->id,
            ]);

            $h_id = SubjectProficiencyH::where('ref_subject_id', $subject->id)
                ->where('no', $question[1])->firstOrFail()->id;
            SubjectProficiencyD::factory()->create([
                'question_id' => $created_question->id,
                'subject_proficiency_h_id' => $h_id
            ]);


            foreach ($answers[$question_index] as $answer_index => $answer_item) {
                AnswerTextOption::factory()->create([
                    'question_id' => $created_question->id,
                    'answer' => $answer_item,
                    'is_correct' => $answer_keys[$question_index][$answer_index],
                ]);
            }
        }
    }
}
