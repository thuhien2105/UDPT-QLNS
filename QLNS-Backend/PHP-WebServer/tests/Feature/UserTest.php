<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->json('POST', '/api/signin', [
            'username' => 'alicesmith',
            'password' => 'Password123',
        ]);
        $responseData = $response->decodeResponseJson();
        $response->assertJsonStructure([
                'response' => [
                    'status',
                    'employee',
                ],
        ]);
        $response->assertJson([
            'response' => [
                'status' => 'Login successful',
            ],
        ]);
    }
}
