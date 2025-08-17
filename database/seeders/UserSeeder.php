<?php

namespace Database\Seeders;

use App\Constants\EducationLevelConstant;
use App\Models\Account\Student;
use App\Models\Account\User;
use App\Models\MasterType\RefEducation;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder {
    public function run(): void {
        User::factory()->admin()->create([
            'name' => 'Super user',
            'username' => 'admin',
        ])->assignRole('Admin');

        // Find roles once to avoid repeated database queries inside the loops
        $educatorRole = Role::findByName('Educator');
        $analyserRole = Role::findByName('Analyser');
        $studentRole = Role::findByName('Student');

        // Create educators and assign role
        User::factory()->educator()->count(1)->create()->each(function ($user) use ($educatorRole) {
            $user->assignRole($educatorRole);
        });

        // Create analysers and assign role
        User::factory()->analyser()->count(1)->create()->each(function ($user) use ($analyserRole) {
            $user->assignRole($analyserRole);
        });

        // Get all available education level codes
        $educationCodes = EducationLevelConstant::allCodes();

        // Create students and assign role
        User::factory()->student()->count(3)->create()->each(function ($user) use ($studentRole, $educationCodes) {
            $user->assignRole($studentRole);

            // Randomly select one education code for the current student
            $randomEducationCode = $educationCodes[array_rand($educationCodes)];
            // Find the corresponding RefEducation record
            $refEducation = RefEducation::where('code', $randomEducationCode)->first();

            // Check if refEducation was found to prevent errors
            if ($refEducation) {
                // Create a student record linked to the user and the random education level
                Student::factory()->create([
                    'ref_education_code' => $randomEducationCode,
                    'ref_education_id' => $refEducation->id,
                    'user_id' => $user->id
                ]);
            } else {
                // Log an error or handle the case where a RefEducation record isn't found
                // This might happen if your RefEducation table isn't seeded correctly
                echo "Warning: RefEducation not found for code: " . $randomEducationCode . "\n";
            }
        });
    }
}
