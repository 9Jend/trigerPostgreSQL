<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Busket;


class ModelBusketTest extends TestCase
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

        $busket = Busket::create([
            "user_id" => $user->id,
        ]);

        foreach ([
            $firstProduct,
            $secondProduct,
            $thridProduct
        ] as $product) {
            $countProduct = rand(1, 5);
            $busket->products()->attach(
                $product->id,
                ['count'   => $countProduct]
            );
        }

        $this->assertModelExists($busket);
        $this->assertDatabaseCount('busket_product', 3);
    }
}
