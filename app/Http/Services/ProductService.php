<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\Busket;

class ProductService
{

    public function index()
    {
        $busket = $this->getUserBusket();
        return $busket->products()->get()->pluck('id')->toArray();
    }

    public function addToBusket(Product $product)
    {
        $busket = $this->getUserBusket();
        $busket->products()->sync([$product->id => ['count' => 1]], false);
        return $busket->products()->count();
    }

    public function removeFromBusket(Product $product)
    {
        $newBusketPrice = 0;
        $busket = $this->getUserBusket();
        $busket->products()->detach($product->id);
        foreach($busket->products()->get() as $product){
            $newBusketPrice += $product->price * $product->pivot->count;
        }
        return [$busket->products()->count(), $newBusketPrice];
    }

    public function getUserBusket()
    {
        $busket = Busket::firstOrCreate([
            'user_id' => auth()->user()->id,
        ]);
        return $busket;
    }
}
