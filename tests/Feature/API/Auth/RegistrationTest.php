<?php

namespace Tests\Feature\API\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function new_user_can_register()
    {
        $this->withoutExceptionHandling();
        $this->postJson(route('api.v1.auth.register'), [
            'name' => 'john doe',
            'email' => 'johndoe@gmail.com',
            'password' => 'john123'
        ])
            ->assertStatus(201);

        $this->assertAuthenticated();

        $this->assertDatabaseHas('users', [
            'name' => 'john doe'
        ]);
    }
}
