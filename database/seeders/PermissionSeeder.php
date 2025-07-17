<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder {
    public function run(): void {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $roles = [
            'Admin',
            'Educator',
            'Student',
            'Analyser',
        ];

        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName]);
            $this->command->info("Role '{$roleName}' created or already exists.");
        }
    }
}
