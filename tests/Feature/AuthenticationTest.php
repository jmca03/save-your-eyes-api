<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthenticationController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    /**
     * Test user registration
     *
     * @return void
     */
    public function testRegister()
    {
        $password = fake()->password(minLength: 8);

        $this->post(route('api.auth.register'), [
            'name' => fake()->name(),
            'username' => fake()->unique()->username(),
            'email' => fake()->unique()->safeEmail(),
            'password' => $password,
            'password_confirmation' => $password,
        ])->assertStatus(201);
    }

    /**
     * Test user login using email
     *
     * @return void
     */
    public function testLoginUsingEmail()
    {
        $password = fake()->password(minLength: 8);
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);

        $this->postJson(route('api.auth.login'), [
           'identifier' => $user->email,
           'password' => $password
        ])->assertStatus(200);

    }

    /**
     * Test user login using username
     *
     * @return void
     */
    public function testLoginUsingUsername()
    {
        $password = fake()->password(minLength: 8);
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);

        $this->postJson(route('api.auth.login'), [
            'identifier' => $user->username,
            'password' => $password
        ])->assertStatus(200);
    }

    /**
     * Test user logout
     *
     * @return void
     */
    public function testLogout()
    {
        $this->actingAs(User::factory()->create(), 'api')
             ->post(route('api.auth.logout'))
             ->assertStatus(200);
    }
}
