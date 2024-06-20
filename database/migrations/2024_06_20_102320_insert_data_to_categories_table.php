<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Category::factory()->count(10)->create();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categories')->latest()->take(10)->delete();
    }
};
