<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Busket extends Model
{
    use HasFactory;

    protected $table = "buskets";
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count');
    }
}
