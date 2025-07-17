<?php

namespace Database\Factories\Account;

use App\Models\Account\Employee;
use App\Models\Account\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory {
    protected $model = Employee::class;

    public function definition(): array {
        return [
            'user_id' => User::factory()
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure() {
        return $this->afterCreating(function (Employee $employee) {
            // No specific actions needed after creating an employee record
        });
    }
}
