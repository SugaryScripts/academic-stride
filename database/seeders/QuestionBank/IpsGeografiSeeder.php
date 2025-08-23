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

class IpsGeografiSeeder extends Seeder {
    public function run(): void {
        $SUBJ = "IPS-Geografi";

        $subject = RefSubject::where('code', SubjectConstant::GEOGRAPHY)->firstOrFail();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();

        $questions = [
            [
                "Konsep geografi yang berkaitan dengan letak suatu fenomena atau objek di permukaan bumi disebut...",
                "1"
            ],
            [
                "Penggunaan peta untuk menentukan rute tercepat menuju lokasi tertentu adalah penerapan dari konsep...",
                "1"
            ],
            [
                "Aktivitas masyarakat yang memilih tinggal di dataran tinggi karena udara yang sejuk merupakan contoh penerapan konsep...",
                "1"
            ],
            [
                "Peta adalah...",
                "2"
            ],
            [
                "Salah satu manfaat peta dalam kehidupan sehari-hari adalah...",
                "2"
            ],
            [
                "Peta topografi paling bermanfaat bagi...",
                "2"
            ],
            [
                "Fenomena geografi fisik yang dapat menyebabkan bencana alam seperti tanah longsor adalah...",
                "3"
            ],
            [
                "Gunung meletus termasuk fenomena geografi fisik yang berdampak pada...",
                "3"
            ],
            [
                "Perubahan iklim global dapat menyebabkan...",
                "3"
            ],
            [
                "Letak strategis Indonesia secara geografis berada di antara...",
                "4"
            ],
            [
                "Posisi strategis Indonesia menguntungkan dalam bidang ekonomi karena...",
                "4"
            ],
            [
                "Dampak budaya dari posisi strategis Indonesia adalah...",
                "4"
            ],
            [
                "Salah satu tujuan pelestarian keanekaragaman hayati adalah...",
                "5"
            ],
            [
                "Keanekaragaman hayati di dunia dipengaruhi oleh faktor berikut, kecuali...",
                "5"
            ],
            [
                "Keanekaragaman hayati tingkat gen ditunjukkan oleh perbedaan...",
                "5"
            ],
            [
                "Indonesia memiliki jumlah penduduk yang besar. Hal ini dapat menimbulkan dampak positif yaitu...",
                "6"
            ],
            [
                "Berikut ini yang termasuk faktor penyebab tingginya angka kelahiran di Indonesia adalah...",
                "6"
            ],
            [
                "Dampak negatif dari persebaran penduduk yang tidak merata adalah...",
                "6"
            ],
            [
                "Mitigasi bencana adalah...",
                "7"
            ],
            [
                "Contoh bentuk mitigasi bencana gempa bumi adalah...",
                "7"
            ],
            [
                "Tujuan utama dari mitigasi bencana adalah...",
                "7"
            ],
            [
                "Tujuan utama pelestarian lingkungan hidup adalah...",
                "8"
            ],
            [
                "Contoh tindakan manusia yang merusak lingkungan adalah...",
                "8"
            ],
            [
                "Prinsip 3R dalam pengelolaan sampah terdiri dari...",
                "8"
            ],
            [
                "Wilayah adalah...",
                "9"
            ],
            [
                "Pembangunan wilayah bertujuan untuk...",
                "9"
            ],
            [
                "Wilayah yang menjadi pusat pertumbuhan biasanya memiliki...",
                "9"
            ]
        ];

        $answers = [
            [
                "Lokasi",
                "Jarak",
                "Pola",
                "Morfologi"
            ],
            [
                "Interaksi",
                "Lokasi",
                "Aglomerasi",
                "Keterjangkauan"
            ],
            [
                "Jarak",
                "Keterjangkauan",
                "Diferensiasi area",
                "Lokasi"
            ],
            [
                "Gambar yang menunjukkan letak astronomis suatu negara",
                "Gambaran permukaan bumi yang bersifat umum maupun khusus pada bidang datar dengan skala tertentu",
                "Foto udara permukaan bumi dari satelit",
                "Sistem yang menampilkan kondisi cuaca suatu wilayah"
            ],
            [
                "Menentukan jenis tanaman di rumah",
                "Mengetahui suhu tubuh manusia",
                "Menunjukkan lokasi dan arah suatu tempat",
                "Mengatur jadwal kegiatan"
            ],
            [
                "Guru sejarah",
                "Petugas keamanan",
                "Pendaki gunung dan perencana pembangunan",
                "Tukang cukur"
            ],
            [
                "Perubahan sosial",
                "Perkembangan teknologi",
                "Erosi lereng curam",
                "Urbanisasi"
            ],
            [
                "Kenaikan angka kelahiran",
                "Kerusakan lahan pertanian dan pemukiman",
                "Penurunan konsumsi energi",
                "Pengurangan penduduk kota"
            ],
            [
                "Stabilitas suhu bumi",
                "Penurunan permukaan laut",
                "Curah hujan tidak menentu dan kekeringan",
                "Peningkatan pertumbuhan ekonomi"
            ],
            [
                "Samudra Arktik dan Samudra Pasifik",
                "Samudra Pasifik dan Samudra Hindia serta Benua Asia dan Australia",
                "Samudra Atlantik dan Samudra Hindia",
                "Benua Afrika dan Benua Amerika"
            ],
            [
                "Memiliki banyak tambang",
                "Menjadi jalur perdagangan internasional dan pelayaran dunia",
                "Penduduknya sedikit",
                "Jauh dari bencana alam"
            ],
            [
                "Isolasi budaya lokal",
                "Minimnya pengaruh asing",
                "Masuknya berbagai kebudayaan asing dan terjadi akulturasi",
                "Terbatasnya hubungan antarnegara"
            ],
            [
                "Menambah cadangan minyak bumi",
                "Meningkatkan kepadatan penduduk",
                "Menjaga keseimbangan ekosistem",
                "Menekan pertumbuhan ekonomi"
            ],
            [
                "Iklim",
                "Topografi",
                "Aktivitas vulkanik",
                "Budaya masyarakat"
            ],
            [
                "Jenis tumbuhan di suatu daerah",
                "Warna kulit antar manusia",
                "Spesies hewan yang berbeda",
                "Iklim di berbagai benua"
            ],
            [
                "Tingginya angka pengangguran",
                "Beban pembangunan meningkat",
                "Tersedianya tenaga kerja yang melimpah",
                "Terjadinya degradasi lingkungan"
            ],
            [
                "Urbanisasi tinggi",
                "Tingkat pendidikan rendah",
                "Program keluarga berencana berhasil",
                "Pendapatan masyarakat tinggi"
            ],
            [
                "Terbentuknya pusat pertumbuhan baru",
                "Ketersediaan lahan semakin banyak",
                "Ketimpangan pembangunan antarwilayah",
                "Peningkatan ekspor barang"
            ],
            [
                "Proses mempercepat penyebaran bencana",
                "Upaya memperparah dampak bencana",
                "Upaya mengurangi risiko dan dampak dari bencana",
                "Proses evakuasi setelah bencana"
            ],
            [
                "Menanam pohon di bantaran sungai",
                "Membangun rumah tahan gempa",
                "Menyediakan alat pemadam kebakaran",
                "Membuat sistem irigasi"
            ],
            [
                "Menambah jumlah pengungsi",
                "Memperluas dampak bencana",
                "Mengurangi risiko korban jiwa dan kerugian harta benda",
                "Menghentikan proses alam"
            ],
            [
                "Memperluas kawasan industri",
                "Meningkatkan eksploitasi sumber daya",
                "Menjaga keseimbangan ekosistem dan kelestarian alam",
                "Menurunkan harga tanah"
            ],
            [
                "Menanam pohon di lahan kritis",
                "Menggunakan energi terbarukan",
                "Membuang limbah pabrik ke sungai",
                "Membuat taman kota"
            ],
            [
                "Reduce, Reuse, Recycle",
                "Reuse, Recycle, Remove",
                "Reduce, Reuse, Relocate",
                "Record, Reduce, Reuse"
            ],
            [
                "Tempat berinteraksi antarnegara",
                "Bagian permukaan bumi yang memiliki karakteristik tertentu dan dibatasi secara administratif atau alami",
                "Daerah yang tidak memiliki penduduk",
                "Tempat yang hanya digunakan untuk kegiatan pertanian"
            ],
            [
                "Meningkatkan utang negara",
                "Menambah jumlah penduduk",
                "Meningkatkan kesejahteraan masyarakat dan pemerataan hasil pembangunan",
                "Menghapus wilayah pedesaan"
            ],
            [
                "Akses terbatas ke transportasi",
                "Tingkat pendidikan rendah",
                "Potensi ekonomi tinggi dan infrastruktur lengkap",
                "Kegiatan ekonomi yang tertutup"
            ]
        ];

        $answer_keys = [
            [
                1, 0, 0, 0 // A
            ],
            [
                0, 0, 0, 1 // D
            ],
            [
                0, 0, 1, 0 // C
            ],
            [
                0, 1, 0, 0 // B
            ],
            [
                0, 0, 1, 0 // C
            ],
            [
                0, 0, 1, 0 // C
            ],
            [
                0, 0, 1, 0 // C
            ],
            [
                0, 1, 0, 0 // B
            ],
            [
                0, 0, 1, 0 // C
            ],
            [
                0, 1, 0, 0 // B
            ],
            [
                0, 1, 0, 0 // B
            ],
            [
                0, 0, 1, 0 // C
            ],
            [
                0, 0, 1, 0 // C
            ],
            [
                0, 0, 0, 1 // D
            ],
            [
                0, 1, 0, 0 // B
            ],
            [0,0,1,0], // C
            [0,1,0,0], // B
            [0,0,1,0], // C
            [0,0,1,0], // C
            [0,1,0,0], // B
            [0,0,1,0], // C
            [0,0,1,0], // C
            [0,0,1,0], // C
            [1,0,0,0], // A
            [0,1,0,0], // B
            [0,0,1,0], // C
            [0,0,1,0]  // C
        ];

        $proficiencies = [
            [
                "1", "konsep dasar ilmu geografi dan penerapannya dalam kehidupan sehari-hari"
            ],
            [
                "2", "peta dan kegunaannya dalam kehidupan sehari-hari"
            ],
            [
                "3", "fenomena geografi fisik dan dampaknya terhadap kehidupan manusia"
            ],
            [
                "4", "posisi strategis Indonesia serta pengaruhnya terhadap kehidupan sosial, ekonomi, dan budaya"
            ],
            [
                "5", "pola keanekaragaman hayati Indonesia dan dunia serta pelestariannya"
            ],
            [
                "6", "kependudukan di Indonesia"
            ],
            [
                "7", "mitigasi bencana"
            ],
            [
                "8", "pelestarian lingkungan hidup"
            ],
            [
                "9", "kewilayahan dan pembangunan dalam kehidupan"
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
