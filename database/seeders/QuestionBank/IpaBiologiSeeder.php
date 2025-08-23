<?php

namespace Database\Seeders\QuestionBank;

use Illuminate\Database\Seeder;
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


class IpaBiologiSeeder extends Seeder {
    public function run(): void {
         $SUBJ = "IPA-Fisika";

        $subject = RefSubject::where('code', SubjectConstant::BIOLOGY)->firstOrFail();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();

        $questions = [
            [
                "Berikut ini yang bukan merupakan faktor penyebab keanekaragaman hayati tingkat ekosistem adalah...",
                "1"
            ],
            [
                "Salah satu contoh keanekaragaman hayati tingkat spesies adalah...",
                "1"
            ],
            [
                "Reboisasi merupakan salah satu upaya pelestarian keanekaragaman hayati yang bertujuan untuk...",
                "1"
            ],
            [
                "Organel sel yang berfungsi sebagai tempat sintesis protein adalah...",
                "2"
            ],
            [
                "Proses masuknya molekul ke dalam sel melalui membran sel dengan bantuan protein transpor, tanpa memerlukan energi, disebut...",
                "2"
            ],
            [
                "Fungsi membrane sel yang utama adalah...",
                "2"
            ],
            [
                "Ketika seseorang mencium bau makanan yang lezat, sistem organ apa saja yang paling berperan dalam merespon stimulus tersebut?",
                "3"
            ],
            [
                "Ketika berlari kencang, sistem organ apa yang paling dominan bekerja untuk memenuhi kebutuhan oksigen tubuh?",
                "3"
            ],
            [
                "Jika seseorang mengalami luka, sistem organ apa yang paling berperan dalam proses penyembuhan?",
                "3"
            ],
            [
                "Pertumbuhan pada makhluk hidup dapat didefinisikan sebagai ...",
                "4"
            ],
            [
                "Hormon tumbuhan yang berperan dalam pemanjangan sel dan mempercepat pertumbuhan adalah ...",
                "4"
            ],
            [
                "Perkembangan pada hewan yang terjadi setelah lahir atau menetas disebut ...",
                "4"
            ],
            [
                "Seorang laki-laki bergolongan darah A heterozigot (IAIO) menikah dengan seorang perempuan bergolongan darah B heterozigot (IBIO). Kemungkinan golongan darah anak-anak mereka adalah...",
                "5"
            ],
            [
                "Seorang wanita normal memiliki ayah yang buta warna. Kemungkinan wanita tersebut membawa gen buta warna adalah...",
                "5"
            ],
            [
                "Hukum Mendel yang menyatakan bahwa setiap pasangan gen (alel) memisah secara bebas pada saat pembentukan gamet adalah...",
                "5"
            ],
            [
                "Berikut ini adalah ciri-ciri virus, kecuali...",
                "6"
            ],
            [
                "Siklus hidup virus yang ditandai dengan penyatuan materi genetik virus dengan materi genetik sel inang disebut...",
                "6"
            ],
            [
                "Peran virus yang menguntungkan bagi manusia adalah...",
                "6"
            ],
            [
                "Bioteknologi dalam bidang pertanian dapat dimanfaatkan untuk menghasilkan tanaman unggul. Salah satu caranya adalah dengan pemindahan gen dari satu spesies ke spesies lain dengan bantuan mikroorganisme. Teknik ini dikenal sebagai:",
                "7"
            ],
            [
                "Penerapan bioteknologi dalam bidang kesehatan yang paling menonjol adalah:",
                "7"
            ],
            [
                "Salah satu dampak positif penerapan bioteknologi dalam bidang pangan adalah:",
                "7"
            ],
            [
                "Teori evolusi yang dikemukakan oleh Charles Darwin dikenal dengan teori...",
                "8"
            ],
            [
                "Lamarck mengemukakan bahwa evolusi terjadi karena...",
                "8"
            ],
            [
                "Peristiwa berikut yang bukan merupakan contoh evolusi adalah...",
                "8"
            ]
    ];

        $answers = [
            [
                "Iklim",
                "Topografi",
                "Interaksi antarmakhluk hidup",
                "Mutasi gen"
            ],
            [
                "Berbagai jenis bunga mawar",
                "Berbagai jenis burung di hutan hujan tropis",
                "Berbagai jenis tumbuhan di padang rumput",
                "Berbagai jenis ikan di laut"
            ],
            [
                "Mencegah erosi",
                "Memperbaiki kualitas tanah",
                "Menambah keanekaragaman jenis tumbuhan",
                "Semua jawaban benar"
            ],
            [
                "Mitokondria",
                "Ribosom",
                "Retikulum endoplasma",
                "Lisosom"
            ],
            [
                "Transpor aktif",
                "Transpor pasif",
                "Endositosis",
                "Eksositosis"
            ],
            [
                "Melindungi sel dari kerusakan mekanik",
                "Menyimpan cadangan makanan",
                "Mengontrol keluar masuknya zat dari dan ke dalam sel",
                "Tempat terjadinya reaksi kimia sel"
            ],
            [
                "Sistem pencernaan dan sistem pernapasan",
                "Sistem saraf dan sistem peredaran darah",
                "Sistem saraf dan sistem pencernaan",
                "Sistem pernapasan dan sistem peredaran darah"
            ],
            [
                "Sistem pencernaan dan sistem ekskresi",
                "Sistem pernapasan dan sistem peredaran darah",
                "Sistem saraf dan sistem otot",
                "Sistem endokrin dan sistem reproduksi"
            ],
            [
                "Sistem pernapasan dan sistem peredaran darah",
                "Sistem saraf dan sistem otot",
                "Sistem peredaran darah dan sistem imun",
                "Sistem pencernaan dan sistem ekskresi"
            ],
            [
                "Proses bertambahnya ukuran dan volume tubuh.",
                "Proses menuju keadaan dewasa.",
                "Perubahan fungsi alat tubuh.",
                "Perubahan bentuk tubuh."
            ],
            [
                "Sitokinin",
                "Giberelin",
                "Asam absisat",
                "Etilen"
            ],
            [
                "Fase embrionik",
                "Fase pascaembrionik",
                "Fase pertumbuhan",
                "Fase perkembangan"
            ],
            [
                "A, B, AB, dan O",
                "A, B, dan AB",
                "A dan B",
                "Hanya A dan O"
            ],
            [
                "0%",
                "25%",
                "50%",
                "75%"
            ],
            [
                "Hukum Segregasi",
                "Hukum Asortasi Bebas",
                "Hukum Dominan",
                "Hukum Recessive"
            ],
            [
                "Dapat dikristalkan",
                "Hanya memiliki satu jenis asam nukleat (DNA atau RNA)",
                "Dapat memperbanyak diri di dalam sel hidup",
                "Memiliki organel sel seperti mitokondria dan ribosom"
            ],
            [
                "Siklus litik",
                "Siklus lisogenik",
                "Replikasi",
                "Transduksi"
            ],
            [
                "Menyebabkan penyakit seperti flu dan campak",
                "Digunakan dalam terapi gen untuk mengobati penyakit tertentu",
                "Menyebabkan penyakit seperti rabies dan polio",
                "Merusak jaringan tumbuhan"
            ],
            [
                "Kloning",
                "Hibridisasi",
                "Rekayasa genetika",
                "Fermentasi"
            ],
            [
                "Pembuatan antibiotik",
                "Pembuatan pupuk organik",
                "Pembuatan pestisida nabati",
                "Pembuatan bahan bakar alternatif"
            ],
            [
                "Penurunan kualitas gizi makanan",
                "Peningkatan penggunaan pestisida",
                "Produksi pangan yang lebih efisien",
                "Pencemaran lingkungan yang lebih tinggi"
            ],
            [
                "Jean-Baptiste Lamarck",
                "August Weismann",
                "Seleksi Alam",
                "Evolusi Biologi"
            ],
            [
                "Seleksi alam",
                "Mutasi gen",
                "Adaptasi terhadap lingkungan",
                "Perubahan genetik secara acak"
            ],
            [
                "Terbentuknya resistensi bakteri terhadap antibiotik",
                "Perubahan warna kulit manusia akibat paparan sinar matahari",
                "Munculnya variasi warna pada kupu-kupu",
                "Perkembangan sayap pada burung"
            ]
        ];

        $answer_keys = [
            [0, 0, 0, 1], // D
            [0, 1, 0, 0], // B
            [0, 0, 0, 1], // D
            [0, 1, 0, 0], // B
            [0, 1, 0, 0], // B
            [0, 0, 1, 0], // C
            [0, 0, 1, 0], // C
            [0, 1, 0, 0], // B
            [0, 0, 1, 0], // C
            [1, 0, 0, 0], // A
            [0, 1, 0, 0], // B
            [0, 1, 0, 0], // B
            [1, 0, 0, 0], // A
            [0, 0, 1, 0], // C
            [0, 1, 0, 0], // B
            [0, 0, 0, 1], // D
            [0, 1, 0, 0], // B
            [0, 1, 0, 0], // B
            [0, 0, 1, 0], // C
            [1, 0, 0, 0], // A
            [0, 0, 1, 0], // C
            [0, 0, 1, 0], // C
            [0, 0, 1, 0], // C
            [0, 1, 0, 0]  // B
        ];

         $proficiencies = [
            [
                "1", "operasi berbagai jenis bilangan termasuk bilangan pangkat serta kegunaannya dalam berbagai konteks yang sesuai"
            ],
            [
                "2", "penerapan barisan dan deret aritmetika dan geometri untuk menggeneralisasi pola bilangan"
            ],
            [
                "3", "penyelesaian persamaan (termasuk kuadrat dan eksponensial) dan sistem persamaan linear dan sistem pertidaksamaan linear untuk menentukan solusi dari permasalahan"
            ],
            [
                "4", "aplikasi perbandingan trigonometri pada segitiga siku-siku untuk menentukan sudut dan jarak atau tinggi"
            ],
            [
                "5", "penerapan matriks untuk merepresentasi dan menyederhanakan data"
            ],
            [
                "6", "pemodelan situasi dalam bentuk matematis dengan menggunakan fungsi dan sifat-sifatnya"
            ],
            [
                "7", "penyelidikan dan perbandingan data berdasarkan ukuran pemusatan dan ukuran penyebaran"
            ],
            [
                "8", "pemahaman peluang berdasarkan konsep permutasi dan kombinasi untuk membuat prediksi"
            ],
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
