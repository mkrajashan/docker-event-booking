<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if a user can register successfully.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Assert that the response status is 201 and check the response structure
        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'access_token',  // Ensure the access_token is returned
                     'token_type',    // Ensure the token_type is returned
                 ]);

        // Ensure user is added to the database
        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    /**
     * Test if registration requires validation.
     *
     * @return void
     */
    public function test_registration_requires_validation()
    {
        $response = $this->postJson('/api/register', []);

        // Assert that validation errors occur and status is 422
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    /**
     * Test if registration fails when passwords don't match.
     *
     * @return void
     */
    public function test_registration_fails_when_passwords_dont_match()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        // Assert that validation error occurs for password_confirmation
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['password']);
    }

    /**
     * Test if registration fails when email already exists.
     *
     * @return void
     */
    public function test_registration_fails_when_email_is_taken()
    {
        User::create([
            'name' => 'Existing User',
            'email' => 'existing@example.com',
            'password' => bcrypt('password')
        ]);

        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'existing@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Assert that registration fails with status 422 due to email uniqueness constraint
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
    }
}
