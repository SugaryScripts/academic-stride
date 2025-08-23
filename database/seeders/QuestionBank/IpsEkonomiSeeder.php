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
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IpsEkonomiSeeder extends Seeder
{

    public function run(): void
    {
        $SUBJ = "IPS-EKONMI";

        $subject = RefSubject::where('code', SubjectConstant::ECONOMY)->firstOrFail();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();

        $questions = [
            ["Masalah-masalah ekonomi modern meliputi...", "1"],
            ["Strategi diversifikasi usaha yang paling efektif bagi petani menghadapi harga anjlok adalah...", "1"],
            ["Upaya paling tepat untuk mengatasi kelangkaan akibat bencana alam adalah...", "1"],
            ["Berapa total rupiah yang diterima Firman dari transaksi ekspor-impor?", "2"],
            ["Berapa total pendapatan bengkel 'Makmur'?", "2"],
            ["Hitunglah laba bersih perusahaan setelah pajak", "2"],
            ["Kebijakan bantuan modal untuk usaha kecil termasuk permasalahan...", "3"],
            ["Perubahan perilaku konsumen akibat e-commerce yang paling menonjol adalah...", "3"],
            ["Dampak kebijakan pengurangan subsidi pupuk terhadap pasar beras adalah...", "4"],
            ["Bentuk kebijakan fiskal untuk mengatasi inflasi adalah...", "4"],
            ["Penyebab utama pengangguran di kalangan anak muda Jakarta adalah...", "4"],
            ["Berdasarkan fungsinya, APBN berperan sebagai alat...", "4"]
        ];

        $answers = [
            ["1, 2, dan 3", "1, 3, dan 5", "2, 4, dan 5", "3, 4, dan 5"],
            ["Mengganti tanaman padi", "Menunda panen", "Mengolah hasil menjadi produk lain", "Mengurangi pengeluaran produksi"],
            ["Memanfaatkan sarana terbatas untuk hasilkan barang/jasa", "Menambah kebutuhan manusia", "Mengurangi sarana pemuas", "Gunakan sarana tidak terbatas"],
            ["123.000.000", "125.000.000", "135.000.000", "124.000.000"],
            ["16.800.000", "14.600.000", "19.750.000", "16.700.000"],
            ["15.000.000", "19.370.000", "18.500.000", "16.780.000"],
            ["Ekonomi campuran", "Ekonomi mikro", "Ekonomi terpusat", "Ekonomi makro"],
            ["Utamakan kualitas produk", "Setia pada merek lokal", "Beli spontan karena diskon", "Malas bandingkan harga"],
            ["Permintaan beras bergeser kiri", "Permintaan beras bergeser kanan", "Penawaran beras bergeser kanan", "Penawaran beras bergeser kiri"],
            ["Pengawasan harga", "Peningkatan tarif pajak", "Kebijakan upah", "Peningkatan produksi"],
            ["Kurang investasi asing", "UMR terlalu tinggi", "Kurikulum tidak sesuai dengan pasar kerja", "Pilih sektor informal"],
            ["Stabilisasi", "Perencanaan", "Alokasi", "Otorisasi"]
        ];

        $answer_keys = [
            [0,1,0,0], // B
            [0,0,1,0], // C
            [1,0,0,0], // A
            [0,0,0,1], // D
            [0,0,0,1], // D
            [0,0,1,0], // C
            [1,0,0,0], // A
            [0,0,1,0], // C
            [0,0,0,1], // D
            [0,1,0,0], // B
            [0,0,1,0], // C
            [0,0,0,1]  // D
        ];

        $proficiencies = [
            ["1", "esensi ilmu ekonomi untuk memenuhi kebutuhan hidup"],
            ["2", "pengetahuan serta keterampilan keuangan dan akuntansi dasar"],
            ["3", "perkembangan mikroekonomi di era digital"],
            ["4", "makroekonomi dan dampaknya terhadap perekonomian nasional"]
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
