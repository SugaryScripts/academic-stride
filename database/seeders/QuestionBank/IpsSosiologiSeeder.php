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

class IpsSosiologiSeeder extends Seeder
{
    public function run(): void
    {
        $SUBJ = "IPS-Sosiologi";

        $subject = RefSubject::where('code', SubjectConstant::SOCIOLOGY)->firstOrFail();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();

        $questions = [
            [
                "Jika $4^m = 25$, maka $2^{m+3} + 4^m$ =",
                "1"
            ],
            [
                "Nilai dari $\sqrt{4 + \sqrt{7}} - \sqrt{4 - \sqrt{7}}$ =",
                "1"
            ],
            [
                'Jika A + A³ = 5, maka nilai B adalah ...',
                "1"
            ],
            [
                'Proyeksi titik $(3,4)$ pada garis $y=x$ adalah ...',
                "2"
            ],
            [
                "Karena berselisih paham, si A dan B terjadi konflik. Pertentangan antara A dan B merupakan contoh pertentangan...",
                "2"
            ],
            [
                "Pengaruh yang diberikan oleh orang lain baik itu berupa pandangan, sikap, maupun perilaku sehingga orang yang mendapat pengaruh tersebut akan mengikuti tanpa berpikir panjang disebut...",
                "2"
            ],
            [
                "Setiap umat beragama akan menjalankan ibadah sesuai dengan ajaran agamanya. Ibadah agama yang dilakukan umat beragama merupakan contoh tindakan...",
                "3"
            ],
            [
                "Faktor ekternal yang dapat mempengaruhi integrasi sosial adalah ....",
                "3"
            ],
            [
                "Saat upacara bendera, seluruh siswa berbaris dengan tertib tanpa ada yang berbicara. Mereka mengikuti upacara bendera dengan khidmat. Faktor pembentuk keteraturan tersebut adalah...",
                "3"
            ],
            [
                "Salah satu contoh perubahan yang saat ini kita rasakan adalah bisa melihat berita luar negeri hanya dengan internet. Hal ini merupakan dampak dari perubahan sosial yang bermanfaat namun harus diimbangi dengan.....",
                "4"
            ],
            [
                "Cara hidup yang berubah menjadi cenderung sekuler yang terjadi pada hampir semua masyarakat dunia merupakan gejala globalisasi yang berada pada lingkup.....
A. Ilmu pengetahuan dan teknologi",
                "4"
            ],
            [
                "Respon masyarakat terhadap globalisasi ada yang menerima namun juga menolak. Bagi masyarakat yang menerima akan menumbuhkan....",
                "4"
            ],
            [
                "Seorang peneliti hendak melakukan penelitian mengenai kemiskinan di Jakarta. Namun, karena kesulitan mendapatkan data primer, peneliti tersebut memutuskan untuk menggunakan data sekunder. Data sekunder yang tepat untuk digunakan dalam contoh kasus tersebut adalah...",
                "5"
            ],
            [
                "Indonesia merupakan negara kepulauan yang memiliki beraneka ragam suku. Keadaan ini mengindikasikan bahwa program pembangunan yang disusun harus....",
                "5"
            ],
            [
                "Ketika melakukan sebuah penelitian mengenai pengaruh penggunaan laptop terhadap efektivitas belajar siswa, Rusdi menggunakan sampel siswa sekolah A dan B. Dari penjabaran tersebut, Rusdi ingin melakukan jenis penelitian...",
                "5"
            ]
        ];

        $answers = [
            [
                '35',
                '75',
                '65',
                '55',
            ],
            [
                '$\sqrt{2}$',
                '$\sqrt{4}$',
                '$\sqrt{3}$',
                '1',
            ],
            [
                '$\frac{4}{3}$',
                '$\frac{1}{2}$',
                '2',
                '$\frac{4}{5}$',
            ],
            [
                '$\left(\frac{4}{3},\frac{4}{3}\right)$',
                '$\left(\frac{9}{4},\frac{9}{4}\right)$',
                '$\left(\frac{7}{3},\frac{7}{3}\right)$',
                '$\left(\frac{7}{2},\frac{7}{2}\right)$',
            ],
            [
                "Agama",
                "Pribadi",
                "Politik",
                "Rasial"
            ],
            [
                "Imitasi",
                "Sugesti",
                "Identifikasi",
                "Simpati"
            ],
            [
                "Afektif",
                "Rasionalitas berorientasi nilai",
                "Tradisional",
                "Rasionalitas parlemen"
            ],
            [
                "Kesadaran diri sebagai makhluk sosial",
                "Tuntutan kebutuhan",
                "Semangat gotong royong",
                "Perasaan menyatu"
            ],
            [
                "Ketertiban",
                "Keteraturan",
                "Sosialisasi",
                "Keajegan"
            ],
            [
                "Peningkatan kualitas sumber daya manusia",
                "Kemajuan zaman",
                "Kemampuan manusia mengikuti perkembangan",
                "Adanya kerjasama antar individu"
            ],
            [
                "Ilmu pengetahuan dan teknologi",
                "Ekonomi",
                "Politik",
                "Agama"
            ],
            [
                "Inovasi baru dalam mencukupi kebutuhan sehari-hari",
                "Konflik baru di masyarakat",
                "Perubahan bagi masyarakat",
                "Sikap terbuka dan menerima pengaruh dari luar"
            ],
            [
                "FGD (Focus Group Discussion)",
                "Observasi",
                "Wawancara",
                "Studi pustaka"
            ],
            [
                "Memberikan manfaat bagi pemerintah",
                "Dapat diterima masyarakat sebagai objek pembangunan",
                "Dibuat dengan perencanaan matang oleh pemerintah pusat",
                "Sesuai dengan kebutuhan dan budaya yang berkembang dalam masyarakat"
            ],
            [
                "Deskriptif",
                "Eksplorasi",
                "Komparasi",
                "Eksperimen"
            ]
        ];

        $answer_keys = [
            [
                0,0,0,1 // D
            ],
            [
                1,0,0,0 // A
            ],
            [
                0,0,1,0 // C
            ],
            [
                1,0,0,0 // A
            ],
            [
                1,0,0,0 // A
            ],
            [
                0,1,0,0 // B
            ],
            [
                0,1,0,0 // B
            ],
            [
                0,1,0,0 // B
            ],
            [
                1,0,0,0 // A
            ],
            [
                0,0,1,0 // C
            ],
            [
                0,0,0,1 // D
            ],
            [
                1,0,0,0 // A
            ],
            [
                0,0,0,1 // D
            ],
            [
                0,0,0,1 // D
            ],
            [
                0,0,1,0 // C
            ],
        ];

        $proficiencies = [
            [
                "1", "fungsi sosiologi sebagai ilmu yang mempelajari masyarakat secara sistematis dan kritis dalam menyelesaikan masalah-masalah sosial"
            ],
            [
                "2", "ragam gejala sosial yang ada di dalam masyarakat"
            ],
            [
                "3", "keberagaman sosial dan kearifan lokal sebagai fondasi dalam memperkuat kebinekaan, toleransi, dan integrasi bangsa"
            ],
            [
                "4", "kesiapan individu dan masyarakat untuk mengantisipasi dan menyikapi pengaruh globalisasi terhadap perubahan sosial budaya di era digital"
            ],
            [
                "5", "rancangan penelitian sosial tentang pokok-pokok perencanaan seluruh penelitian yang tertuang dalam suatu kesatuan naskah secara ringkas, jelas, dan utuh sebagai penerapan teori sosiologi"
            ]
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

        foreach ($questions as $question_index => $question){
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


            foreach ($answers[$question_index] as $answer_index => $answer_item){
                AnswerTextOption::factory()->create([
                    'question_id' => $created_question->id,
                    'answer' => $answer_item,
                    'is_correct' => $answer_keys[$question_index][$answer_index],
                ]);
            }
        }

    }
}
