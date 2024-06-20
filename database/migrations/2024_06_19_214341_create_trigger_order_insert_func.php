<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE OR REPLACE FUNCTION create_order()
            RETURNS trigger AS
            '
            BEGIN
                INSERT INTO statistics(product_name, product_count, product_category)
                SELECT products.title, NEW.count, categories.title FROM products LEFT JOIN categories
                ON products.category_id = categories.id
                WHERE products.id =  NEW.product_id;
            RETURN NEW;
            END;
            '
            LANGUAGE plpgsql;
        ");
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNTION create_order()');
    }
};
