<?php

namespace Database\Seeders;

use App\Models\Account\User;
use App\Models\Assessment\AnswerTextOption;
use App\Models\Assessment\Exam;
use App\Models\Assessment\ExamSubjectConfiguration;
use App\Models\Assessment\Question;
use App\Models\MasterType\RefEducation;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RefMasterTypeSeeder::class,
            RefEducationSeeder::class,
            RefSubjectSeeder::class,

            PermissionSeeder::class,
            UserSeeder::class,

            QuestionSeeder::class,
            ExamSeeder::class,
        ]);
    }
}
