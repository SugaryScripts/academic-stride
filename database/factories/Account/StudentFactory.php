<?php

namespace Database\Factories\Account;

use App\Models\Account\Student;
use App\Models\Account\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class StudentFactory extends Factory {
    protected $model = Student::class;

    public function definition(): array {
        // Fetch a random ref_education
        $refEducation = DB::table('ref_educations')->inRandomOrder()->first();

        return [
            'user_id' => User::factory(), // This creates a user automatically if not provided
            'ref_education_code' => $refEducation->code,
            'ref_education_id' => $refEducation->id,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure() {
        return $this->afterCreating(function (Student $student) {
            // No specific actions needed after creating a student record
        });
    }
}
