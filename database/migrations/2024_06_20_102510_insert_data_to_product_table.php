<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Product::factory()->count(15)->create();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('products')->latest()->take(15)->delete();
    }
};
