<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_order()
    {
        $client = Client::factory()->create();
        $order = Order::factory()->create(['client_id' => $client->id]);

        $this->assertDatabaseHas('orders', ['client_id' => $client->id]);
    }

    /** @test */
    public function it_can_attach_products_to_an_order()
    {
        $client = Client::factory()->create();
        $order = Order::factory()->create(['client_id' => $client->id]);

        $products = Product::factory()->count(3)->create();
        $order->products()->attach($products->pluck('id'));

        $this->assertCount(3, $order->products);
    }

    /** @test */
    public function it_can_calculate_total_price_of_an_order()
    {
        $client = Client::factory()->create();
        $order = Order::factory()->create(['client_id' => $client->id]);

        $products = Product::factory()->count(3)->create(['price' => 5.00]);
        $order->products()->attach($products->pluck('id'));

        $totalPrice = $order->products->sum('price');

        $this->assertEquals(15.00, $totalPrice);
    }

    /** @test */
    public function it_can_soft_delete_an_order()
    {
        $order = Order::factory()->create();
        $order->delete();

        $this->assertSoftDeleted('orders', ['id' => $order->id]);
    }

    /** @test */
    public function it_can_restore_a_soft_deleted_order()
    {
        $order = Order::factory()->create();
        $order->delete();

        $order->restore();

        $this->assertDatabaseHas('orders', ['id' => $order->id]);
    }

    /** @test */
    public function it_requires_at_least_one_product_for_order()
    {
        $client = Client::factory()->create();

        $response = $this->postJson('/api/orders', [
            'client_id' => $client->id,
            'products' => [],
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('products');
    }

}
