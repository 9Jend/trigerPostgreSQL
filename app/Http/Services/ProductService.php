<?php

namespace App\Http\Services;

use App\Models\Product;
use App\Models\Busket;

class ProductService
{

    public function addToBusket(Product $product)
    {
        $busket = $this->getUserBusket();
        $busket->products()->attach($product->id, ['count' => 1]);
    }

    public function removeFromBusket(Product $product)
    {
        $busket = $this->getUserBusket();
        $busket->products()->detach($product->id);
    }

    public function clearBusket()
    {
        $busket = $this->getUserBusket();
        $busket->products()->detach();
    }

    public function getUserBusket()
    {
        return auth()->user()->busket()->get();
    }

    public function changeCountBusketProduct(Product $product, $count)
    {
        $busket = $this->getUserBusket();
        $busket->products()->syncWithoutDetaching($product->id, $count);
    }
}
