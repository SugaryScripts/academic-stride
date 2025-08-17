<?php

namespace Database\Seeders;

use App\Constants\QuestionTypeConstant;
use App\Constants\UserTypeConstant;
use App\Models\Account\User;
use App\Models\Assessment\AnswerTextOption;
use App\Models\Assessment\Question;
use App\Models\MasterType\RefMasterType;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Seeder;

class NotRealQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();
        $essayType = RefMasterType::where('code', QuestionTypeConstant::ESSAY)->first();

        $realQuestions = [
            // SD - Matematika
            [
                'subject_code' => 'MATH',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Berapakah hasil dari 5 + 3?',
                'options' => [
                    ['text' => '7', 'is_correct' => false],
                    ['text' => '8', 'is_correct' => true],
                    ['text' => '9', 'is_correct' => false],
                    ['text' => '10', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Jika Anda memiliki 10 apel dan makan 4, berapa sisa apel Anda?',
                'options' => [
                    ['text' => '5', 'is_correct' => false],
                    ['text' => '6', 'is_correct' => true],
                    ['text' => '7', 'is_correct' => false],
                    ['text' => '8', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Bentuk bangun datar yang memiliki empat sisi sama panjang adalah...',
                'options' => [
                    ['text' => 'Segitiga', 'is_correct' => false],
                    ['text' => 'Lingkaran', 'is_correct' => false],
                    ['text' => 'Persegi', 'is_correct' => true],
                    ['text' => 'Persegi Panjang', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Angka berapa yang datang setelah 12?',
                'options' => [
                    ['text' => '11', 'is_correct' => false],
                    ['text' => '13', 'is_correct' => true],
                    ['text' => '14', 'is_correct' => false],
                    ['text' => '15', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Berapa jumlah jari di satu tangan?',
                'options' => [
                    ['text' => '4', 'is_correct' => false],
                    ['text' => '5', 'is_correct' => true],
                    ['text' => '6', 'is_correct' => false],
                    ['text' => '10', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Jika Anda memiliki 3 pensil dan teman Anda memberi Anda 2 lagi, berapa total pensil Anda?',
                'options' => [
                    ['text' => '4', 'is_correct' => false],
                    ['text' => '5', 'is_correct' => true],
                    ['text' => '6', 'is_correct' => false],
                    ['text' => '7', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Berapa hasil dari 10 - 7?',
                'options' => [
                    ['text' => '2', 'is_correct' => false],
                    ['text' => '3', 'is_correct' => true],
                    ['text' => '4', 'is_correct' => false],
                    ['text' => '5', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Sebuah lingkaran memiliki berapa sisi?',
                'options' => [
                    ['text' => '1', 'is_correct' => false],
                    ['text' => '2', 'is_correct' => false],
                    ['text' => 'Tidak ada', 'is_correct' => true],
                    ['text' => 'Banyak', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Jika hari ini Senin, besok adalah hari...',
                'options' => [
                    ['text' => 'Minggu', 'is_correct' => false],
                    ['text' => 'Selasa', 'is_correct' => true],
                    ['text' => 'Rabu', 'is_correct' => false],
                    ['text' => 'Kamis', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Jelaskan cara menghitung keliling persegi panjang.',
            ],

            // SD - Bahasa Inggris
            [
                'subject_code' => 'ENG',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa arti kata "cat" dalam Bahasa Indonesia?',
                'options' => [
                    ['text' => 'Anjing', 'is_correct' => false],
                    ['text' => 'Kucing', 'is_correct' => true],
                    ['text' => 'Burung', 'is_correct' => false],
                    ['text' => 'Ikan', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Lengkapi kalimat: "I like to eat ___." (Saya suka makan ___.)',
                'options' => [
                    ['text' => 'Run', 'is_correct' => false],
                    ['text' => 'Apple', 'is_correct' => true],
                    ['text' => 'Sleep', 'is_correct' => false],
                    ['text' => 'Jump', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa warna langit?',
                'options' => [
                    ['text' => 'Merah', 'is_correct' => false],
                    ['text' => 'Hijau', 'is_correct' => false],
                    ['text' => 'Biru', 'is_correct' => true],
                    ['text' => 'Kuning', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Kata "hello" digunakan untuk...',
                'options' => [
                    ['text' => 'Mengucapkan selamat tinggal', 'is_correct' => false],
                    ['text' => 'Menyapa', 'is_correct' => true],
                    ['text' => 'Meminta maaf', 'is_correct' => false],
                    ['text' => 'Berterima kasih', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang Anda katakan saat Anda ingin tidur?',
                'options' => [
                    ['text' => 'Good morning', 'is_correct' => false],
                    ['text' => 'Good afternoon', 'is_correct' => false],
                    ['text' => 'Good night', 'is_correct' => true],
                    ['text' => 'Good evening', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Pilih kata yang benar untuk mengisi titik-titik: "This is ___ book."',
                'options' => [
                    ['text' => 'an', 'is_correct' => false],
                    ['text' => 'a', 'is_correct' => true],
                    ['text' => 'the', 'is_correct' => false],
                    ['text' => 'is', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa arti "happy" dalam Bahasa Indonesia?',
                'options' => [
                    ['text' => 'Sedih', 'is_correct' => false],
                    ['text' => 'Marah', 'is_correct' => false],
                    ['text' => 'Senang', 'is_correct' => true],
                    ['text' => 'Takut', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Lengkapi kalimat: "The sun ___ in the east." (Matahari ___ di timur.)',
                'options' => [
                    ['text' => 'sets', 'is_correct' => false],
                    ['text' => 'rises', 'is_correct' => true],
                    ['text' => 'sleeps', 'is_correct' => false],
                    ['text' => 'falls', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang Anda minum saat haus?',
                'options' => [
                    ['text' => 'Food', 'is_correct' => false],
                    ['text' => 'Water', 'is_correct' => true],
                    ['text' => 'Book', 'is_correct' => false],
                    ['text' => 'Toy', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Ceritakan tentang keluarga Anda dalam Bahasa Inggris.',
            ],

            // SD - Bahasa Indonesia
            [
                'subject_code' => 'IND',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Kata yang tepat untuk melengkapi kalimat "Saya suka makan ___" adalah...',
                'options' => [
                    ['text' => 'Lari', 'is_correct' => false],
                    ['text' => 'Nasi', 'is_correct' => true],
                    ['text' => 'Tidur', 'is_correct' => false],
                    ['text' => 'Lompat', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Ibu kota negara Indonesia adalah...',
                'options' => [
                    ['text' => 'Bandung', 'is_correct' => false],
                    ['text' => 'Surabaya', 'is_correct' => false],
                    ['text' => 'Jakarta', 'is_correct' => true],
                    ['text' => 'Medan', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Pahlawan nasional yang memproklamasikan kemerdekaan Indonesia adalah...',
                'options' => [
                    ['text' => 'Pangeran Diponegoro', 'is_correct' => false],
                    ['text' => 'Ir. Soekarno', 'is_correct' => true],
                    ['text' => 'Cut Nyak Dien', 'is_correct' => false],
                    ['text' => 'Raden Ajeng Kartini', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Alat musik tradisional angklung berasal dari daerah...',
                'options' => [
                    ['text' => 'Jawa Tengah', 'is_correct' => false],
                    ['text' => 'Jawa Barat', 'is_correct' => true],
                    ['text' => 'Bali', 'is_correct' => false],
                    ['text' => 'Sumatera Utara', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Hewan yang bisa terbang adalah...',
                'options' => [
                    ['text' => 'Kucing', 'is_correct' => false],
                    ['text' => 'Burung', 'is_correct' => true],
                    ['text' => 'Sapi', 'is_correct' => false],
                    ['text' => 'Ikan', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Bagian tumbuhan yang berfungsi menyerap air dan nutrisi dari tanah adalah...',
                'options' => [
                    ['text' => 'Daun', 'is_correct' => false],
                    ['text' => 'Batang', 'is_correct' => false],
                    ['text' => 'Akar', 'is_correct' => true],
                    ['text' => 'Bunga', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa nama hari setelah hari Minggu?',
                'options' => [
                    ['text' => 'Sabtu', 'is_correct' => false],
                    ['text' => 'Senin', 'is_correct' => true],
                    ['text' => 'Selasa', 'is_correct' => false],
                    ['text' => 'Jumat', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Bendera negara Indonesia berwarna...',
                'options' => [
                    ['text' => 'Biru dan Putih', 'is_correct' => false],
                    ['text' => 'Merah dan Putih', 'is_correct' => true],
                    ['text' => 'Hijau dan Kuning', 'is_correct' => false],
                    ['text' => 'Hitam dan Merah', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Siapa nama presiden pertama Republik Indonesia?',
                'options' => [
                    ['text' => 'Mohammad Hatta', 'is_correct' => false],
                    ['text' => 'Soeharto', 'is_correct' => false],
                    ['text' => 'Soekarno', 'is_correct' => true],
                    ['text' => 'Joko Widodo', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Tuliskan 5 nama buah-buahan yang Anda ketahui.',
            ],

            // SD - IPA
            [
                'subject_code' => 'IPA',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Bagian tubuh yang digunakan untuk melihat adalah...',
                'options' => [
                    ['text' => 'Telinga', 'is_correct' => false],
                    ['text' => 'Mata', 'is_correct' => true],
                    ['text' => 'Hidung', 'is_correct' => false],
                    ['text' => 'Lidah', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Hewan yang hidup di air dan bernapas dengan insang adalah...',
                'options' => [
                    ['text' => 'Kucing', 'is_correct' => false],
                    ['text' => 'Burung', 'is_correct' => false],
                    ['text' => 'Ikan', 'is_correct' => true],
                    ['text' => 'Sapi', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Tumbuhan membutuhkan apa untuk membuat makanannya sendiri?',
                'options' => [
                    ['text' => 'Daging', 'is_correct' => false],
                    ['text' => 'Sinar matahari', 'is_correct' => true],
                    ['text' => 'Batu', 'is_correct' => false],
                    ['text' => 'Api', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Planet tempat kita tinggal adalah...',
                'options' => [
                    ['text' => 'Mars', 'is_correct' => false],
                    ['text' => 'Jupiter', 'is_correct' => false],
                    ['text' => 'Bumi', 'is_correct' => true],
                    ['text' => 'Venus', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang menyebabkan siang dan malam?',
                'options' => [
                    ['text' => 'Bulan mengelilingi Bumi', 'is_correct' => false],
                    ['text' => 'Bumi berputar pada porosnya', 'is_correct' => true],
                    ['text' => 'Matahari terbit dan terbenam', 'is_correct' => false],
                    ['text' => 'Awan menutupi matahari', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Bagian tumbuhan yang berfungsi sebagai alat perkembangbiakan adalah...',
                'options' => [
                    ['text' => 'Akar', 'is_correct' => false],
                    ['text' => 'Batang', 'is_correct' => false],
                    ['text' => 'Bunga', 'is_correct' => true],
                    ['text' => 'Daun', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang terjadi jika kita mencampur warna merah dan kuning?',
                'options' => [
                    ['text' => 'Biru', 'is_correct' => false],
                    ['text' => 'Hijau', 'is_correct' => false],
                    ['text' => 'Oranye', 'is_correct' => true],
                    ['text' => 'Ungu', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Sumber energi utama bagi kehidupan di Bumi adalah...',
                'options' => [
                    ['text' => 'Angin', 'is_correct' => false],
                    ['text' => 'Air', 'is_correct' => false],
                    ['text' => 'Matahari', 'is_correct' => true],
                    ['text' => 'Batu bara', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Proses perubahan air menjadi uap disebut...',
                'options' => [
                    ['text' => 'Membeku', 'is_correct' => false],
                    ['text' => 'Mencair', 'is_correct' => false],
                    ['text' => 'Menguap', 'is_correct' => true],
                    ['text' => 'Mengembun', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Jelaskan siklus hidup kupu-kupu.',
            ],

            // SD - IPS
            [
                'subject_code' => 'IPS',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Siapa nama proklamator kemerdekaan Indonesia?',
                'options' => [
                    ['text' => 'Mohammad Hatta', 'is_correct' => false],
                    ['text' => 'Soekarno', 'is_correct' => true],
                    ['text' => 'Sutan Sjahrir', 'is_correct' => false],
                    ['text' => 'Tan Malaka', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Kapan Indonesia merdeka?',
                'options' => [
                    ['text' => '17 Agustus 1944', 'is_correct' => false],
                    ['text' => '17 Agustus 1945', 'is_correct' => true],
                    ['text' => '17 Agustus 1946', 'is_correct' => false],
                    ['text' => '17 Agustus 1947', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa nama lagu kebangsaan Indonesia?',
                'options' => [
                    ['text' => 'Garuda Pancasila', 'is_correct' => false],
                    ['text' => 'Indonesia Raya', 'is_correct' => true],
                    ['text' => 'Maju Tak Gentar', 'is_correct' => false],
                    ['text' => 'Halo-halo Bandung', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Pulau terbesar di Indonesia adalah...',
                'options' => [
                    ['text' => 'Jawa', 'is_correct' => false],
                    ['text' => 'Sumatera', 'is_correct' => false],
                    ['text' => 'Kalimantan', 'is_correct' => true],
                    ['text' => 'Sulawesi', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Monumen Nasional (Monas) terletak di kota...',
                'options' => [
                    ['text' => 'Bandung', 'is_correct' => false],
                    ['text' => 'Surabaya', 'is_correct' => false],
                    ['text' => 'Jakarta', 'is_correct' => true],
                    ['text' => 'Yogyakarta', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Semboyan Bhinneka Tunggal Ika berarti...',
                'options' => [
                    ['text' => 'Bersatu kita teguh', 'is_correct' => false],
                    ['text' => 'Berbeda-beda tetapi tetap satu', 'is_correct' => true],
                    ['text' => 'Pancasila dasar negara', 'is_correct' => false],
                    ['text' => 'Indonesia tanah airku', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Pahlawan wanita dari Aceh yang gigih melawan penjajah adalah...',
                'options' => [
                    ['text' => 'Dewi Sartika', 'is_correct' => false],
                    ['text' => 'Cut Nyak Dien', 'is_correct' => true],
                    ['text' => 'Fatmawati', 'is_correct' => false],
                    ['text' => 'Kartini', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Candi Borobudur terletak di provinsi...',
                'options' => [
                    ['text' => 'Jawa Timur', 'is_correct' => false],
                    ['text' => 'Jawa Tengah', 'is_correct' => true],
                    ['text' => 'Bali', 'is_correct' => false],
                    ['text' => 'Sumatera Barat', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa nama mata uang Indonesia?',
                'options' => [
                    ['text' => 'Dolar', 'is_correct' => false],
                    ['text' => 'Ringgit', 'is_correct' => false],
                    ['text' => 'Rupiah', 'is_correct' => true],
                    ['text' => 'Yen', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SD',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Sebutkan dan jelaskan secara singkat 3 pahlawan nasional Indonesia yang Anda ketahui.',
            ],

            // SMP - Matematika
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Hasil dari (-5) + 8 adalah...',
                'options' => [
                    ['text' => '-3', 'is_correct' => false],
                    ['text' => '3', 'is_correct' => true],
                    ['text' => '13', 'is_correct' => false],
                    ['text' => '-13', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Jika 3x - 7 = 8, maka nilai x adalah...',
                'options' => [
                    ['text' => '3', 'is_correct' => false],
                    ['text' => '4', 'is_correct' => false],
                    ['text' => '5', 'is_correct' => true],
                    ['text' => '6', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Keliling lingkaran dengan jari-jari 7 cm adalah... (gunakan π = 22/7)',
                'options' => [
                    ['text' => '22 cm', 'is_correct' => false],
                    ['text' => '44 cm', 'is_correct' => true],
                    ['text' => '154 cm', 'is_correct' => false],
                    ['text' => '308 cm', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Bentuk sederhana dari 2a + 3b - a + 2b adalah...',
                'options' => [
                    ['text' => 'a + b', 'is_correct' => false],
                    ['text' => 'a + 5b', 'is_correct' => true],
                    ['text' => '3a + 5b', 'is_correct' => false],
                    ['text' => '3a + b', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Sebuah segitiga memiliki sudut 60°, 70°, dan x°. Berapakah nilai x?',
                'options' => [
                    ['text' => '40°', 'is_correct' => false],
                    ['text' => '50°', 'is_correct' => true],
                    ['text' => '60°', 'is_correct' => false],
                    ['text' => '70°', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Faktorisasi prima dari 24 adalah...',
                'options' => [
                    ['text' => '2 x 12', 'is_correct' => false],
                    ['text' => '2^3 x 3', 'is_correct' => true],
                    ['text' => '3 x 8', 'is_correct' => false],
                    ['text' => '2 x 3 x 4', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Luas persegi dengan sisi 9 cm adalah...',
                'options' => [
                    ['text' => '18 cm²', 'is_correct' => false],
                    ['text' => '36 cm²', 'is_correct' => false],
                    ['text' => '81 cm²', 'is_correct' => true],
                    ['text' => '100 cm²', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Himpunan bilangan prima kurang dari 10 adalah...',
                'options' => [
                    ['text' => '{1, 2, 3, 5, 7}', 'is_correct' => false],
                    ['text' => '{2, 3, 5, 7}', 'is_correct' => true],
                    ['text' => '{1, 3, 5, 7, 9}', 'is_correct' => false],
                    ['text' => '{2, 3, 5, 9}', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Gradien garis yang melalui titik (2,3) dan (4,7) adalah...',
                'options' => [
                    ['text' => '1', 'is_correct' => false],
                    ['text' => '2', 'is_correct' => true],
                    ['text' => '3', 'is_correct' => false],
                    ['text' => '4', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Jelaskan konsep himpunan bagian dan berikan contohnya.',
            ],

            // SMP - Bahasa Inggris
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Choose the correct sentence: "She ___ to school every day."',
                'options' => [
                    ['text' => 'go', 'is_correct' => false],
                    ['text' => 'goes', 'is_correct' => true],
                    ['text' => 'going', 'is_correct' => false],
                    ['text' => 'went', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'What is the past tense of "eat"?',
                'options' => [
                    ['text' => 'eaten', 'is_correct' => false],
                    ['text' => 'ate', 'is_correct' => true],
                    ['text' => 'eating', 'is_correct' => false],
                    ['text' => 'eats', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Which of the following is a synonym for "beautiful"?',
                'options' => [
                    ['text' => 'Ugly', 'is_correct' => false],
                    ['text' => 'Pretty', 'is_correct' => true],
                    ['text' => 'Bad', 'is_correct' => false],
                    ['text' => 'Sad', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Complete the sentence: "If I ___ a bird, I would fly."',
                'options' => [
                    ['text' => 'was', 'is_correct' => false],
                    ['text' => 'were', 'is_correct' => true],
                    ['text' => 'am', 'is_correct' => false],
                    ['text' => 'is', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'What is the plural form of "child"?',
                'options' => [
                    ['text' => 'Childs', 'is_correct' => false],
                    ['text' => 'Children', 'is_correct' => true],
                    ['text' => 'Childes', 'is_correct' => false],
                    ['text' => 'Childen', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Which word is an adjective?',
                'options' => [
                    ['text' => 'Run', 'is_correct' => false],
                    ['text' => 'Quickly', 'is_correct' => false],
                    ['text' => 'Happy', 'is_correct' => true],
                    ['text' => 'Sing', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'What is the correct order of words in a simple English sentence?',
                'options' => [
                    ['text' => 'Verb-Subject-Object', 'is_correct' => false],
                    ['text' => 'Subject-Verb-Object', 'is_correct' => true],
                    ['text' => 'Object-Subject-Verb', 'is_correct' => false],
                    ['text' => 'Verb-Object-Subject', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Which of these is a conjunction?',
                'options' => [
                    ['text' => 'Table', 'is_correct' => false],
                    ['text' => 'And', 'is_correct' => true],
                    ['text' => 'Quick', 'is_correct' => false],
                    ['text' => 'Jump', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'What is the meaning of "diligent"?',
                'options' => [
                    ['text' => 'Lazy', 'is_correct' => false],
                    ['text' => 'Hardworking', 'is_correct' => true],
                    ['text' => 'Slow', 'is_correct' => false],
                    ['text' => 'Careless', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Describe your favorite hobby in English, including why you enjoy it.',
            ],

            // SMP - Bahasa Indonesia
            [
                'subject_code' => 'IND',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Kalimat yang menggunakan kata kerja pasif adalah...',
                'options' => [
                    ['text' => 'Dia membaca buku.', 'is_correct' => false],
                    ['text' => 'Buku itu dibaca olehnya.', 'is_correct' => true],
                    ['text' => 'Mereka sedang bermain.', 'is_correct' => false],
                    ['text' => 'Kami akan pergi.', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Majas yang membandingkan dua hal yang berbeda seolah-olah sama adalah...',
                'options' => [
                    ['text' => 'Metafora', 'is_correct' => true],
                    ['text' => 'Personifikasi', 'is_correct' => false],
                    ['text' => 'Hiperbola', 'is_correct' => false],
                    ['text' => 'Litotes', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Unsur intrinsik dalam cerpen yang berkaitan dengan urutan peristiwa adalah...',
                'options' => [
                    ['text' => 'Tokoh', 'is_correct' => false],
                    ['text' => 'Latar', 'is_correct' => false],
                    ['text' => 'Alur', 'is_correct' => true],
                    ['text' => 'Amanat', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Kata baku dari "apotik" adalah...',
                'options' => [
                    ['text' => 'Apotek', 'is_correct' => true],
                    ['text' => 'Apotic', 'is_correct' => false],
                    ['text' => 'Apoteq', 'is_correct' => false],
                    ['text' => 'Apotekh', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Jenis paragraf yang bertujuan untuk meyakinkan pembaca adalah...',
                'options' => [
                    ['text' => 'Narasi', 'is_correct' => false],
                    ['text' => 'Deskripsi', 'is_correct' => false],
                    ['text' => 'Argumentasi', 'is_correct' => true],
                    ['text' => 'Eksposisi', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa fungsi utama imbuhan "me-" pada kata dasar "baca"?',
                'options' => [
                    ['text' => 'Menunjukkan tempat', 'is_correct' => false],
                    ['text' => 'Membentuk kata kerja aktif', 'is_correct' => true],
                    ['text' => 'Menunjukkan waktu', 'is_correct' => false],
                    ['text' => 'Membentuk kata sifat', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Puisi lama yang terikat oleh aturan jumlah baris, rima, dan irama adalah...',
                'options' => [
                    ['text' => 'Puisi bebas', 'is_correct' => false],
                    ['text' => 'Pantun', 'is_correct' => true],
                    ['text' => 'Sajak', 'is_correct' => false],
                    ['text' => 'Syair', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Kalimat efektif adalah kalimat yang...',
                'options' => [
                    ['text' => 'Panjang dan rumit', 'is_correct' => false],
                    ['text' => 'Singkat dan tidak jelas', 'is_correct' => false],
                    ['text' => 'Jelas, singkat, dan mudah dipahami', 'is_correct' => true],
                    ['text' => 'Menggunakan banyak kata asing', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang dimaksud dengan "idiom"?',
                'options' => [
                    ['text' => 'Kata yang memiliki banyak arti', 'is_correct' => false],
                    ['text' => 'Ungkapan yang maknanya tidak dapat diartikan secara harfiah', 'is_correct' => true],
                    ['text' => 'Kata serapan dari bahasa asing', 'is_correct' => false],
                    ['text' => 'Kalimat yang mengandung perumpamaan', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Jelaskan perbedaan antara fakta dan opini dalam sebuah teks.',
            ],

            // SMP - IPA
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Proses fotosintesis pada tumbuhan menghasilkan...',
                'options' => [
                    ['text' => 'Karbon dioksida dan air', 'is_correct' => false],
                    ['text' => 'Oksigen dan glukosa', 'is_correct' => true],
                    ['text' => 'Nitrogen dan hidrogen', 'is_correct' => false],
                    ['text' => 'Sulfur dan metana', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Bagian sel tumbuhan yang berfungsi sebagai tempat fotosintesis adalah...',
                'options' => [
                    ['text' => 'Mitokondria', 'is_correct' => false],
                    ['text' => 'Kloroplas', 'is_correct' => true],
                    ['text' => 'Vakuola', 'is_correct' => false],
                    ['text' => 'Dinding sel', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Gaya yang menarik benda ke pusat bumi disebut gaya...',
                'options' => [
                    ['text' => 'Gesek', 'is_correct' => false],
                    ['text' => 'Pegas', 'is_correct' => false],
                    ['text' => 'Gravitasi', 'is_correct' => true],
                    ['text' => 'Magnet', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Perubahan wujud zat dari padat menjadi gas tanpa melalui fase cair disebut...',
                'options' => [
                    ['text' => 'Mencair', 'is_correct' => false],
                    ['text' => 'Menguap', 'is_correct' => false],
                    ['text' => 'Menyublim', 'is_correct' => true],
                    ['text' => 'Membeku', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Organ pernapasan utama pada manusia adalah...',
                'options' => [
                    ['text' => 'Jantung', 'is_correct' => false],
                    ['text' => 'Paru-paru', 'is_correct' => true],
                    ['text' => 'Ginjal', 'is_correct' => false],
                    ['text' => 'Hati', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa nama proses di mana air dari permukaan bumi menguap ke atmosfer?',
                'options' => [
                    ['text' => 'Kondensasi', 'is_correct' => false],
                    ['text' => 'Presipitasi', 'is_correct' => false],
                    ['text' => 'Evaporasi', 'is_correct' => true],
                    ['text' => 'Infiltrasi', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Satuan internasional untuk energi adalah...',
                'options' => [
                    ['text' => 'Watt', 'is_correct' => false],
                    ['text' => 'Joule', 'is_correct' => true],
                    ['text' => 'Newton', 'is_correct' => false],
                    ['text' => 'Volt', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Penyakit yang disebabkan oleh virus adalah...',
                'options' => [
                    ['text' => 'TBC', 'is_correct' => false],
                    ['text' => 'Malaria', 'is_correct' => false],
                    ['text' => 'Flu', 'is_correct' => true],
                    ['text' => 'Tifus', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang terjadi pada air ketika dipanaskan hingga 100°C pada tekanan standar?',
                'options' => [
                    ['text' => 'Membeku', 'is_correct' => false],
                    ['text' => 'Mencair', 'is_correct' => false],
                    ['text' => 'Mendidih', 'is_correct' => true],
                    ['text' => 'Mengembun', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Jelaskan perbedaan antara rangkaian listrik seri dan paralel.',
            ],

            // SMP - IPS
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Peristiwa Rengasdengklok terjadi karena...',
                'options' => [
                    ['text' => 'Perbedaan pendapat antara golongan tua dan muda tentang proklamasi', 'is_correct' => true],
                    ['text' => 'Perebutan kekuasaan antara Jepang dan Sekutu', 'is_correct' => false],
                    ['text' => 'Persiapan kemerdekaan Indonesia oleh PPKI', 'is_correct' => false],
                    ['text' => 'Pembentukan BPUPKI', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Tokoh yang mengetik naskah proklamasi kemerdekaan Indonesia adalah...',
                'options' => [
                    ['text' => 'Sayuti Melik', 'is_correct' => true],
                    ['text' => 'Sukarni', 'is_correct' => false],
                    ['text' => 'Fatmawati', 'is_correct' => false],
                    ['text' => 'Latief Hendraningrat', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Perjanjian Linggarjati adalah perjanjian antara Indonesia dengan...',
                'options' => [
                    ['text' => 'Jepang', 'is_correct' => false],
                    ['text' => 'Belanda', 'is_correct' => true],
                    ['text' => 'Inggris', 'is_correct' => false],
                    ['text' => 'Amerika Serikat', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Organisasi pergerakan nasional yang didirikan oleh dr. Sutomo pada tahun 1908 adalah...',
                'options' => [
                    ['text' => 'Sarekat Islam', 'is_correct' => false],
                    ['text' => 'Indische Partij', 'is_correct' => false],
                    ['text' => 'Budi Utomo', 'is_correct' => true],
                    ['text' => 'Perhimpunan Indonesia', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa tujuan utama didirikannya VOC oleh Belanda?',
                'options' => [
                    ['text' => 'Menyebarkan agama', 'is_correct' => false],
                    ['text' => 'Mencari rempah-rempah dan memonopoli perdagangan', 'is_correct' => true],
                    ['text' => 'Membangun infrastruktur di Indonesia', 'is_correct' => false],
                    ['text' => 'Melakukan penelitian ilmiah', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Peristiwa Bandung Lautan Api terjadi pada tanggal...',
                'options' => [
                    ['text' => '23 Maret 1945', 'is_correct' => false],
                    ['text' => '24 Maret 1946', 'is_correct' => true],
                    ['text' => '25 Maret 1947', 'is_correct' => false],
                    ['text' => '26 Maret 1948', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Siapa yang memimpin perlawanan rakyat Aceh terhadap Belanda?',
                'options' => [
                    ['text' => 'Pangeran Diponegoro', 'is_correct' => false],
                    ['text' => 'Tuanku Imam Bonjol', 'is_correct' => false],
                    ['text' => 'Teuku Umar', 'is_correct' => true],
                    ['text' => 'Sultan Hasanuddin', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa nama kabinet pertama setelah proklamasi kemerdekaan Indonesia?',
                'options' => [
                    ['text' => 'Kabinet Hatta', 'is_correct' => false],
                    ['text' => 'Kabinet Sjahrir I', 'is_correct' => true],
                    ['text' => 'Kabinet Natsir', 'is_correct' => false],
                    ['text' => 'Kabinet Sukiman', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Peristiwa G30S/PKI terjadi pada tahun...',
                'options' => [
                    ['text' => '1945', 'is_correct' => false],
                    ['text' => '1950', 'is_correct' => false],
                    ['text' => '1965', 'is_correct' => true],
                    ['text' => '1970', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMP',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Jelaskan latar belakang terjadinya Sumpah Pemuda dan dampaknya bagi pergerakan nasional Indonesia.',
            ],

            // SMA - Matematika
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Jika f(x) = 2x + 3 dan g(x) = x^2, maka (f o g)(x) adalah...',
                'options' => [
                    ['text' => '2x^2 + 3', 'is_correct' => true],
                    ['text' => '(2x + 3)^2', 'is_correct' => false],
                    ['text' => '4x^2 + 12x + 9', 'is_correct' => false],
                    ['text' => 'x^2 + 2x + 3', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Nilai dari lim (x->2) (x^2 - 4) / (x - 2) adalah...',
                'options' => [
                    ['text' => '0', 'is_correct' => false],
                    ['text' => '2', 'is_correct' => false],
                    ['text' => '4', 'is_correct' => true],
                    ['text' => 'Tidak terdefinisi', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Turunan pertama dari f(x) = 3x^3 - 2x^2 + 5x - 1 adalah...',
                'options' => [
                    ['text' => '9x^2 - 4x + 5', 'is_correct' => true],
                    ['text' => '3x^2 - 2x + 5', 'is_correct' => false],
                    ['text' => '9x^3 - 4x^2 + 5x', 'is_correct' => false],
                    ['text' => '6x - 2', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Integral dari 4x^3 dx adalah...',
                'options' => [
                    ['text' => 'x^4 + C', 'is_correct' => true],
                    ['text' => '12x^2 + C', 'is_correct' => false],
                    ['text' => '4x^4 + C', 'is_correct' => false],
                    ['text' => 'x^3 + C', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Penyelesaian dari sistem persamaan linear 2x + y = 7 dan x - y = 2 adalah...',
                'options' => [
                    ['text' => 'x=3, y=1', 'is_correct' => true],
                    ['text' => 'x=1, y=3', 'is_correct' => false],
                    ['text' => 'x=2, y=3', 'is_correct' => false],
                    ['text' => 'x=3, y=2', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Jika matriks A = [[2, 1], [3, 4]] dan B = [[1, 5], [0, 2]], maka A + B adalah...',
                'options' => [
                    ['text' => '[[3, 6], [3, 6]]', 'is_correct' => true],
                    ['text' => '[[2, 5], [3, 8]]', 'is_correct' => false],
                    ['text' => '[[3, 5], [3, 6]]', 'is_correct' => false],
                    ['text' => '[[2, 6], [3, 8]]', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Persamaan kuadrat yang akar-akarnya 2 dan -3 adalah...',
                'options' => [
                    ['text' => 'x^2 - x - 6 = 0', 'is_correct' => true],
                    ['text' => 'x^2 + x - 6 = 0', 'is_correct' => false],
                    ['text' => 'x^2 - 5x + 6 = 0', 'is_correct' => false],
                    ['text' => 'x^2 + 5x + 6 = 0', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Nilai dari sin(30°) + cos(60°) adalah...',
                'options' => [
                    ['text' => '0', 'is_correct' => false],
                    ['text' => '1/2', 'is_correct' => false],
                    ['text' => '1', 'is_correct' => true],
                    ['text' => 'sqrt(3)/2', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Jika sebuah dadu dilempar, peluang muncul mata dadu genap adalah...',
                'options' => [
                    ['text' => '1/6', 'is_correct' => false],
                    ['text' => '1/3', 'is_correct' => false],
                    ['text' => '1/2', 'is_correct' => true],
                    ['text' => '2/3', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'MATH',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Jelaskan konsep limit fungsi dan berikan contoh penerapannya dalam kehidupan sehari-hari.',
            ],

            // SMA - Bahasa Inggris
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Which sentence uses the correct conditional type 2?',
                'options' => [
                    ['text' => 'If I had money, I would buy a car.', 'is_correct' => true],
                    ['text' => 'If I have money, I will buy a car.', 'is_correct' => false],
                    ['text' => 'If I had had money, I would have bought a car.', 'is_correct' => false],
                    ['text' => 'If I buy a car, I have money.', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'The passive voice of "The student wrote the essay" is...',
                'options' => [
                    ['text' => 'The essay wrote the student.', 'is_correct' => false],
                    ['text' => 'The essay was written by the student.', 'is_correct' => true],
                    ['text' => 'The student was written by the essay.', 'is_correct' => false],
                    ['text' => 'The essay writes the student.', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Which of the following is an example of a complex sentence?',
                'options' => [
                    ['text' => 'She sings and he dances.', 'is_correct' => false],
                    ['text' => 'He ran quickly.', 'is_correct' => false],
                    ['text' => 'Although it was raining, we went for a walk.', 'is_correct' => true],
                    ['text' => 'I like coffee.', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'What is the function of a relative pronoun?',
                'options' => [
                    ['text' => 'To connect two independent clauses', 'is_correct' => false],
                    ['text' => 'To introduce a dependent clause that modifies a noun or pronoun', 'is_correct' => true],
                    ['text' => 'To show possession', 'is_correct' => false],
                    ['text' => 'To replace a noun in a sentence', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Which phrasal verb means "to discover by chance"?',
                'options' => [
                    ['text' => 'Look up', 'is_correct' => false],
                    ['text' => 'Find out', 'is_correct' => true],
                    ['text' => 'Give up', 'is_correct' => false],
                    ['text' => 'Take off', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'What is the correct punctuation for a direct question?',
                'options' => [
                    ['text' => 'Period (.)', 'is_correct' => false],
                    ['text' => 'Exclamation mark (!)', 'is_correct' => false],
                    ['text' => 'Question mark (?)', 'is_correct' => true],
                    ['text' => 'Comma (,)', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Which of the following is a common idiom meaning "to be in a difficult situation"?',
                'options' => [
                    ['text' => 'To be on cloud nine', 'is_correct' => false],
                    ['text' => 'To be in hot water', 'is_correct' => true],
                    ['text' => 'To break a leg', 'is_correct' => false],
                    ['text' => 'To hit the road', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'What is the main purpose of a topic sentence in a paragraph?',
                'options' => [
                    ['text' => 'To provide supporting details', 'is_correct' => false],
                    ['text' => 'To introduce the main idea of the paragraph', 'is_correct' => true],
                    ['text' => 'To conclude the paragraph', 'is_correct' => false],
                    ['text' => 'To transition to the next paragraph', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Which type of essay aims to convince the reader of a particular viewpoint?',
                'options' => [
                    ['text' => 'Narrative essay', 'is_correct' => false],
                    ['text' => 'Descriptive essay', 'is_correct' => false],
                    ['text' => 'Persuasive essay', 'is_correct' => true],
                    ['text' => 'Expository essay', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'ENG',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Discuss the importance of learning English in the globalized world.',
            ],

            // SMA - Bahasa Indonesia
            [
                'subject_code' => 'IND',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Ciri kebahasaan teks editorial yang menunjukkan sikap penulis adalah...',
                'options' => [
                    ['text' => 'Fakta', 'is_correct' => false],
                    ['text' => 'Opini', 'is_correct' => true],
                    ['text' => 'Data', 'is_correct' => false],
                    ['text' => 'Statistik', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang dimaksud dengan "resensi buku"?',
                'options' => [
                    ['text' => 'Daftar isi buku', 'is_correct' => false],
                    ['text' => 'Ringkasan isi buku', 'is_correct' => false],
                    ['text' => 'Penilaian terhadap suatu karya buku', 'is_correct' => true],
                    ['text' => 'Biografi penulis buku', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Unsur ekstrinsik dalam novel yang berkaitan dengan latar belakang pengarang adalah...',
                'options' => [
                    ['text' => 'Tema', 'is_correct' => false],
                    ['text' => 'Amanat', 'is_correct' => false],
                    ['text' => 'Biografi pengarang', 'is_correct' => true],
                    ['text' => 'Gaya bahasa', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Kalimat yang mengandung konjungsi kausalitas adalah...',
                'options' => [
                    ['text' => 'Dia rajin belajar, tetapi nilainya tetap rendah.', 'is_correct' => false],
                    ['text' => 'Dia sakit karena kehujanan.', 'is_correct' => true],
                    ['text' => 'Dia pergi ke pasar dan membeli sayur.', 'is_correct' => false],
                    ['text' => 'Meskipun lelah, dia tetap bekerja.', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa fungsi dari daftar pustaka dalam sebuah karya ilmiah?',
                'options' => [
                    ['text' => 'Menjelaskan tujuan penelitian', 'is_correct' => false],
                    ['text' => 'Menyajikan hasil penelitian', 'is_correct' => false],
                    ['text' => 'Menunjukkan sumber referensi yang digunakan', 'is_correct' => true],
                    ['text' => 'Merangkum isi penelitian', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Jenis teks yang bertujuan untuk memberikan informasi atau penjelasan tentang suatu topik adalah...',
                'options' => [
                    ['text' => 'Narasi', 'is_correct' => false],
                    ['text' => 'Deskripsi', 'is_correct' => false],
                    ['text' => 'Eksposisi', 'is_correct' => true],
                    ['text' => 'Persuasi', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang dimaksud dengan "diksi"?',
                'options' => [
                    ['text' => 'Susunan kalimat', 'is_correct' => false],
                    ['text' => 'Pilihan kata yang tepat', 'is_correct' => true],
                    ['text' => 'Gaya bahasa', 'is_correct' => false],
                    ['text' => 'Struktur paragraf', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Puisi yang tidak terikat oleh aturan rima, irama, dan jumlah baris disebut...',
                'options' => [
                    ['text' => 'Pantun', 'is_correct' => false],
                    ['text' => 'Syair', 'is_correct' => false],
                    ['text' => 'Puisi bebas', 'is_correct' => true],
                    ['text' => 'Soneta', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang dimaksud dengan "konflik" dalam sebuah cerita?',
                'options' => [
                    ['text' => 'Penyelesaian masalah', 'is_correct' => false],
                    ['text' => 'Permasalahan atau pertentangan antar tokoh', 'is_correct' => true],
                    ['text' => 'Latar tempat dan waktu', 'is_correct' => false],
                    ['text' => 'Pesan moral cerita', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IND',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Analisis unsur intrinsik dan ekstrinsik dari salah satu novel Indonesia yang Anda ketahui.',
            ],

            // SMA - IPA
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Hukum Newton I menyatakan bahwa...',
                'options' => [
                    ['text' => 'Gaya adalah massa dikalikan percepatan', 'is_correct' => false],
                    ['text' => 'Setiap aksi memiliki reaksi yang sama dan berlawanan', 'is_correct' => false],
                    ['text' => 'Benda akan tetap diam atau bergerak lurus beraturan jika tidak ada gaya luar yang bekerja padanya', 'is_correct' => true],
                    ['text' => 'Energi tidak dapat diciptakan atau dimusnahkan', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang dimaksud dengan "fotosintesis"?',
                'options' => [
                    ['text' => 'Proses pernapasan pada tumbuhan', 'is_correct' => false],
                    ['text' => 'Proses pembentukan makanan oleh tumbuhan dengan bantuan cahaya matahari', 'is_correct' => true],
                    ['text' => 'Proses penguapan air dari daun tumbuhan', 'is_correct' => false],
                    ['text' => 'Proses penyerapan nutrisi dari tanah oleh tumbuhan', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Unsur kimia dengan simbol "Fe" adalah...',
                'options' => [
                    ['text' => 'Fluorin', 'is_correct' => false],
                    ['text' => 'Fosfor', 'is_correct' => false],
                    ['text' => 'Besi', 'is_correct' => true],
                    ['text' => 'Emas', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa fungsi utama ginjal pada manusia?',
                'options' => [
                    ['text' => 'Memompa darah', 'is_correct' => false],
                    ['text' => 'Menyaring darah dan membuang limbah', 'is_correct' => true],
                    ['text' => 'Mencerna makanan', 'is_correct' => false],
                    ['text' => 'Menghasilkan hormon', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Gelombang yang membutuhkan medium untuk merambat disebut gelombang...',
                'options' => [
                    ['text' => 'Elektromagnetik', 'is_correct' => false],
                    ['text' => 'Mekanis', 'is_correct' => true],
                    ['text' => 'Cahaya', 'is_correct' => false],
                    ['text' => 'Radio', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang dimaksud dengan "reaksi endoterm"?',
                'options' => [
                    ['text' => 'Reaksi yang melepaskan panas', 'is_correct' => false],
                    ['text' => 'Reaksi yang menyerap panas', 'is_correct' => true],
                    ['text' => 'Reaksi yang menghasilkan cahaya', 'is_correct' => false],
                    ['text' => 'Reaksi yang menghasilkan suara', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Bagian otak yang bertanggung jawab untuk koordinasi gerakan dan keseimbangan adalah...',
                'options' => [
                    ['text' => 'Otak besar (Cerebrum)', 'is_correct' => false],
                    ['text' => 'Otak kecil (Cerebellum)', 'is_correct' => true],
                    ['text' => 'Batang otak (Brainstem)', 'is_correct' => false],
                    ['text' => 'Talamus', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang dimaksud dengan "bioteknologi"?',
                'options' => [
                    ['text' => 'Studi tentang batuan dan mineral', 'is_correct' => false],
                    ['text' => 'Pemanfaatan organisme hidup untuk menghasilkan produk atau proses tertentu', 'is_correct' => true],
                    ['text' => 'Studi tentang bintang dan planet', 'is_correct' => false],
                    ['text' => 'Pengembangan teknologi informasi', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa nama proses di mana sel membelah menjadi dua sel anak yang identik?',
                'options' => [
                    ['text' => 'Meiosis', 'is_correct' => false],
                    ['text' => 'Mitosis', 'is_correct' => true],
                    ['text' => 'Fertilisasi', 'is_correct' => false],
                    ['text' => 'Fotosintesis', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPA',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Jelaskan teori evolusi Darwin dan berikan contoh bukti-bukti yang mendukungnya.',
            ],

            // SMA - IPS
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa dampak utama dari Revolusi Industri terhadap masyarakat?',
                'options' => [
                    ['text' => 'Peningkatan jumlah petani', 'is_correct' => false],
                    ['text' => 'Urbanisasi dan munculnya kelas pekerja', 'is_correct' => true],
                    ['text' => 'Penurunan produksi barang', 'is_correct' => false],
                    ['text' => 'Kembalinya sistem feodal', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Perang Dunia II dimulai dengan invasi Jerman ke negara...',
                'options' => [
                    ['text' => 'Prancis', 'is_correct' => false],
                    ['text' => 'Polandia', 'is_correct' => true],
                    ['text' => 'Inggris', 'is_correct' => false],
                    ['text' => 'Uni Soviet', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang menjadi penyebab utama Perang Dingin?',
                'options' => [
                    ['text' => 'Perebutan wilayah', 'is_correct' => false],
                    ['text' => 'Perbedaan ideologi antara kapitalisme dan komunisme', 'is_correct' => true],
                    ['text' => 'Krisis ekonomi global', 'is_correct' => false],
                    ['text' => 'Perlombaan senjata nuklir', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Organisasi internasional yang didirikan setelah Perang Dunia II untuk menjaga perdamaian dunia adalah...',
                'options' => [
                    ['text' => 'Liga Bangsa-Bangsa', 'is_correct' => false],
                    ['text' => 'Perserikatan Bangsa-Bangsa (PBB)', 'is_correct' => true],
                    ['text' => 'NATO', 'is_correct' => false],
                    ['text' => 'Pakta Warsawa', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang dimaksud dengan "kolonialisme"?',
                'options' => [
                    ['text' => 'Sistem pemerintahan yang demokratis', 'is_correct' => false],
                    ['text' => 'Penguasaan suatu wilayah oleh negara lain untuk kepentingan ekonomi dan politik', 'is_correct' => true],
                    ['text' => 'Perdagangan bebas antar negara', 'is_correct' => false],
                    ['text' => 'Kerja sama antar negara dalam bidang budaya', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Peristiwa Reformasi di Indonesia pada tahun 1998 ditandai dengan...',
                'options' => [
                    ['text' => 'Naiknya harga BBM', 'is_correct' => false],
                    ['text' => 'Lengsernya Presiden Soeharto', 'is_correct' => true],
                    ['text' => 'Terjadinya krisis moneter', 'is_correct' => false],
                    ['text' => 'Pembentukan kabinet baru', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang menjadi latar belakang terjadinya Perang Diponegoro?',
                'options' => [
                    ['text' => 'Campur tangan Belanda dalam urusan kerajaan', 'is_correct' => true],
                    ['text' => 'Perebutan tahta kerajaan', 'is_correct' => false],
                    ['text' => 'Krisis ekonomi di Jawa', 'is_correct' => false],
                    ['text' => 'Pemberontakan petani', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa yang dimaksud dengan "globalisasi"?',
                'options' => [
                    ['text' => 'Proses penyempitan wilayah', 'is_correct' => false],
                    ['text' => 'Proses integrasi internasional yang terjadi karena pertukaran pandangan dunia, produk, pemikiran, dan aspek-aspek kebudayaan lainnya', 'is_correct' => true],
                    ['text' => 'Peningkatan nasionalisme di berbagai negara', 'is_correct' => false],
                    ['text' => 'Pembentukan blok-blok ekonomi regional', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::MULTIPLE_CHOICE_TEXT,
                'question_text' => 'Apa tujuan utama dari Gerakan Non-Blok?',
                'options' => [
                    ['text' => 'Membentuk aliansi militer baru', 'is_correct' => false],
                    ['text' => 'Menjaga netralitas di tengah Perang Dingin', 'is_correct' => true],
                    ['text' => 'Meningkatkan kekuatan ekonomi negara-negara berkembang', 'is_correct' => false],
                    ['text' => 'Menyebarkan ideologi tertentu', 'is_correct' => false],
                ],
            ],
            [
                'subject_code' => 'IPS',
                'education_code' => 'SMA',
                'type' => QuestionTypeConstant::ESSAY,
                'question_text' => 'Analisis dampak positif dan negatif dari perkembangan teknologi informasi terhadap kehidupan sosial masyarakat Indonesia.',
            ],
        ];

        foreach ($realQuestions as $questionData) {
            $subject = RefSubject::where('code', $questionData['subject_code'])
                                 ->whereHas('education', function ($query) use ($questionData) {
                                     $query->where('code', $questionData['education_code']);
                                 })
                                 ->first();

            if (!$subject) {
                $this->command->warn("Subject with code '{$questionData['subject_code']}' for education '{$questionData['education_code']}' not found. Skipping question.");
                continue;
            }

            $questionType = ($questionData['type'] === QuestionTypeConstant::MULTIPLE_CHOICE_TEXT) ? $multipleChoiceType : $essayType;

            $question = Question::create([
                'ref_subject_id' => $subject->id,
                'ref_subject_code' => $subject->code,
                'ref_question_type_code' => $questionType->code,
                'ref_question_type_id' => $questionType->id,
                'question_text' => $questionData['question_text'],
                'created_by' => $educators->random()->id,
            ]);

            if ($questionData['type'] === QuestionTypeConstant::MULTIPLE_CHOICE_TEXT && isset($questionData['options'])) {
                foreach ($questionData['options'] as $optionData) {
                    AnswerTextOption::create([
                        'question_id' => $question->id,
                        'answer' => $optionData['text'],
                        'is_correct' => $optionData['is_correct'],
                    ]);
                }
            }
        }
    }
}
