<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guards = ['web', 'sanctum'];
        
        foreach ($guards as $guard) {
            // Users Permissions
            Permission::firstOrCreate(['name' => 'users.index', 'guard_name' => $guard]);
            Permission::firstOrCreate(['name' => 'users.create', 'guard_name' => $guard]);
            Permission::firstOrCreate(['name' => 'users.edit', 'guard_name' => $guard]);
            Permission::firstOrCreate(['name' => 'users.destroy', 'guard_name' => $guard]);

            // Roles Permissions
            Permission::firstOrCreate(['name' => 'roles.index', 'guard_name' => $guard]);
            Permission::firstOrCreate(['name' => 'roles.create', 'guard_name' => $guard]);
            Permission::firstOrCreate(['name' => 'roles.edit', 'guard_name' => $guard]);
            Permission::firstOrCreate(['name' => 'roles.destroy', 'guard_name' => $guard]);

            // Patients Permissions
            Permission::firstOrCreate(['name' => 'patients.index', 'guard_name' => $guard]);
            Permission::firstOrCreate(['name' => 'patients.create', 'guard_name' => $guard]);
            Permission::firstOrCreate(['name' => 'patients.edit', 'guard_name' => $guard]);
            Permission::firstOrCreate(['name' => 'patients.destroy', 'guard_name' => $guard]);
        }

        // Assign all permissions to Administrador role (for both guards)
        foreach ($guards as $guard) {
            $role = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => $guard]);
            // Get all permissions for this specific guard
            $permissions = Permission::where('guard_name', $guard)->get();
            $role->syncPermissions($permissions);
        }
    }
}
