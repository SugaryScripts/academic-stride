<?php

namespace Database\Seeders;

use App\Models\Account\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder {
    public function run(): void {
        User::factory()->admin()->create([
            'name' => 'Super user',
            'username' => 'user0',
        ])->assignRole('Admin');

        // Find roles once to avoid repeated database queries inside the loops
        $educatorRole = Role::findByName('Educator');
        $analyserRole = Role::findByName('Analyser');
        $studentRole = Role::findByName('Student');

        // Create educators and assign role
        User::factory()->educator()->count(10)->create()->each(function ($user) use ($educatorRole) {
            $user->assignRole($educatorRole);
        });

        // Create analysers and assign role
        User::factory()->analyser()->count(10)->create()->each(function ($user) use ($analyserRole) {
            $user->assignRole($analyserRole);
        });

        // Create students and assign role
        User::factory()->student()->count(10)->create()->each(function ($user) use ($studentRole) {
            $user->assignRole($studentRole);
        });
    }
}
