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

class IpsSejarahSeeder extends Seeder
{
    public function run(): void
    {
        $SUBJ = "IPS-SEJARH";

        $subject = RefSubject::where('code', SubjectConstant::HISTORY)->firstOrFail();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();

        $questions = [
            ["Konsep dasar ilmu sejarah yang paling tepat untuk mengkaji urutan waktu peristiwa sejarah adalah...", "1"],
            ["Penelitian sejarah yang bertujuan untuk mengetahui sebab-akibat terjadinya suatu peristiwa sejarah disebut...", "1"],
            ["Mengapa mempelajari sejarah penting untuk memahami masa kini dan merencanakan masa depan?", "1"],
            ["Kerajaan Hindu-Buddha yang terkenal dengan pusat pemerintahannya di Jawa Tengah dan memiliki peninggalan candi Borobudur adalah...", "2"],
            ["Prasasti yang menjadi bukti keberadaan kerajaan Kutai dan menggunakan bahasa Sansekerta adalah...", "2"],
            ["Kerajaan Islam pertama di Indonesia yang berdiri di pantai utara Sumatera adalah...", "2"],
            ["Faktor utama yang mendorong bangsa Eropa melakukan penjelajahan samudra adalah...", "3"],
            ["Peristiwa yang menandai dimulainya penjajahan bangsa Barat di Indonesia adalah...", "3"],
            ["Tujuan utama dari sistem tanam paksa (cultuurstelsel) yang diterapkan oleh pemerintah Hindia Belanda adalah...", "3"],
            ["Peran organisasi Budi Utomo dalam pergerakan nasional adalah...", "4"],
            ["Sumpah Pemuda yang dicetuskan pada tanggal 28 Oktober 1928 memiliki makna penting bagi pergerakan nasional, yaitu...", "4"],
            ["Organisasi pergerakan nasional yang bersifat non-kooperatif adalah...", "4"],
            ["Faktor utama yang mendorong Jepang untuk menduduki Indonesia adalah...", "5"],
            ["Peristiwa Rengasdengklok terjadi karena...", "5"],
            ["Tujuan Jepang membentuk BPUPKI dan PPKI adalah...", "5"],
            ["Surat Perintah Sebelas Maret (Supersemar) yang dikeluarkan pada tahun 1966 menjadi dasar bagi...", "6"],
            ["Desentralisasi adalah salah satu perubahan penting pada masa reformasi. Ini berarti...", "6"],
            ["Perkembangan demokrasi di Indonesia setelah reformasi ditandai dengan...", "6"]
        ];

        $answers = [
            ["Periodisasi", "Kausalitas", "Kronologi", "Historiografi"],
            ["Analisis sumber", "Interpretasi", "Verifikasi", "Kausalitas"],
            ["Karena sejarah hanya berisi catatan masa lalu", "Karena sejarah membantu kita memahami akar permasalahan", "Karena sejarah tidak memiliki hubungan dengan teknologi", "Karena sejarah hanya penting bagi sejarawan"],
            ["Sriwijaya", "Majapahit", "Mataram Kuno", "Kutai"],
            ["Yupa", "Tugu", "Kebon Kopi", "Pasir Panjang"],
            ["Demak", "Samudera Pasai", "Aceh", "Mataram Islam"],
            ["Keinginan menyebarkan agama Kristen", "Keinginan menemukan rempah-rempah", "Keinginan menjalin persahabatan", "Keinginan memperluas wilayah"],
            ["Kedatangan VOC di Batavia", "Penemuan jalur laut oleh Vasco da Gama", "Pendaratan Portugis di Malaka", "Pembentukan Tanam Paksa"],
            ["Meningkatkan kesejahteraan petani", "Memenuhi kebutuhan pangan", "Mendapat keuntungan besar", "Mengembangkan infrastruktur"],
            ["Mendorong persatuan melalui pendidikan", "Mendorong persatuan melalui politik", "Mendorong persatuan melalui ekonomi", "Mendorong persatuan melalui agama"],
            ["Menegaskan semangat kedaerahan", "Menegaskan persatuan bangsa", "Menegaskan perlawanan penjajah", "Menegaskan kerja sama antar bangsa"],
            ["Budi Utomo", "Sarekat Islam", "Indische Partij", "Perhimpunan Indonesia"],
            ["Menyebarkan agama Buddha", "Kekayaan SDA Indonesia", "Membantu kemerdekaan", "Mengembangkan infrastruktur"],
            ["Perbedaan pendapat golongan muda-tua", "Upaya Jepang mencegah proklamasi", "Perundingan Indonesia-Belanda", "Pemerintahan sementara"],
            ["Membentuk pemerintahan demokratis", "Mempersiapkan kemerdekaan ala Jepang", "Pendidikan politik", "Mencari dukungan untuk perang"],
            ["Berakhirnya Demokrasi Liberal", "Terbentuknya Kabinet Ampera", "Lahirnya Orde Baru", "Terbentuknya MPRS"],
            ["Pusat menarik kekuasaan", "Daerah memiliki otonomi luas", "Presiden berkuasa lebih besar", "Partai politik dilarang"],
            ["Pemilu demokratis multipartai", "Pemerintahan sentralistik", "Penguatan presiden", "Pembatasan kebebasan pers"]
        ];

        $answer_keys = [
            [0,0,1,0], // C
            [0,0,0,1], // D
            [0,1,0,0], // B
            [0,0,1,0], // C
            [1,0,0,0], // A
            [0,1,0,0], // B
            [0,1,0,0], // B
            [0,0,1,0], // C
            [0,0,1,0], // C
            [1,0,0,0], // A
            [0,1,0,0], // B
            [0,0,0,1], // D
            [0,1,0,0], // B
            [1,0,0,0], // A
            [0,1,0,0], // B
            [0,0,1,0], // C
            [0,1,0,0], // B
            [1,0,0,0]  // A
        ];

        $proficiencies = [
            ["1", "konsep dasar ilmu sejarah serta mengenali penelitian sejarah"],
            ["2", "berbagai peristiwa/kejadian penting masa kerajaan Hindu-Budha hingga Islam"],
            ["3", "masa penjajahan bangsa Barat dan perlawanan rakyat"],
            ["4", "pergerakan nasional dan pembentukan identitas keindonesiaan"],
            ["5", "pendudukan Jepang dan upaya mempertahankan kemerdekaan"],
            ["6", "perkembangan pemerintahan Indonesia dari Sukarno hingga reformasi"]
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
