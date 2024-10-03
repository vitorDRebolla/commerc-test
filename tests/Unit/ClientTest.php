<?php

namespace Tests\Unit;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Database\QueryException;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_client()
    {
        $client = Client::factory()->create([
            'email' => 'client@example.com',
        ]);

        $this->assertDatabaseHas('clients', ['email' => 'client@example.com']);
    }

    /** @test */
    public function it_requires_unique_email()
    {
        Client::factory()->create(['email' => 'client@example.com']);

        $this->expectException(QueryException::class);

        Client::factory()->create(['email' => 'client@example.com']);
    }

    /** @test */
    public function it_can_update_a_client()
    {
        $client = Client::factory()->create();

        $client->update(['name' => 'Updated Name']);

        $this->assertDatabaseHas('clients', ['name' => 'Updated Name']);
    }

    /** @test */
    public function it_can_soft_delete_a_client()
    {
        $client = Client::factory()->create();
        $client->delete();

        $this->assertSoftDeleted('clients', ['id' => $client->id]);
    }

    /** @test */
    public function it_can_restore_a_soft_deleted_client()
    {
        $client = Client::factory()->create();
        $client->delete();

        $client->restore();

        $this->assertDatabaseHas('clients', ['id' => $client->id]);
    }

    /** @test */
    public function it_requires_an_email_to_create_client()
    {
        $response = $this->postJson('/api/clients', [
            'name' => 'Test Client',
            'phone' => '123456789',
            'birth_date' => '1990-01-01',
            'address' => '123 Main St',
            'postal_code' => '12345',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }
}
