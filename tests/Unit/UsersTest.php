<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function add_new_user()
    {
        $attributes = [
            'username' => $this->faker->userName,
            'password' => md5($this->faker->password),
            'email' => $this->faker->email,
            'contact' => $this->faker->e164PhoneNumber
        ];

        $response = $this->post("/api/addUser", $attributes);
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', $attributes);
    }
}
