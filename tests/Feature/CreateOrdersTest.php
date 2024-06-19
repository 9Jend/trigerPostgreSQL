<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;


class CreateOrdersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_create_orders(): void
    {
        $user = User::factory()->create();

        $category = Category::create([
            "title" => 'test'
        ]);

        $product = Product::create([
            "category_id" => $category->id,
            "title" => 'test',
            "description" => 'test',
            "price" => 1000,
        ]);

        $countProduct = 1;

        $order = Order::create([
            "total_price" => 1000,
            "user_id" => $user->id,
        ]);

        $order->products()->attach(
            $product->id,
            ['count'   => $countProduct, 'total_product_price' => $product->price * $countProduct]
        );

        $this->assertModelExists($order);
        $this->assertDatabaseCount('order_product', 1);
    }
}
