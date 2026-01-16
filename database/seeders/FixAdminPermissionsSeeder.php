<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class FixAdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ensure all permissions exist (re-run logic from PermissionSeeder)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Users Permissions
        Permission::firstOrCreate(['name' => 'users.index']);
        Permission::firstOrCreate(['name' => 'users.create']);
        Permission::firstOrCreate(['name' => 'users.edit']);
        Permission::firstOrCreate(['name' => 'users.destroy']);

        // Roles Permissions
        Permission::firstOrCreate(['name' => 'roles.index']);
        Permission::firstOrCreate(['name' => 'roles.create']);
        Permission::firstOrCreate(['name' => 'roles.edit']);
        Permission::firstOrCreate(['name' => 'roles.destroy']);

        // 2. Ensure Admin Role has all permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions(Permission::all());

        // 3. Find or Create Admin User and Assign Role
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@medic.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Assign Role
        if (!$adminUser->hasRole('Admin')) {
            $adminUser->assignRole($adminRole);
            $this->command->info('Assigned Admin role to admin@medic.com');
        } else {
             $this->command->info('User admin@medic.com already has Admin role');
        }
        
        // 4. Clear Cache again to be sure
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
