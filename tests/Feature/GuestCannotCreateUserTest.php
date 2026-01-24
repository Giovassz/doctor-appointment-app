<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a guest cannot create a user record', function () {
    $initialCount = User::count();

    $response = $this->post(route('users.store'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'id_number' => '12345678',
        'phone' => '1234567890',
        'address' => '123 Main St',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'Paciente',
    ]);

    // We expect the request to be blocked or redirected, but the main goal is no user is created
    $this->assertEquals($initialCount, User::count());
});
