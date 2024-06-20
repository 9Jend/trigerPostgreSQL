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

        $firstCategory = Category::create([
            "title" => 'first category'
        ]);

        $secondCategory = Category::create([
            "title" => 'second category'
        ]);

        $firstProduct = Product::create([
            "category_id" => $firstCategory->id,
            "title" => 'First product',
            "description" => 'First desc',
            "price" => 1000,
        ]);
        $secondProduct = Product::create([
            "category_id" => $secondCategory->id,
            "title" => 'Second product',
            "description" => 'Second desc',
            "price" => 500,
        ]);
        $thridProduct = Product::create([
            "category_id" => $secondCategory->id,
            "title" => 'Thrid product',
            "description" => 'Thrid desc',
            "price" => 300,
        ]);

        $order = Order::create([
            "total_price" => 1000,
            "user_id" => $user->id,
        ]);

        foreach ([
            $firstProduct,
            $secondProduct,
            $thridProduct
        ] as $product) {
            $countProduct = rand(1, 5);
            $order->products()->attach(
                $product->id,
                ['count'   => $countProduct, 'total_product_price' => $product->price * $countProduct]
            );
        }

        $this->assertModelExists($order);
        $this->assertDatabaseCount('order_product', 3);
        $this->assertDatabaseCount('statistics', 3);
    }
}
