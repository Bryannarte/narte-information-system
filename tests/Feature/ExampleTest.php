<?php

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(302); // Redirect to login since books require auth
});

test('login page loads successfully', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});
