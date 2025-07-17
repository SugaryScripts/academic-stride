<?php

namespace Database\Seeders;

use App\Models\MasterType\RefEducation;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Seeder;

class RefSubjectSeeder extends Seeder {
    public function run(): void {
        $subjectsByEducation = [
            'SD' => [ // Sekolah Dasar (Primary School)
                ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'Basic Mathematics for Primary School'],
                ['name' => 'Science', 'code' => 'SCI', 'description' => 'Basic Science for Primary School'],
                ['name' => 'English', 'code' => 'ENG', 'description' => 'Basic English for Primary School'],
                ['name' => 'Indonesian', 'code' => 'IND', 'description' => 'Bahasa Indonesia for Primary School'],
                ['name' => 'Civics', 'code' => 'CIV', 'description' => 'Pendidikan Kewarganegaraan for Primary School'],
            ],
            'SMP' => [ // Sekolah Menengah Pertama (Junior High School)
                ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'Intermediate Mathematics for Junior High'],
                ['name' => 'Science', 'code' => 'SCI', 'description' => 'Intermediate Science for Junior High'],
                ['name' => 'English', 'code' => 'ENG', 'description' => 'Intermediate English for Junior High'],
                ['name' => 'Indonesian', 'code' => 'IND', 'description' => 'Bahasa Indonesia for Junior High'],
                ['name' => 'Physics', 'code' => 'PHY', 'description' => 'Basic Physics for Junior High'],
                ['name' => 'Chemistry', 'code' => 'CHEM', 'description' => 'Basic Chemistry for Junior High'],
                ['name' => 'Biology', 'code' => 'BIO', 'description' => 'Basic Biology for Junior High'],
                ['name' => 'History', 'code' => 'HIST', 'description' => 'Indonesian History for Junior High'],
                ['name' => 'Geography', 'code' => 'GEO', 'description' => 'Indonesian Geography for Junior High'],
                ['name' => 'Civics', 'code' => 'CIV', 'description' => 'Civics Education for Junior High'],
            ],
            'SMA' => [ // Sekolah Menengah Atas (Senior High School)
                ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'Advanced Mathematics for Senior High'],
                ['name' => 'Physics', 'code' => 'PHY', 'description' => 'Physics and physical sciences for Senior High'],
                ['name' => 'Chemistry', 'code' => 'CHEM', 'description' => 'Chemistry and chemical sciences for Senior High'],
                ['name' => 'Biology', 'code' => 'BIO', 'description' => 'Biology and life sciences for Senior High'],
                ['name' => 'English', 'code' => 'ENG', 'description' => 'English language and literature for Senior High'],
                ['name' => 'Indonesian', 'code' => 'IND', 'description' => 'Bahasa Indonesia for Senior High'],
                ['name' => 'History', 'code' => 'HIST', 'description' => 'World History for Senior High'],
                ['name' => 'Geography', 'code' => 'GEO', 'description' => 'Geography and earth sciences for Senior High'],
                ['name' => 'Economics', 'code' => 'ECO', 'description' => 'Economics principles for Senior High'],
            ],
            'UNV' => [ // Universitas (University Level)
                ['name' => 'Calculus I', 'code' => 'CALC1', 'description' => 'Introduction to Differential Calculus'],
                ['name' => 'Linear Algebra', 'code' => 'LIN_ALG', 'description' => 'Fundamentals of Linear Algebra'],
                ['name' => 'Data Structures', 'code' => 'DATA_STR', 'description' => 'Algorithms and Data Structures'],
                ['name' => 'Object-Oriented Programming', 'code' => 'OOP', 'description' => 'Concepts of OOP with Java/Python'],
                ['name' => 'Microeconomics', 'code' => 'MICRO', 'description' => 'Principles of Microeconomics'],
            ],
        ];

        foreach ($subjectsByEducation as $educationCode => $subjects) {
            // Find the education level by its code
            $education = RefEducation::where('code', $educationCode)->first();

            if ($education) {
                foreach ($subjects as $subjectData) {
                    RefSubject::firstOrCreate(
                        [
                            'code' => $subjectData['code'],
                            'ref_education_id' => $education->id,
                        ],
                        array_merge($subjectData, ['ref_education_id' => $education->id])
                    );
                }
            } else {
                $this->command->warn("Education level with code '{$educationCode}' not found. Skipping subjects for this level.");
            }
        }
    }
}
