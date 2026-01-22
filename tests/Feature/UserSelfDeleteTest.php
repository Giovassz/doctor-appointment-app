<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

//Usar la función para refrescar la base de datos
uses(RefreshDatabase::class, WithoutMiddleware::class);

test('un usuario no puede eliminar su propia cuenta', function () {
    // 1. Crear un usuario de prueba
    $user = User::factory()->create();

    // 2. Simular que ese usuario ya inició sesión
    $this->actingAs($user);

    // 3. Simular una petición HTTP DELETE
    $response = $this->delete(route('users.destroy', $user));

    // 4. Esperar que el servidor bloquee el borrado a si mismo (redirección con mensaje)
    $response->assertRedirect();
    $response->assertSessionHas('swal');

    // 5. Verificar en la BD que sigue existiendo el usuario
    $this->assertDatabaseHas('users', ['id' => $user->id]);
});
