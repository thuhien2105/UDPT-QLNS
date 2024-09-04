<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Request as RequestModel;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'role' => 'manager',
            'password' => Hash::make('Password123'),
        ]);
    }

    /** @test */
    public function it_can_get_all_requests()
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/requests/1/09/2024');

        $response->assertStatus(200)
            ->assertJson(['data' => ['requests' => [$this->request->toArray()]]]);
    }

    /** @test */
    public function it_cannot_get_all_requests_if_not_manager()
    {
        $nonManagerUser = User::factory()->create(['role' => 'employee']);

        $response = $this->actingAs($nonManagerUser, 'sanctum')
            ->getJson('/api/requests/1/09/2024');

        $response->assertStatus(403)
            ->assertJson(['error' => 'You do not have permission to access this resource']);
    }

    /** @test */
    public function it_can_store_request()
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/requests', [
                'request_type' => 'LEAVE',
                'start_time' => '2024-09-01 09:00:00',
                'end_time' => '2024-09-01 17:00:00',
                'reason' => 'Vacation'
            ]);

        $response->assertStatus(201)
            ->assertJson(['status' => 'success']);
    }

    /** @test */
    public function it_can_delete_request()
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson("/api/requests/{$this->request->id}");

        $response->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }

    /** @test */
    public function it_can_approve_request()
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson("/api/requests/{$this->request->id}/approve", [
                'status' => 'APPROVED'
            ]);

        $response->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }

    /** @test */
    public function it_cannot_approve_request_if_not_manager()
    {
        $nonManagerUser = User::factory()->create(['role' => 'employee']);

        $response = $this->actingAs($nonManagerUser, 'sanctum')
            ->postJson("/api/requests/{$this->request->id}/approve", [
                'status' => 'APPROVED'
            ]);

        $response->assertStatus(403)
            ->assertJson(['error' => 'You do not have permission to access this resource']);
    }

    /** @test */
    public function it_can_checkin_and_checkout()
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/requests/checkin');

        $response->assertStatus(200)
            ->assertJson(['status' => 'success']);

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/requests/checkout');

        $response->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }
}
