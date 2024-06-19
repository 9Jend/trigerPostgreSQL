<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;


class CategoryCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_category_create(): void
    {
        $category = Category::create([
            "title" => 'test'
        ]);

        $this->assertModelExists($category);
    }
}
