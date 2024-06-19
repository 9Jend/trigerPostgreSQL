<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['count','total_product_price']);;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
