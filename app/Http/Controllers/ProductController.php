<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Services\ProductService;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService) {
        $this->middleware('auth');
        $this->middleware('userBusketCount');
        $this->productService = $productService;
    }

    public function index()
    {
        $products = Product::all();
        $productBusketIDs = $this->productService->index();

        return view('index', compact('products', 'productBusketIDs'));
    }

    public function addToBusket(Product $product)
    {
        $countBasketProduct = $this->productService->addToBusket($product);
        return response()->json(['success' => 'ok', 'countBasketProduct' => $countBasketProduct]);
    }

    public function removeFromBusket(Product $product)
    {
        [$countBasketProduct, $totalBusketPrice]= $this->productService->removeFromBusket($product);
        return response()->json(['success' => 'ok', 'countBasketProduct' => $countBasketProduct, 'totalBusketPrice' => $totalBusketPrice]);
    }

    public function busketIndex()
    {
        return view('index');
    }
}
