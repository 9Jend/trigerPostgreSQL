<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Services\BusketService;


class BusketController extends Controller
{
    private $busketService;

    public function __construct(BusketService $busketService) {
        $this->middleware('auth');
        $this->middleware('userBusketCount');
        $this->busketService = $busketService;
    }

    public function index()
    {
        [$products, $totalBusketPrice] = $this->busketService->index();
        return view('busket.index', compact('products'), ['totalBusketPrice' => $totalBusketPrice]);
    }

    public function changeProductCount(Product $product, Request $request)
    {
        $totalBusketPrice = $this->busketService->changeCountBusketProduct($product, $request->get('count'));
        return response()->json(['success' => 'ok', 'totalBusketPrice' => $totalBusketPrice]);
    }
}
