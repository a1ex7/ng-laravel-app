<?php

use App\Models\User;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertRedirect('/register');
});

test('link information can be updated', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post('/links');

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile?uuid='.$user->invite);
});

test('user can delete their link', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/links');

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/register');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});
