<?php

namespace Database\Seeders;

use App\Models\MasterType\RefEducation;
use App\Models\MasterType\RefSubject;
use App\Models\MasterType\SubjectProficiencyH;
use Illuminate\Database\Seeder;

class RealRefSubjectSeeder extends Seeder {
    public function run(): void {
        $subjectsByEducation = [
            /*'SD' => [ // Sekolah Dasar (Primary School)
                ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'Basic Mathematics for Primary School'],
                ['name' => 'English', 'code' => 'ENG', 'description' => 'Basic English for Primary School'],
                ['name' => 'Indonesian', 'code' => 'IND', 'description' => 'Bahasa Indonesia for Primary School'],
                ['name' => 'IPA', 'code' => 'IPA', 'description' => 'IPA'],
                ['name' => 'IPS', 'code' => 'IPS', 'description' => 'IPS'],
            ],
            'SMP' => [ // Sekolah Menengah Pertama (Junior High School)
                ['name' => 'Mathematics', 'code' => 'MATH', 'description' => 'Intermediate Mathematics for Junior High'],
                ['name' => 'English', 'code' => 'ENG', 'description' => 'Intermediate English for Junior High'],
                ['name' => 'Indonesian', 'code' => 'IND', 'description' => 'Bahasa Indonesia for Junior High'],
                ['name' => 'IPA', 'code' => 'IPA', 'description' => 'IPA'],
                ['name' => 'IPS', 'code' => 'IPS', 'description' => 'IPS'],
            ],*/
            'SMA' => [ // Sekolah Menengah Atas (Senior High School)
                [
                    'name' => 'Mathematics',
                    'code' => 'MATH',
                    'description' => 'Advanced Mathematics for Senior High',
                ],
                [
                    'name' => 'English',
                    'code' => 'ENG',
                    'description' => 'English language and literature for Senior High'
                ],
                [
                    'name' => 'Indonesian',
                    'code' => 'IND',
                    'description' => 'Bahasa Indonesia for Senior High'
                ],
                [
                    'name' => 'IPA',
                    'code' => 'IPA',
                    'description' => 'IPA',
                    'sub' => [
                        [
                            'name' => 'Fisika',
                            'code' => 'IPA-FISIKA',
                            'description' => 'blabalbal',
                        ],
                        [
                            'name' => 'Kimia',
                            'code' => 'IPA-KIMIA',
                            'description' => 'blablabla',
                        ],
                        [
                            'name' => 'Biologi',
                            'code' => 'IPA-BIOLGI',
                            'description' => 'blablabla',
                        ]
                    ]
                ],
                [
                    'name' => 'IPS',
                    'code' => 'IPS',
                    'description' => 'IPS',
                    'sub' => [
                        [
                            'name' => 'Sosiologi',
                            'code' => 'IPS-SOSIOG',
                            'description' => 'blabalbal',
                        ],
                        [
                            'name' => 'Geografi',
                            'code' => 'IPS-GEOGGI',
                            'description' => 'blablabla',
                        ],
                        [
                            'name' => 'Ekonomi',
                            'code' => 'IPS-EKONMI',
                            'description' => 'blablabla',
                        ],
                        [
                            'name' => 'Sejarah',
                            'code' => 'IPS-SEJARH',
                            'description' => 'blablabla',
                        ],
                        [
                            'name' => 'Antropologi',
                            'code' => 'IPS-ANTRGI',
                            'description' => 'blablabla',
                        ]
                    ]
                ],
            ],
        ];

        foreach ($subjectsByEducation as $educationCode => $subjects) {
            $education = RefEducation::where('code', $educationCode)->first();

            if ($education) {
                foreach ($subjects as $subjectData) {
                    $this->createSubject($subjectData, $education->id, null);
                }
            } else {
                $this->command->warn("Education level with code '{$educationCode}' not found. Skipping subjects for this level.");
            }
        }
    }

    private function createSubject(array $subjectData, int $educationId, ?int $parentId = null): void {
        $subject = RefSubject::firstOrCreate(
            [
                'code' => $subjectData['code'],
                'ref_education_id' => $educationId,
            ],
            [
                'name' => $subjectData['name'],
                'code' => $subjectData['code'],
                'description' => $subjectData['description'],
                'ref_education_id' => $educationId,
                'ref_subject_id' => $parentId,
            ]
        );

        if (isset($subjectData['sub'])) {
            foreach ($subjectData['sub'] as $childData) {
                $this->createSubject($childData, $educationId, $subject->id);
            }
        }
    }

}
