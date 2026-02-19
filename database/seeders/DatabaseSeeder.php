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
            SpecialitySeeder::class,
        ]);
        

        //Crear un usuario de prueba cada que ejecuto migrations
        $user = User::updateOrCreate(
            ['email' => 'rodrigo@software.com.mx'],
            [
                'name' => 'Rodrigo Gaxiola',
                'password' => bcrypt('12345678'),
            ]
        );

        $user->assignRole('Administrador');
    }
}
