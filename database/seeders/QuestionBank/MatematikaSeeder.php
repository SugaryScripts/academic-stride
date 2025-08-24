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

class MatematikaSeeder extends Seeder
{
    public function run(): void
    {
        $SUBJ = "Matematika";

        $subject = RefSubject::where('code', SubjectConstant::MATHEMATICS)->firstOrFail();
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
                'Parabola y=x²-3x+6 digeser ke kanan sejauh 3 satuan searah dengan sumbu -x dan digeser ke bawah sejauh 4 satuan. Jika parabol hasil pergeseran ini memotong sumbu -x di x₁ dan x₂ maka x₁ + x₂ = ...',
                "2"
            ],
            [
                'Diketahui suatu deret aritmetika dengan rumus jumlah n suku pertama Sn = n²+4n. Persamaan kuadrat yang dibentuk dari suku ke-7 dan beda deretnya sebagai akar-akar adalah ...',
                "2"
            ],
            [
                'Dalam daerah yang dibatasi oleh sistem pertidaksamaan $x+y \leq 30$, $3y \leq x+30$, $x \geq 0$ dan $y \geq 0$, maka nilai maksimun dari $2x+3y$ adalah ...',
                "3"
            ],
            [
                'Sebuah pabrik memproduksi dua jenis barang, yaitu barang A dan barang B. Untuk membuat 1 unit barang A, diperlukan waktu 4 jam pada mesin I dan 2 jam pada mesin II. Untuk membuat 1 unit barang B, diperlukan waktu 3 jam pada mesin I dan 5 jam pada mesin II. Kedua mesin memiliki batasan waktu kerja harian yaitu tidak beroperasi lebih dari 20 jam per hari. Jika pabrik menghasilkan x unit barang A dan y unit barang B setiap hari, maka model matematika yang merepresentasikan batasan-batasan ini adalah ...',
                "3"
            ],
            [
                'Seorang ibu membuat kue jenis I dan jenis II. Kue jenis I memerlukan modal Rp. 350,00 dengan keuntungan 25%, sementara kue jenis II bermodal Rp. 500,00 dengan keuntungan 35%. Jika ibu tersebut memiliki modal harian Rp.125.000,00 dan hanya bisa membuat paling banyak 200 kue, maka keuntungan maksimum dalam persen yang bisa didapat adalah ...',
                "3"
            ],
            [
                'Dalam sebuah segitiga ABC, panjang sisi BC adalah 125 cm. Diketahui besar sudut ABC adalah 45° dan sudut BCA adalah 60°. Panjang sisi AC = ...',
                "4"
            ],
            [
                'Sebuah kapal berlayar dari titik awal ke arah timur sejauh 20 mil. Perjalanan kedua dilanjutkan dengan arah 30° sejauh 50 mil. Berapakah jarak garis lurus dari posisi akhir kapal ke titik keberangkatan?',
                "4"
            ],
            [
                'Diketahui $\sin\alpha=\frac{1}{3} \cdot \frac{1}{2}$, $\alpha$ adalah sudut lancip, maka nilai $\cos 2\alpha$ adalah ...',
                "4"
            ],
            [
                'Jika matriks $M = \begin{pmatrix} 2 & 1 \\\\ -1 & 2 \end{pmatrix}$ dan $N = \begin{pmatrix} -1 & 0 \\\\ 0 & 1 \end{pmatrix}$ maka matriks 2NM - MN =',
                "5"
            ],
            [
                'Diketahui matriks $A=\begin{pmatrix} 1 & 2 \\\\ 3 & 4 \end{pmatrix}$ dan $B=\begin{pmatrix} 1 & 2 \\\\ 2 & 1 \end{pmatrix}$. Matriks $A-kB$ adalah matriks tunggal, maka untuk nilai k =',
                "5"
            ],
            [
                'Jika matriks $A$ memenuhi $A\begin{pmatrix} 3 & 2 \\\\ 5 & 4 \end{pmatrix} = \begin{pmatrix} 7 & 6 \\\\ 9 & 8 \end{pmatrix}$, maka det A =',
                 "5"
            ],
            [
                'Turunan pertama dari fungsi $f(x)=5x^3-1$ adalah $f\'(x)=$',
                "6"
            ],
            [
                'Dua bilangan bulat m dan n memenuhi hubungan 4m + 2n = 40. Nilai minimun dari p=m²+n² adalah ...',
                "6"
            ],
            [
                'Suatu proyek dikerjakan selama $x$ hari dengan biaya setiap harinya $\left(2x+\frac{1000}{x}-24\right)$ juta rupiah. Jika biaya minimun proyek adalah Y juta rupiah, maka Y = ...',
                "6"
            ],
            [
                'Nilai tes matematika 25 orang siswa memiliki ciri-ciri sebagai berikut: selisih nilai terbesar dan terkecil adalah 4,5 dan rata-rata nilai 23 siswa lainnya adalah 7,4. Jika rata-rata nilai seluruh siswa adalah 7,6, maka nilai terkecilnya adalah...',
                "7"
            ],
            [
                'Data berikut adalah tinggi badan sekelompok siswa. Median data di atas adalah TABLE',
                "7"
            ],
            [
                'Suatu data mempunyai rata-rata 25 dan jangkauan 5. Jika setiap nilai dalam data dikalikan x kemudian dikurangi y, didapat data baru dengan rata-rata 35 dan jangkauan 7. Nilai 5x-y adalah...',
                "7"
            ],
            [
                'Seseorang melakukan perjalanan pulang-pergi dari kota A ke kota C, dengan transit di kota B. Terdapat 5 bus yang melayani rute dari kota A ke B, dan 4 bus untuk rute dari B ke C. Pada perjalanan pulang dari C ke A, orang tersebut tidak ingin menggunakan bus yang sama seperti saat berangkat, maka banyak cara yang berbeda untuk melakukan perjalanan ini adalah...',
                "8"
            ],
            [
                'Sebanyak 6 orang peserta akan duduk mengelilingi sebuah meja bundar untuk rapat. Berapa banyak cara berbeda untuk mengatur posisi duduk mereka?',
                "8"
            ],
            [
                'Ada empat anak laki-laki dan tiga anak perempuan yang akan duduk berjejer. Berapa peluang jika ketiga anak perempuan tersebut duduk berdampingan?',
                "8"
            ],
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
                '12',
                '9',
                '10',
                '8',
            ],
            [
                "x² - 17x + 22 = 0",
                "x² - 19x + 34 = 0",
                "x² - 33x + 69 = 0",
                "x² - 9x + 18 = 0"
            ],
            [
                '75',
                '100',
                '125',
                '150',
            ],
            [
                '$2x+4y \leq 10$, $x+2y \leq 10$, $x \geq 0$, dan $y \geq 0$',
                '$4x+y \leq 20$, $2x+2y \leq 20$, $x \geq 0$, dan $y \geq 0$',
                '$4x+3y \leq 20$, $2x+5y \leq 20$, $x \geq 0$, dan $y \geq 0$',
                '$x+3y \leq 20$, $x+5y \leq 20$, $x \geq 0$, dan $y \geq 0$',
            ],
            [
                '25%',
                '28%',
                '31%',
                '37%',
            ],
            [
                '$\frac{125}{\sqrt{3}+1}$',
                '$\frac{125}{\sqrt{3}-6}$',
                '$\frac{125}{\sqrt{2}+6}$',
                '$\frac{125}{\sqrt{3}-1}$',
            ],
            [
                '$\sqrt{10(\sqrt{17}+3)}$ mil',
                '$\sqrt{10(\sqrt{15}-3)}$ mil',
                '$\sqrt{10(\sqrt{16}+2)}$ mil',
                '$\sqrt{1900}$ mil',
            ],
            [
                '$-\frac{1}{5}$',
                '$\frac{4}{5}$',
                '$-\frac{5}{3}$',
                '-1',
            ],
            [
                '$\begin{pmatrix} -2 & -3 \\ -3 & 2 \end{pmatrix}$',
                '$\begin{pmatrix} -2 & 3 \\ 3 & -2 \end{pmatrix}$',
                '$\begin{pmatrix} -4 & -3 \\ -3 & 4 \end{pmatrix}$',
                '$\begin{pmatrix} 2 & -3 \\ 3 & -2 \end{pmatrix}$',
            ],
            [
                '$\frac{2}{5}$ atau $3$',
                '$1$ atau $\frac{1}{2}$',
                '$2$ atau $\frac{4}{5}$',
                '$1$ atau $-\frac{2}{3}$',
            ],
            [
                '-1',
                '1',
                '2',
                '-3',
            ],
            [
                '$\frac{5x^2}{2\sqrt[3]{(x^3-1)^2}}$',
                '$\frac{10x^2}{\sqrt[3]{(x^3-1)^2}}$',
                '$\frac{5x^2}{\sqrt[3]{(x^3-1)^2}}$',
                '$\frac{25x^2}{2\sqrt[3]{(x^3-1)^2}}$',
            ],
            [
                '64',
                '30',
                '56',
                '80',
            ],
            [
                '928',
                '824',
                '1124',
                '728',
            ],
            [
                '6,4',
                '6,5',
                '6,7',
                '6,8',
            ],
            [
                '23',
                '24',
                '25',
                '27',
            ],
            [
                '8',
                '7',
                '6',
                '4',
            ],
            [
                '120',
                '140',
                '180',
                '240',
            ],
            [
                '60',
                '100',
                '80',
                '120',
            ],
            [
                '$\frac{1}{7}$',
                '$\frac{1}{5}$',
                '$\frac{1}{6}$',
                '$\frac{1}{8}$',
            ],
        ];


       $answer_keys = [
        [0,0,1,0], // C
        [1,0,0,0], // A
        [0,0,0,1], // D
        [0,0,0,1], // D
        [0,1,0,0], // B
        [0,1,0,0], // B
        [1,0,0,0], // A
        [0,0,1,0], // C
        [0,1,0,0], // B
        [0,0,0,1], // D
        [0,0,0,1], // D
        [0,0,1,0], // C
        [1,0,0,0], // A
        [0,0,0,1], // D
        [0,1,0,0], // B
        [0,0,1,0], // C
        [0,0,0,1], // D
        [1,0,0,0], // A
        [0,1,0,0], // B
        [0,0,1,0], // C
        [0,1,0,0], // B
        [0,0,0,1], // D
        [0,0,0,1], // D
        [1,0,0,0], // A
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
