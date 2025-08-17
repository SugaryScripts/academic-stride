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

class BiSeeder extends Seeder {
    public function run(): void {
        $SUBJ = "BI";

        $subject_indo = RefSubject::where('code', SubjectConstant::INDONESIAN)->firstOrFail();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();


        $bi_questions = [
            [
                "Saat debat kelas, Rani berkata, “Pendapat kamu salah total. Kamu tidak paham materi, jadi jangan banyak bicara.”
        tersebut menunjukkan penggunaan bahasa yang tidak santun. Kalimat tersebut akan lebih sesuai dengan prinsip komunikasi santun jika diubah menjadi ...",
                "1"
            ],
            [
                "Diskusi kelompok, Andi berkata, “Ide kamu itu kurang masuk akal, seharusnya kamu pikir dulu sebelum bicara.”
        Pernyataan Andi tersebut **tidak mencerminkan strategi berbahasa yang santun**. Perbaikan kalimat agar sesuai dengan prinsip menghormati pendapat orang lain adalah ...",
                "1"
            ],
            [
                "Dalam surat resmi kepada kepala sekolah, seorang siswa menulis:
“Saya minta Bapak segera membenahi fasilitas sekolah karena sudah tidak nyaman dipakai.”
Kalimat tersebut perlu diperbaiki agar lebih santun menjadi:",
                "1"
            ],
            [
                "Bacalah pernyataan berikut:
“Perempuan tidak cocok menjadi pemimpin karena terlalu emosional dan kurang tegas.”
Pernyataan di atas mengandung bias informasi karena …",
                "2"
            ],
            [
                "Manakah pernyataan berikut yang menunjukkan informasi akurat dalam teks nonfiksi kompleks?",
                "2"
            ],
            [
                "Pilihlah kalimat yang mencerminkan sikap ramah keberagaman dalam teks nonfiksi!",
                "2"
            ],
            [
                "Manakah yang merupakan bentuk teks fiksi kompleks?",
                "3"
            ],
            [
                "Manakah kutipan yang mencerminkan keberagaman dalam teks fiksi?",
                "3"
            ],
            [
                "Salah satu elemen estetika dalam teks fiksi yang memperkuat keindahan dan daya pikat cerita adalah …",
                "3"
            ],
            [
                "Manakah kaidah kebahasaan yang umum digunakan dalam teks kompleks?",
                "4"
            ],
            [
                "'Pendidikan harus merata agar seluruh masyarakat dapat memperoleh kesempatan yang sama.'Kata \"agar\" dalam kalimat tersebut termasuk jenis konjungsi ...",
                "4"
            ],
            [
                "Kalimat berikut menggunakan kata rujukan yang tepat, kecuali ...",
                "4"
            ],
            [
                "Manakah kalimat pasif yang sesuai dengan kaidah bahasa dalam teks kompleks?",
                "5"
            ],
            [
                "Penggunaan istilah baku di bawah ini yang sesuai kaidah bahasa Indonesia adalah …",
                "5"
            ],
            [
                "Penggunaan istilah baku di bawah ini yang sesuai kaidah bahasa Indonesia adalah …",
                "5"
            ],
            [
                "Manakah kata berikut yang paling tepat digunakan dalam konteks pendidikan?",
                "6"
            ],
            [
                "Kosakata yang tepat digunakan dalam konteks kehidupan masyarakat adalah …",
                "6"
            ],
            [
                "Sinonim yang tepat untuk kata “kemerdekaan” dalam konteks kebangsaan adalah …",
                "6"
            ],
            [
                "Struktur umum dari teks sastra kompleks seperti cerpen dan novel meliputi …",
                "7"
            ],
            [
                "Bagian dari teks sastra yang menunjukkan puncak masalah atau konflik disebut …",
                "7"
            ]
        ];

        $bi_answers = [
            [
                "“Kamu salah, tidak usah ikut diskusi kalau tidak paham.”",
                "“Saya rasa pendapatmu tidak tepat, mari kita kaji kembali bersama.”",
                "“Pendapatmu tidak bisa diterima, diam saja dulu.”",
                "“Kamu tidak tahu apa-apa, sebaiknya diam.”",
                "“Sudah jelas salah, tidak perlu dijelaskan lagi.”"
            ],
            [
                "“Kamu seharusnya tidak berbicara sembarangan, pikir dulu!”",
                "“Maaf, menurut saya, ide tersebut kurang tepat. Mungkin bisa dipertimbangkan kembali.”",
                "“Ide kamu salah. Jangan asal bicara kalau tidak tahu!”",
                "“Sudah jelas salah, buat apa didiskusikan?”",
                "“Saya tidak setuju karena itu ide yang buruk.”"
            ],
            [
                "“Saya minta Bapak cepat membenahi fasilitas yang rusak.”",
                "“Bapak harus bertanggung jawab terhadap kenyamanan siswa.”",
                "“Dengan hormat, kami mengusulkan agar fasilitas sekolah dapat diperbaiki demi kenyamanan bersama.”",
                "“Fasilitas rusak harus segera dibenahi karena merugikan kami.”",
                "“Fasilitas sekolah tidak nyaman, mohon diganti total.”"
            ],
            [
                "Menyampaikan fakta yang berdasarkan pengalaman",
                "Mengandung opini pribadi yang dapat diterima semua pihak",
                "Menyamaratakan sifat seseorang berdasarkan gender",
                "Mengandung data statistik yang valid",
                "Merupakan pendapat ahli yang netral"
            ],
            [
                "“Menurut kebanyakan orang, siswa pintar selalu berasal dari kota.”",
                "“Semua guru tua tidak bisa mengoperasikan komputer.”",
                "“Berdasarkan data BPS tahun 2023, jumlah pengangguran di Indonesia menurun sebesar 1,2%.”",
                "“Banyak masyarakat desa masih percaya pada hal mistis.”",
                "“Anak muda saat ini lebih manja dibanding generasi sebelumnya.”"
            ],
            [
                "“Penduduk asli lebih pintar daripada pendatang.”",
                "“Suku X paling beradab dibandingkan yang lain.”",
                "“Semua siswa, tanpa memandang latar belakang budaya, berhak mendapat pendidikan yang sama.”",
                "“Orang kota lebih mudah menerima perubahan daripada orang desa.”",
                "“Kaum minoritas sulit berkembang karena kurang mampu.”"
            ],
            [
                "Laporan hasil penelitian ilmiah",
                "Artikel opini dari media massa",
                "Cerpen, novel, dan drama dengan alur kompleks dan tema mendalam",
                "Iklan layanan masyarakat",
                "Wawancara tokoh masyarakat"
            ],
            [
                "“Dia merasa bangga menjadi bagian dari suku terbaik di negeri ini.”",
                "“Semua orang dari luar kota biasanya lambat memahami situasi.”",
                "“Mereka berasal dari latar budaya berbeda, namun saling menghormati dan bekerja sama.”",
                "“Warga asing tidak paham adat, jadi sebaiknya jangan ikut campur.”",
                "“Keluarganya aneh karena tidak menjalankan tradisi yang umum.”"
            ],
            [
                "Struktur kalimat baku dan formal",
                "Penggunaan data dan fakta yang objektif",
                "Gaya bahasa (majas), diksi, dan simbolisme",
                "Tabel, grafik, dan diagram pendukung",
                "Penjelasan ilmiah secara mendalam"
            ],
            [
                "Kalimat tanya dan seruan",
                "Penggunaan kalimat perintah langsung",
                "Penggunaan konjungsi kausal, temporal, dan argumentatif",
                "Bahasa kiasan dan diksi puitis",
                "Dialog antar tokoh dengan gaya santai"
            ],
            [
                "Temporal",
                "Tujuan",
                "Perbandingan",
                "Sebab-akibat",
                "Pertentangan"
            ],
            [
                "\"Masalah itu telah disampaikan. Hal tersebut perlu ditindaklanjuti.\"",
                "\"Siti tidak hadir hari ini karena dia sedang sakit.\"",
                "\"Mereka berhasil menyelesaikan proyek itu meskipun banyak tantangan.\"",
                "\"Kegiatan itu cukup positif. Ia harus diteruskan oleh generasi berikutnya.\"",
                "\"Guru memberi tugas, dan para siswa langsung mengerjakannya.\""
            ],
            [
                "“Siswa itu membersihkan kelas setiap hari.”",
                "“Kita harus menjaga kebersihan lingkungan sekolah.”",
                "“Kelas telah dibersihkan oleh para siswa sebelum guru datang.”",
                "“Tolong bersihkan kelas sebelum istirahat!”",
                "“Anak-anak bermain di lapangan dengan riang.”"
            ],
            [
                "“Dia memiliki tanggung jawab yang besar terhadap masyarakatnya.”",
                "“Masalah ini akan didiskusikan di forum yang resmi.”",
                "“Penyuluhan itu sangat efektif karena melibatkan para narasumber.”",
                "“Kita harus mentargetkan hasil yang maksimal.”",
                "“Dia sangat eksis di dunia maya.”"
            ],
            [
                "“Dia memiliki tanggung jawab yang besar terhadap masyarakatnya.”",
                "“Masalah ini akan didiskusikan di forum yang resmi.”",
                "“Penyuluhan itu sangat efektif karena melibatkan para narasumber.”",
                "“Kita harus mentargetkan hasil yang maksimal.”",
                "“Dia sangat eksis di dunia maya.”"
            ],
            [
                "Musyawarah",
                "Kurikulum",
                "Rempah-rempah",
                "Ekspor",
                "Perdagangan"
            ],
            [
                "Rapat koordinasi mata pelajaran",
                "Keadilan sosial",
                "Evaluasi pembelajaran",
                "Ujian kompetensi",
                "Perencanaan kelas"
            ],
            [
                "Kesenangan",
                "Kebebasan",
                "Keleluasaan",
                "Kelonggaran",
                "Keuntungan"
            ],
            [
                "Pendahuluan, isi, dan penutup",
                "Orientasi, komplikasi, dan resolusi",
                "Latar, tokoh, dan amanat",
                "Prolog, dialog, dan epilog",
                "Masalah, solusi, dan kesimpulan"
            ],
            [
                "Abstraksi",
                "Resolusi",
                "Orientasi",
                "Komplikasi",
                "Evaluasi"
            ]
        ];

        $bi_answer_keys = [
            [
                0, 1, 0, 0, 0
            ],
            [
                0, 1, 0, 0, 0 // B
            ],
            [
                0, 0, 1, 0, 0
            ],
            [
                0, 0, 1, 0, 0
            ],
            [
                0, 0, 1, 0, 0 // C
            ],
            [
                0, 0, 1, 0, 0 // C
            ],
            [
                0, 0, 1, 0, 0 // C
            ],
            [
                0, 0, 1, 0, 0 // C
            ],
            [
                0, 0, 1, 0, 0 // C
            ],
            [
                0, 0, 1, 0, 0 // C
            ],
            [
                0, 0, 1, 0, 0 // C
            ],
            [
                0, 1, 0, 0, 0 // B
            ],
            [
                0, 0, 0, 1, 0 // D
            ],
            [
                0, 0, 1, 0, 0 // C
            ],
            [
                0, 0, 1, 0, 0 // C
            ],
            [
                0, 0, 1, 0, 0 // C
            ],
            [
                0, 1, 0, 0, 0 // B
            ],
            [
                0, 1, 0, 0, 0 // B
            ],
            [
                0, 1, 0, 0, 0 // B
            ],
            [
                0, 1, 0, 0, 0 // B
            ],
            [
                0, 0, 0, 1, 0 // D
            ],
        ];

        $bi_proficiencies = [
            [
                '1', 'strategi berbahasa (menyimak, membaca dan memirsa, berbicara, menulis, dan mempresentasikan)secara santun untuk menghormati orang lain dan/atau menghindari konflik dalam teks kompleks sesuai dengan konteks sosial budaya masyarakat pada peringkat madya',
            ],
            [
                '2', 'bentuk, ciri, akurasi informasi, dan bias informasi dalam teks nonfiksi kompleks yang netral, ramah gender, dan/atau ramah keberagaman',
            ],
            [
                '3', 'bentuk, ciri, dan elemen estetika dalam teks fiksi kompleks yang netral, ramah gender, dan/atau ramah keberagaman',
            ],
            [
                '4', 'kaidah bahasa Indonesia yang membentuk teks kompleks',
            ],
            [
                '5', 'kosakata bahasa Indonesia yang erat kaitannya dengan konteks satuan pendidikan, masyarakat, dan/atau bangsa',
            ],
            [
                '6', 'struktur sastra dalam teks sastra kompleks',
            ],
            [
                '7', 'penanda kebahasaan dalam berbagai jenis teks kompleks',
            ],
            [
                '8', 'aspek nonverbal dalam teks kompleks',
            ],
            [
                '9', 'struktur dan kohesi teks kompleks dalam wujud lisan, tulis, visual, dan multimodal yang disajikan melalui media cetak, elektronik, dan/atau digital'
            ]
        ];

        // proficiencies
        $this->command->info("Creating $SUBJ proficiencies...");
        foreach ($bi_proficiencies as $proficiency) {
            SubjectProficiencyH::factory()->create([
                'no' => $proficiency[0],
                'parameter' => $proficiency[1],
                'ref_subject_id' => $subject_indo->id,
            ]);
        }

        foreach ($bi_questions as $question_index => $question){
            $this->command->info("Creating $SUBJ questions $subject_indo->id, it's proficiency $question[1], and answers with keys...");
            $created_question = Question::create([
                'question_text' => $question[0],
                'ref_subject_id' => $subject_indo->id,
                'ref_subject_code' => $subject_indo->code,
                'ref_question_type_code' => $multipleChoiceType->code,
                'ref_question_type_id' => $multipleChoiceType->id,
                'is_active' => true,
                'created_by' => $educators->random()->id,
            ]);

            $h_id = SubjectProficiencyH::where('ref_subject_id', $subject_indo->id)
                ->where('no', $question[1])->firstOrFail()->id;
            SubjectProficiencyD::factory()->create([
                'question_id' => $created_question->id,
                'subject_proficiency_h_id' => $h_id
            ]);


            foreach ($bi_answers[$question_index] as $answer_index => $answer){
                AnswerTextOption::factory()->create([
                    'question_id' => $created_question->id,
                    'answer' => $answer,
                    'is_correct' => $bi_answer_keys[$question_index][$answer_index],
                ]);
            }
        }



    }

}
