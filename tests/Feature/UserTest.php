<?php

use App\Models\User;
use Tests\TestCase;

function asAdmin(): TestCase
{
    $user = User::factory()->create();
    return test()->actingAs($user);
}

it('can manage users', function () {
    asAdmin()->get('/')->assertOk();
});
