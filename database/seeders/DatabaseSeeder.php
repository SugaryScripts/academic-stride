<?php

namespace Database\Seeders;

use Database\Seeders\QuestionBank\BiSeeder;
use Database\Seeders\QuestionBank\IpaBiologiSeeder;
use Database\Seeders\QuestionBank\IpaFisikaSeeder;
use Database\Seeders\QuestionBank\IpaKimiaSeeder;
use Database\Seeders\QuestionBank\IpsAntropologiSeeder;
use Database\Seeders\QuestionBank\IpsEkonomiSeeder;
use Database\Seeders\QuestionBank\IpsGeografiSeeder;
use Database\Seeders\QuestionBank\IpsSejarahSeeder;
use Database\Seeders\QuestionBank\IpsSosiologiSeeder;
use Database\Seeders\QuestionBank\MatematikaSeeder;
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
            //RefSubjectSeeder::class,
            RealRefSubjectSeeder::class,

            PermissionSeeder::class,
            UserSeeder::class,

            //QuestionSeeder::class,

            BiSeeder::class,

            MatematikaSeeder::class,

            IpsSosiologiSeeder::class,
            IpsGeografiSeeder::class,
            IpsEkonomiSeeder::class,
            IpsSejarahSeeder::class,
            IpsAntropologiSeeder::class,

            IpaFisikaSeeder::class,
            IpaKimiaSeeder::class,
            IpaBiologiSeeder::class,


            //ExamSeeder::class,
            //NotRealQuestionSeeder::class,

            //RealExamSeeder::class,
            //RealExamV2Seeder::class,
            RealExamTrialSeeder::class,
        ]);
    }
}
