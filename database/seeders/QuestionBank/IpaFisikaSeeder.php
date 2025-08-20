<?php

namespace Database\Seeders\QuestionBank;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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


class IpaFisikaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SUBJ = "IPA-Fisika";

        $subject = RefSubject::where('code', SubjectConstant::PHYSICS)->firstOrFail();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();

        $questions = [
            [
                "Sebuah mobil bergerak lurus dengan kecepatan awal 10 m/s dan mengalami percepatan tetap sebesar 2 m/s². Berapakah kecepatan mobil tersebut setelah bergerak selama 5 detik?",
                "1"
            ],
            [
                "Sebuah partikel bergerak dengan persamaan posisi r(t) = (t² + 2t)i + (3t)j. Berapakah kecepatan rata-rata partikel antara t=1 s dan t=3 s?",
                "1"
            ],
            [
                "Sebuah balok bermassa 2 kg ditarik dengan gaya 10 N pada bidang datar licin. Berapakah percepatan balok tersebut?",
                "1"
            ],
            [
                "Pemanfaatan energi surya (matahari) dapat dilakukan melalui berbagai cara, kecuali...",
                "2"
            ],
            [
                "Salah satu keuntungan utama penggunaan energi alternatif adalah...",
                "2"
            ],
            [
                "Energi alternatif yang berasal dari bahan organik disebut...",
                "2"
            ],
            [
                "Sebuah benda dengan volume 0,2 m³ dimasukkan ke dalam air. Jika massa jenis air adalah 1000 kg/m³, dan percepatan gravitasi adalah 10 m/s², berapakah gaya apung yang dialami benda tersebut?",
                "3"
            ],
            [
                "Sebuah balok kayu terapung di air dengan 2/3 bagian volumenya tercelup. Jika massa jenis air 1000 kg/m³,massa jenis balok kayu adalah ...",
                "3"
            ],
            [
                "Prinsip Archimedes menyatakan bahwa ...",
                "3"
            ],
            [
                "Ketika kita memanaskan air di dalam panci, energi panas dari kompor akan berpindah ke air. Perpindahan panas ini terjadi melalui proses...",
                "4"
            ],
            [
                "Sebuah setrika listrik bekerja dengan prinsip termodinamika. Kalor yang dihasilkan oleh elemen pemanas digunakan untuk...",
                "4"
            ],
            [
                "Hukum pertama termodinamika menyatakan bahwa...",
                "4"
            ],
            [
                "Contoh penerapan gelombang bunyi dalam kehidupan sehari-hari adalah...",
                "5"
            ],
            [
                "Persamaan gelombang berjalan pada suatu tali dinyatakan sebagai y = 0.02 sin(20t - 0.2x), dimana x dan y dalam cm dan t dalam sekon. Berapa panjang gelombang tersebut?",
                "5"
            ],
            [
                "Sebuah sumber bunyi memiliki frekuensi 440 Hz. Jika cepat rambat bunyi di udara adalah 343 m/s, berapa panjang gelombang bunyi tersebut?",
                "5"
            ],
            [
                "Dua buah muatan listrik, q₁ = +2μC dan q₂ = -4μC, terpisah pada jarak 2 cm. Jika konstanta Coulomb k = 9 x 10⁹ Nm²/C², berapakah gaya interaksi antara kedua muatan tersebut?",
                "6"
            ],
            [
                "Sebuah kawat lurus dialiri arus listrik sebesar 5 A. Jika induksi magnetik di suatu titik yang berjarak 2 cm dari kawat adalah 5 x 10⁻⁵ T, berapakah permeabilitas magnetik vakum (μ₀)?",
                "6"
            ],
            [
                "Sebuah transformator step-up memiliki perbandingan lilitan primer dan sekunder adalah 1:5. Jika tegangan pada kumparan primer adalah 12 V, berapakah tegangan pada kumparan sekunder?",
                "6"
            ],
            [
                "Salah satu penerapan teori kuantum dalam kehidupan sehari-hari adalah:",
                "7"
            ],
            [
                "Dalam fisika modern, massa dan energi adalah dua hal yang:",
                "7"
            ],
            [
                "Salah satu perbedaan utama antara teknologi digital dan analog adalah:",
                "7"
            ]
    ];

        $answers = [
            [
                "10 m/s",
                "15 m/s",
                "20 m/s",
                "25 m/s",
                "30 m/s"
            ],
            [
                "4i + 3j",
                "5i + 3j",
                "6i + 3j",
                "7i + 3j",
                "8i + 3j"
            ],
            [
                "2 m/s²",
                "5 m/s²",
                "10 m/s²",
                "20 m/s²",
                "25 m/s²"
            ],
            [
                "Pembangkit listrik tenaga surya (PLTS)",
                "Pemanas air tenaga surya",
                "Panel surya pada kendaraan",
                "Membakar kayu untuk memasak"
            ],
            [
                "Tidak menghasilkan emisi gas rumah kaca",
                "Biaya produksi yang sangat murah",
                "Sumber energi yang tidak terbatas dan tersedia di semua tempat",
                "Semua jawaban benar"
            ],
            [
                "Energi biomassa",
                "Energi angin",
                "Energi nuklir",
                "Energi fosil"
            ],
            [
                "200 N",
                "2000 N",
                "20000 N",
                "20 N"
            ],
            [
                "333 kg/m³",
                "500 kg/m³",
                "667 kg/m³",
                "750 kg/m³"
            ],
            [
                "Tekanan dalam fluida selalu diteruskan ke segala arah dengan sama besar.",
                "Benda yang tercelup sebagian atau seluruhnya dalam fluida akan mengalami gaya apung yang sama besar dengan berat fluida yang dipindahkan.",
                "Tekanan hidrostatis berbanding lurus dengan kedalaman.",
                "Viskositas fluida berbanding terbalik dengan suhu."
            ],
            [
                "Konduksi",
                "Konveksi",
                "Radiasi",
                "Absorpsi"
            ],
            [
                "Memindahkan panas secara konveksi ke pakaian",
                "Memanaskan pakaian melalui kontak langsung (konduksi)",
                "Memancarkan panas secara radiasi ke pakaian",
                "Semua benar"
            ],
            [
                "Energi tidak dapat diciptakan dan dimusnahkan, tetapi dapat diubah dari satu bentuk ke bentuk lain",
                "Entropi suatu sistem cenderung meningkat seiring waktu",
                "Suatu sistem tidak dapat mencapai suhu nol absolut",
                "Kalor mengalir dari benda bersuhu tinggi ke benda bersuhu rendah"
            ],
            [
                "Sinar matahari",
                "Sinar X",
                "USG pada bidang medis",
                "Gelombang radio"
            ],
            [
                "2 cm",
                "5 cm",
                "10 cm",
                "20 cm"
            ],
            [
                "0.78 m",
                "1.28 m",
                "1.77 m",
                "2.00 m"
            ],
            [
                "180 N",
                "90 N",
                "-180 N",
                "-90 N"
            ],
            [
                "4π x 10⁻⁷ Tm/A",
                "2π x 10⁻⁷ Tm/A",
                "10⁻⁷ Tm/A",
                "2 x 10⁻⁷ Tm/A"
            ],
            [
                "2.4 V",
                "60 V",
                "12 V",
                "24 V"
            ],
            [
                "Sistem GPS",
                "Laser",
                "Teleskop",
                "Mesin uap"
            ],
            [
                "Berbeda dan tidak berhubungan",
                "Berhubungan erat dan dapat saling dipertukarkan",
                "Hanya berlaku pada benda-benda yang bergerak sangat cepat",
                "Hanya berlaku pada benda-benda yang sangat kecil"
            ],
            [
                "Teknologi digital lebih mudah dipahami daripada teknologi analog.",
                "Teknologi digital menggunakan sinyal kontinu, sedangkan teknologi analog menggunakan sinyal diskrit.",
                "Teknologi digital menggunakan sinyal diskrit, sedangkan teknologi analog menggunakan sinyal kontinu.",
                "Teknologi digital lebih tua dari teknologi analog."
            ]
        ];

        $answer_keys = [
            [0, 0, 1, 0, 0], // C
            [0, 0, 1, 0, 0], // C
            [0, 1, 0, 0, 0], // B
            [0, 0, 0, 1], // D
            [0, 0, 1, 0], // B
            [0, 0, 1, 0], // C
            [0, 1, 0, 0], // B
            [0, 0, 1, 0], // C
            [0, 0, 1, 0], // B
            [0, 0, 0, 1], // D
            [1, 0, 0, 0], // A
            [0, 0, 1, 0], // C
            [0, 0, 1, 0], // C
            [1, 0, 0, 0], // A
            [1, 0, 0, 0], // A
            [1, 0, 0, 0], // A
            [0, 1, 0, 0], // B
            [0, 1, 0, 0], // B
            [0, 1, 0, 0], // B
            [0, 0, 1, 0],  // C
            [0, 1, 0, 0], // B
            [0, 1, 0, 0], // B
            [0, 0, 1, 0]  // C
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
