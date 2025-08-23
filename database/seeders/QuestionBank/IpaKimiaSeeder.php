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

class IpaKimiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SUBJ = "IPA-Kimia";

        $subject = RefSubject::where('code', SubjectConstant::CHEMISTRY)->firstOrFail();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();

        $questions = [
            [
                [
                    "Unsur dengan nomor atom 17 terletak pada…",
                    "1"
                ],
                [
                    "Sifat berikut yang tidak termasuk sifat keperiodikan unsur adalah…",
                    "1"
                ],
                [
                    "Unsur dengan konfigurasi elektron 1s² 2s² 2p⁶ 3s² 3p³ terletak pada…",
                    "1"
                ],
                [
                    "Berikut ini yang merupakan contoh senyawa ionik adalah...",
                    "2"
                ],
                [
                    "Senyawa berikut yang memiliki ikatan hidrogen adalah...",
                    "2"
                ],
                [
                    "Dalam reaksi 2H2(g) + O2(g) → 2H2O(g), jika 4 mol gas hidrogen bereaksi, maka volume gas oksigen yang dibutuhkan pada keadaan standar (STP) adalah... (1 mol gas pada STP = 22,4 liter)",
                    "2"
                ],
                [
                    "Reaksi antara gas hidrogen (H₂) dan gas iodin (I₂) membentuk gas hidrogen iodida (HI) adalah sebagai berikut: H₂(g) + I₂(g) ⇌ 2HI(g) Jika pada suhu tetap, konsentrasi H₂ dan I₂ masing-masing dinaikkan dua kali lipat, maka laju reaksi akan menjadi:",
                    "3"
                ],
                [
                    "Faktor-faktor berikut ini yang mempengaruhi laju reaksi, kecuali:",
                    "3"
                ],
                [
                    "Kesetimbangan kimia adalah:",
                    "3"
                ],
                [
                    "Reaksi kesetimbangan berikut: 2SO₂(g) + O₂(g) ⇌ 2SO₃(g) Jika pada suhu tetap, ditambahkan gas SO₃ ke dalam sistem, maka kesetimbangan akan bergeser ke arah...",
                    "4"
                ],
                [
                    "Jika suatu reaksi kesetimbangan mengalami kenaikan suhu, maka kesetimbangan akan bergeser ke arah...",
                    "4"
                ],
                [
                    "Kesetimbangan kimia tercapai pada suatu reaksi ketika...",
                    "4"
                ],
                [
                    "Reaksi pembakaran gas metana (CH4) melepaskan energi sebesar 890 kJ/mol. Jika 3,2 gram gas metana dibakar, berapa perubahan entalpi (ΔH) reaksi tersebut? (Ar C=12, H=1)",
                    "5"
                ],
                [
                    "Sel Volta tersusun dari elektroda Zn dalam larutan ZnSO4 dan elektroda Cu dalam larutan CuSO4. Pernyataan yang benar tentang sel Volta tersebut adalah...",
                    "5"
                ],
                [
                    "Berikut ini adalah contoh aplikasi elektrokimia dalam kehidupan sehari-hari, kecuali...",
                    "5"
                ],
                [
                    "Senyawa karbon memiliki jumlah yang sangat banyak karena...",
                    "6"
                ],
                [
                    "Salah satu manfaat senyawa hidrokarbon dalam kehidupan sehari-hari adalah...",
                    "6"
                ],
                [
                    "Contoh senyawa hidrokarbon yang termasuk golongan alkana adalah...",
                    "6"
                ]
            ]

    ];

        $answers = [
            [
                "Periode 3, Golongan VIIA",
                "Periode 2, Golongan VIIA",
                "Periode 3, Golongan IIIA",
                "Periode 2, Golongan IIIA"
            ],
            [
                "Jari-jari atom",
                "Energi ionisasi",
                "Keelektronegatifan",
                "Titik didih"
            ],
            [
                "Periode 3, Golongan VA",
                "Periode 3, Golongan IIIA",
                "Periode 2, Golongan VA",
                "Periode 2, Golongan IIIA"
            ],
            [
                "CO2",
                "NaCl",
                "H2O",
                "CH4"
            ],
            [
                "CH4",
                "NaCl",
                "H2O",
                "CCl4"
            ],
            [
                "11,2 liter",
                "22,4 liter",
                "44,8 liter",
                "67,2 liter"
            ],
            [
                "2 kali lebih cepat",
                "4 kali lebih cepat",
                "8 kali lebih cepat",
                "Tetap"
            ],
            [
                "Suhu",
                "Konsentrasi",
                "Katalis",
                "Wujud zat"
            ],
            [
                "Suatu keadaan di mana reaksi berhenti total",
                "Suatu keadaan di mana reaksi berlangsung ke satu arah saja",
                "Suatu keadaan di mana reaksi berlangsung dua arah dengan laju reaksi yang sama",
                "Suatu keadaan di mana produk reaksi lebih banyak daripada reaktan"
            ],
            [
                "Kiri (reaktan)",
                "Kanan (produk)",
                "Bergeser ke arah yang memiliki jumlah mol gas lebih besar",
                "Bergeser ke arah yang memiliki jumlah mol gas lebih kecil"
            ],
            [
                "reaksi endoterm",
                "reaksi eksoterm",
                "reaksi yang menghasilkan gas",
                "reaksi yang menghasilkan padatan"
            ],
            [
                "reaksi berhenti berlangsung.",
                "laju reaksi maju sama dengan laju reaksi mundur.",
                "jumlah pereaksi sama dengan jumlah hasil reaksi.",
                "tidak ada lagi perubahan pada konsentrasi pereaksi."
            ],
            [
                "-178 kJ",
                "+178 kJ",
                "-89 kJ",
                "+89 kJ"
            ],
            [
                "Zn bertindak sebagai anoda dan mengalami reduksi.",
                "Cu bertindak sebagai katoda dan mengalami oksidasi.",
                "Elektron mengalir dari Zn ke Cu melalui jembatan garam.",
                "Zn mengalami oksidasi dan Cu mengalami reduksi."
            ],
            [
                "Baterai pada handphone.",
                "Aki pada kendaraan bermotor.",
                "Elektroplating",
                "Fotosintesis"
            ],
            [
                "Karbon melimpah di kulit bumi",
                "Karbon mempunyai 6 elektron valensi",
                "Dapat membentuk rantai atom karbon",
                "Titik didih karbon sangat tinggi"
            ],
            [
                "Bahan baku pembuatan plastik",
                "Bahan bakar kendaraan bermotor",
                "Bahan baku pembuatan pupuk",
                "Bahan baku pembuatan obat-obatan"
            ],
            [
                "Etana (C₂H₆)",
                "Etilen (C₂H₄)",
                "Asetilen (C₂H₂)",
                "Benzena (C₆H₆)"
            ]
        ];

        $answer_keys = [
            [1, 0, 0, 0], // A
            [0, 0, 0, 1], // D
            [1, 0, 0, 0], // A
            [0, 1, 0, 0], // B
            [0, 0, 1, 0], // C
            [0, 0, 1, 0], // C
            [0, 1, 0, 0], // B
            [0, 0, 0, 1], // D
            [0, 0, 1, 0], // C
            [1, 0, 0, 0], // A
            [0, 0, 0, 1], // D
            [0, 0, 0, 1], // D
            [0, 0, 1, 0], // C
            [0, 1, 0, 0], // B
            [1, 0, 0, 0], // A
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
            /*[
                "6", "pemodelan situasi dalam bentuk matematis dengan menggunakan fungsi dan sifat-sifatnya"
            ],*/
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
