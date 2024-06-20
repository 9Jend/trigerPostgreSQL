<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\Busket;

class BusketService
{

    public function index()
    {
        $newBusketPrice = 0;
        $busket = $this->getUserBusket();
        foreach($busket->products()->get() as $product){
            $newBusketPrice += $product->price * $product->pivot->count;
        }
        return [$busket->products()->get(), $newBusketPrice];
    }

    public function removeFromBusket(Product $product)
    {
        $busket = $this->getUserBusket();
        $busket->products()->detach($product->id);
        return $busket->products()->count();
    }

    public function getUserBusket()
    {
        $busket = Busket::firstOrCreate([
            'user_id' => auth()->user()->id,
        ]);
        return $busket;
    }

    public function changeCountBusketProduct(Product $product, $count)
    {
        $newBusketPrice = 0;
        $busket = $this->getUserBusket();
        $busket->products()->sync([$product->id => ['count' => $count]], false);
        foreach($busket->products()->get() as $product){
            $newBusketPrice += $product->price * $product->pivot->count;
        }
        return $newBusketPrice;
    }
}
