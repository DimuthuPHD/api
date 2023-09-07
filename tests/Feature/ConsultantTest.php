<?php

it('Consultant can login', function () {
    // Simulate a login request
    $response = test()->postJson('api/login', [
        'email' => 'test@gmail.com',
        'password' => 'secret',
        'user_type' => 'job_seeker',
    ]);
    $response->assertStatus(200);
});
