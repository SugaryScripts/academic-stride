<?php

namespace Database\Seeders;

use App\Constants\EducationLevelConstant;
use App\Models\MasterType\RefEducation;
use Illuminate\Database\Seeder;

class RefEducationSeeder extends Seeder {
    public function run(): void {
        $educations = [
            ['name' => 'Sekolah Dasar', 'code' => EducationLevelConstant::PRIMARY_SCHOOL, 'description' => 'Primary School'],
            ['name' => 'Sekolah Menengah Pertama', 'code' => EducationLevelConstant::JUNIOR_HIGH_SCHOOL, 'description' => 'Junior High School'],
            ['name' => 'Sekolah Menengah Atas', 'code' => EducationLevelConstant::SENIOR_HIGH_SCHOOL, 'description' => 'Senior High School'],
            ['name' => 'Universitas', 'code' => EducationLevelConstant::UNIVERSITY, 'description' => 'University Level'],
        ];
        foreach ($educations as $education) {
            RefEducation::firstOrCreate(
                ['code' => $education['code']], // Use code for finding existing
                $education // Data to create if not found
            );
        }
    }
}
