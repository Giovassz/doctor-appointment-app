<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //LLamar al RoleSeeder creado
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            BloodTypeSeeder::class,
            AdminUserSeeder::class,
        ]);
        

        //Crear un usuario de prueba cada que ejecuto migrations
        $user = User::factory()->create([
            'name' => 'Rodrigo Gaxiola',
            'email' => 'rodrigo@software.com.mx',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('Administrador');
    }
}
