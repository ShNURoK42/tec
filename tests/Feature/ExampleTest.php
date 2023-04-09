<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\EmployeeSeeder;
use Database\Seeders\EmployeeWorkRecordSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_api_auth_token_request()
    {
        $response = $this->postJson('/api/sanctum/token/', ['email' => 'test@example.com']);
        $response->assertStatus(200);
    }

    public function test_api_request_started_work_with_token(): void
    {
        $this->seed(EmployeeSeeder::class);
        $response = $this->postJson('/api/sanctum/token/', ['email' => 'test@example.com']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $response->content())
            ->json('post', '/api/employees/started_work', [
                'employee_id' => 1
            ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => "Successful operation"
            ]);
    }

    public function test_api_request_started_work_without_token(): void
    {
        $response = $this->json('post', '/api/employees/started_work', [
            'employee_id' => 1
        ]);

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => "Unauthenticated."
            ]);
    }

    public function test_api_request_finished_work_with_token(): void
    {
        $this->seed(EmployeeWorkRecordSeeder::class);

        $response = $this->postJson('/api/sanctum/token/', ['email' => 'test@example.com']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $response->content())
            ->json('post', '/api/employees/finished_work', [
                'employee_id' => 2
            ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => "Successful operation"
            ]);
    }

    public function test_api_request_finished_work_without_token(): void
    {
        $response = $this->json('post', '/api/employees/finished_work', [
            'employee_id' => 2
        ]);

        $response
            ->assertStatus(401)
            ->assertJson([
                'message' => "Unauthenticated."
            ]);
    }
}
