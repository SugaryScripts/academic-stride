<?php

namespace Database\Factories\MasterType;

use App\Models\MasterType\RefSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefSubjectFactory extends Factory {
    protected $model = RefSubject::class;

    public function definition(): array {
        $subjects = [
            ['name' => 'Mathematics', 'code' => 'MATH'],
            ['name' => 'Science', 'code' => 'SCI'],
            ['name' => 'English', 'code' => 'ENG'],
            ['name' => 'History', 'code' => 'HIST'],
            ['name' => 'Geography', 'code' => 'GEO'],
            ['name' => 'Physics', 'code' => 'PHY'],
            ['name' => 'Chemistry', 'code' => 'CHEM'],
            ['name' => 'Biology', 'code' => 'BIO'],
        ];

        $subject = $this->faker->randomElement($subjects);

        return [
            'name' => $subject['name'],
            'code' => $subject['code'],
            'description' => $this->faker->sentence(),
        ];
    }
}
