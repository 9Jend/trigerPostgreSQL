<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;


class ProductCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_create_product(): void
    {
        $category = Category::create([
            "title" => 'test'
        ]);

        $product = Product::create([
            "category_id" => $category->id,
            "title" => 'test',
            "description" => 'test',
            "price" => 1000,
        ]);

        $this->assertModelExists($product);
    }
}
