<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

uses(RefreshDatabase::class, WithoutMiddleware::class);

test('user update fails with invalid data', function () {
    // Create admin user and authenticate
    $admin = User::factory()->create();
    $this->actingAs($admin);

    // Create a user to update
    $user = User::factory()->create([
        'email' => 'original@example.com'
    ]);

    // Attempt update with invalid data (invalid email)
    $response = $this->patch(route('users.update', $user), [
        'name' => 'New Name',
        'email' => 'not-an-email',
        'id_number' => '12345678',
        'role' => 'Administrador',
    ]);

    $response->assertSessionHasErrors(['email']);
    $this->assertEquals('original@example.com', $user->fresh()->email);
});
