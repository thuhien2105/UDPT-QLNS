<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $employeeId;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'role' => 'manager',
            'password' => Hash::make('Password123'),
        ]);

        $this->employeeId = '698e3a40-417e-41c9-83f2-1ccbfed9ac50';
    }

    /** @test */
    public function it_can_get_all_employees()
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson('/api/employees/getAll/null/1');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_single_employee()
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->getJson("/api/employees/{$this->employeeId}");

        $response->assertStatus(200);
    }

    /** @test */
    public function it_cannot_get_all_employees_if_not_manager()
    {
        $nonManagerUser = User::factory()->create(['role' => 'employee']);

        $response = $this->actingAs($nonManagerUser, 'sanctum')
            ->getJson('/api/employees/getAll/null/1');

        $response->assertStatus(403);
    }

    /** @test */
    public function it_can_create_employee()
    {
        $data = [
            'name' => 'John Doe',
            'dob' => '1990-01-01',
            'address' => '123 Main St',
            'email' => 'john.doe@example.com',
            'position' => 'Developer',
            'phone_number' => '1234567890',
            'tax_code' => 'TAX12345',
            'bank_account' => 'BANK12345',
            'identity_card' => 'ID12345',
            'role' => 'employee'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson('/api/employees', $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_can_update_employee()
    {
        $data = [
            'employee_id' => $this->employeeId,
            'name' => 'Jane Doe',
            'dob' => '1985-01-01',
            'address' => '456 Main St',
            'email' => 'jane.doe@example.com',
            'position' => 'Manager',
            'phone_number' => '0987654321',
            'tax_code' => 'TAX67890',
            'bank_account' => 'BANK67890',
            'identity_card' => 'ID67890',
            'role' => 'manager'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->putJson('/api/employees', $data);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_delete_employee()
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->deleteJson("/api/employees/{$this->employeeId}");

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_change_password()
    {
        $data = [
            'old_password' => 'Password123',
            'new_password' => 'newpassword123'
        ];

        $response = $this->actingAs($this->user, 'sanctum')
            ->postJson("/api/employees/changePassword/{$this->user->id}", $data);

        $response->assertStatus(200);
    }
}
