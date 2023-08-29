<?php

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

function asAdmin(): TestCase
{
    $user = User::factory()->create();

    return test()->actingAs($user);
}

it('can manage users', function () {
    $user = User::where(['role_id' => 1, 'status' => 1])->first();
    $this->actingAs($user)->get('/admin/user?role=admin')->assertOk();
});

it('User can login', function () {
    
    // Create a user
    $password = 'password';
    $user = User::factory()->create([
        'password' => Hash::make($password),
    ]);

    // Simulate a login request
    $response = test()->postJson(route('login'), [
        'email' => $user->email,
        'password' => $password,
    ]);

    // Assert that the login was successful (HTTP status code 200)
    $response->assertStatus(Response::HTTP_OK);

    // Assert that the response contains the user's data
    $response->assertJson([
        'id' => $user->id,
        'email' => $user->email,
    ]);
});
