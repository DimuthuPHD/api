<?php

it('Job Seeker List Load Successfully', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});


it('Job Seeker create Successfully', function () {
    $response = $this->post('/job-seeker/store');

    $response->assertStatus(200);
});
