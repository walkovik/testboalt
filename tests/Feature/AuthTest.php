<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;


    public function user_can_login_successfully()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this->json('POST','/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertOk();
        $response->assertJsonStructure(['access_token', 'token_type',  'expires_at', 'user_id' ]);
    }


    public function test_register_user_successfully()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('POST','/api/auth/register', [
            'name' => 'Test name',
            'email' => 'faker@email.com',
            'password' => 'password',
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['message']);
        $response->assertJson(['message' => 'Register Successfully']);

        $this->assertDatabaseHas('users',[
            'name' => 'Test name',
            'email' => 'faker@email.com',
        ]);
    }

    public function test_get_info_user()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        Passport::actingAs($user);

        $response = $this->json('GET','/api/user');
        $response->assertStatus(200);
        $response->assertJsonStructure(['id', 'name', 'email', 'created_at', 'updated_at']);
        $response->assertJson(['id' => $user->id, 'name' => $user->name , 'email' => $user->email ]);

    }
}

