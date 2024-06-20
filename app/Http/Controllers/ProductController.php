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
        $this->productService = $productService;
    }

    public function index()
    {
        $product = Product::all();
        return view('index', compact('product'));
    }

    public function addToBusket(Product $product)
    {
        $this->productService->addToBusket($product);
    }

    public function removeFromBusket(Product $product)
    {
        $this->productService->removeFromBusket($product);
    }

    public function changeProductCount(Product $product, Request $request)
    {

        $this->productService->changeCountBusketProduct($product, $request);
    }

    public function clearBusket()
    {
        $this->productService->clearBusket();
    }

    public function busketIndex()
    {
        return view('index');
    }
}
