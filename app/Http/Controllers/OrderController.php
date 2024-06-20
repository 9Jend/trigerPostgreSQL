<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Busket;
use App\Models\Order;
use App\Http\Services\BusketService;


class OrderController extends Controller
{

    public function __construct(BusketService $busketService) {
        $this->middleware('auth');
        $this->middleware('userBusketCount');
    }

    public function index()
    {
        $busketPrice = 0;
        $busket = Busket::firstOrCreate([
            'user_id' => auth()->user()->id,
        ]);
        foreach($busket->products()->get() as $product){
            $busketPrice += $product->price * $product->pivot->count;
        }
        $order = Order::create([
            'total_price' => $busketPrice,
            'user_id' => auth()->user()->id,
        ]);

        foreach($busket->products()->get() as $product){
            $order->products()->attach(
                $product->id,
                ['count'   => $product->pivot->count, 'total_product_price' => $product->price * $product->pivot->count]
            );
        }

        $busket->products()->detach();

        return redirect(route('home'))->with('success', 'Order checkout success');
    }


}
