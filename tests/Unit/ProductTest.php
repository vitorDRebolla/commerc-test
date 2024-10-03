<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Database\QueryException;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_product()
    {
        $product = Product::factory()->create([
            'name' => 'Pastry A',
            'price' => 5.50,
        ]);

        $this->assertDatabaseHas('products', ['name' => 'Pastry A', 'price' => 5.50]);
    }

    /** @test */
    public function it_requires_a_photo_for_a_product()
    {
        $this->expectException(QueryException::class);

        Product::factory()->create(['photo' => null]);
    }

    /** @test */
    public function it_can_update_a_product_price()
    {
        $product = Product::factory()->create();

        $product->update(['price' => 10.00]);

        $this->assertDatabaseHas('products', ['price' => 10.00]);
    }

    /** @test */
    public function it_can_soft_delete_a_product()
    {
        $product = Product::factory()->create();
        $product->delete();

        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }

    /** @test */
    public function it_can_restore_a_soft_deleted_product()
    {
        $product = Product::factory()->create();
        $product->delete();

        $product->restore();

        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    /** @test */
    public function it_requires_a_price_for_a_product()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'Pastry B',
            'photo' => 'photo.png',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('price');
    }
}
