<?php

namespace Database\Factories\Account;

use App\Constants\UserTypeConstant;
use App\Models\Account\User;
use App\Models\MasterType\RefMasterType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory {
    protected $model = User::class;
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'name' => fake()->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('admin'),
            'user_type_code' => UserTypeConstant::STUDENT,
            'ref_user_type_id' =>  RefMasterType::where('code', UserTypeConstant::STUDENT)
                ->where('type', UserTypeConstant::REF_MASTER_USER_TYPE)
                ->value('id'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Define a student user.
     */
    public function student(): static {
        return $this->state(function (array $attributes) {
            return [
                'user_type_code' => UserTypeConstant::STUDENT,
                'ref_user_type_id' => RefMasterType::where('code', UserTypeConstant::STUDENT)
                    ->where('type', UserTypeConstant::REF_MASTER_USER_TYPE)
                    ->value('id'),
            ];
        });
    }

    /**
     * Define an educator user.
     */
    public function educator(): static {
        return $this->state(function (array $attributes) {
            return [
                'user_type_code' => UserTypeConstant::EDUCATOR,
                'ref_user_type_id' => RefMasterType::where('code', UserTypeConstant::EDUCATOR)
                    ->where('type', UserTypeConstant::REF_MASTER_USER_TYPE)
                    ->value('id'),
            ];
        });
    }

    /**
     * Define an analyser user.
     */
    public function analyser(): static {
        return $this->state(function (array $attributes) {
            return [
                'user_type_code' => UserTypeConstant::ANALYSER,
                'ref_user_type_id' => RefMasterType::where('code', UserTypeConstant::ANALYSER)
                    ->where('type', UserTypeConstant::REF_MASTER_USER_TYPE)
                    ->value('id'),
            ];
        });
    }

    public function admin(): static {
        return $this->state(function (array $attributes) {
            return [
                'user_type_code' => UserTypeConstant::ADMIN,
                'ref_user_type_id' => RefMasterType::where('code', UserTypeConstant::ADMIN)
                    ->where('type', UserTypeConstant::REF_MASTER_USER_TYPE)
                    ->value('id'),
            ];
        });
    }
}
